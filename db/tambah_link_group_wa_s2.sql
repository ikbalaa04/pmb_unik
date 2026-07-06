ALTER TABLE `konfigurasi`
  ADD COLUMN IF NOT EXISTS `wa_group_s2` VARCHAR(255) NULL AFTER `wa_group`;
