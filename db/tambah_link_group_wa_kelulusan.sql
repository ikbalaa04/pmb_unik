ALTER TABLE `konfigurasi`
  ADD COLUMN IF NOT EXISTS `wa_group` VARCHAR(255) NULL AFTER `wa_konfirmasi_berkas`,
  ADD COLUMN IF NOT EXISTS `wa_group_kelulusan` VARCHAR(255) NULL AFTER `wa_group`;
