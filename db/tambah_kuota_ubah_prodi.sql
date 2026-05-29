ALTER TABLE `pendaftaran`
  ADD COLUMN `kuota_ubah_prodi` tinyint(1) NOT NULL DEFAULT 0 AFTER `jurusan_pilihan2`;
