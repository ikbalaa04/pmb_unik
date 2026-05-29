<?php if (!empty($required_missing_labels)) { ?>
<div class="alert alert-warning">
	<strong>Silakan lengkapi data berikut terlebih dahulu:</strong>
	<?php echo htmlspecialchars(implode(', ', $required_missing_labels), ENT_QUOTES, 'UTF-8'); ?>.
	<br>Data wajib harus dilengkapi sebelum menggunakan menu lain di sistem.
</div>
<?php } ?>
