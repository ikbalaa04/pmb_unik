<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa_profile
{
	protected $CI;
	protected $fields = array();

	public function __construct()
	{
		$this->CI =& get_instance();
		$this->CI->config->load('mahasiswa_required', TRUE);
		$this->fields = $this->CI->config->item('mahasiswa_required_fields', 'mahasiswa_required');
	}

	public function fields($group = NULL, $mahasiswa = NULL)
	{
		if ($group === NULL) {
			return $this->fields;
		}

		$items = isset($this->fields[$group]) ? $this->fields[$group] : array();
		if ($mahasiswa === NULL) {
			return $items;
		}

		$filtered = array();
		foreach ($items as $field) {
			if ($this->condition_matches($field, $mahasiswa)) {
				$filtered[] = $field;
			}
		}

		return $filtered;
	}

	public function missing_fields($mahasiswa, $group = NULL)
	{
		$missing = array();
		$groups = $group === NULL ? array_keys($this->fields) : array($group);

		foreach ($groups as $field_group) {
			foreach ($this->fields($field_group, $mahasiswa) as $field) {
				if ($this->is_empty_field($mahasiswa, $field)) {
					$field['group'] = $field_group;
					$missing[] = $field;
				}
			}
		}

		return $missing;
	}

	public function missing_labels($mahasiswa, $group = NULL)
	{
		$labels = array();
		foreach ($this->missing_fields($mahasiswa, $group) as $field) {
			$labels[] = $field['label'];
		}

		return $labels;
	}

	public function is_complete($mahasiswa)
	{
		return count($this->missing_fields($mahasiswa)) === 0;
	}

	public function form_complete($group, $mahasiswa)
	{
		return count($this->missing_fields($mahasiswa, $group)) === 0;
	}

	public function completion_target($mahasiswa)
	{
		if (!$this->form_complete('utama', $mahasiswa)) {
			return 'admin/home/form_utama';
		}

		return 'admin/home/form_lanjutan';
	}

	public function apply_validation_rules($form_validation, $group, $mahasiswa)
	{
		foreach ($this->fields($group, $mahasiswa) as $field) {
			$name = isset($field['rule_name']) ? $field['rule_name'] : $field['name'];
			$rules = isset($field['rules']) ? $field['rules'] : 'required';
			$form_validation->set_rules($name, $field['label'], $rules, array(
				'required' => '%s harus diisi',
				'valid_email' => '%s tidak valid',
				'min_length' => '%s minimal %s karakter',
				'max_length' => '%s maksimal %s karakter',
			));
		}
	}

	protected function condition_matches($field, $mahasiswa)
	{
		if (!isset($field['condition'])) {
			return TRUE;
		}

		$jenis = isset($mahasiswa->jenis) ? $mahasiswa->jenis : '';
		if ($field['condition'] === 'pd') {
			return $jenis === 'PD';
		}

		if ($field['condition'] === 'bukan_pd') {
			return $jenis !== 'PD';
		}

		return TRUE;
	}

	protected function is_empty_field($mahasiswa, $field)
	{
		$name = $field['name'];
		$value = isset($mahasiswa->$name) ? $mahasiswa->$name : '';

		if (isset($field['index'])) {
			$parts = explode(',', (string) $value);
			$value = isset($parts[$field['index']]) ? $parts[$field['index']] : '';
		}

		$value = trim((string) $value);
		return $value === '' || $value === '-' || $value === '0';
	}
}
