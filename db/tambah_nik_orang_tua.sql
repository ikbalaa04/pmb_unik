ALTER TABLE `pendaftaran`
  ADD COLUMN `ortu_nik` char(60) NOT NULL DEFAULT '-,-,-' AFTER `ortu_nama`;
