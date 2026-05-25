UPDATE `pendaftaran`
SET `hp` = CONCAT('62', SUBSTRING(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(TRIM(`hp`), ' ', ''), '-', ''), '(', ''), ')', ''), '+', ''), 2))
WHERE REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(TRIM(COALESCE(`hp`, '')), ' ', ''), '-', ''), '(', ''), ')', ''), '+', '') REGEXP '^0[0-9]+$';

UPDATE `agen`
SET `hp` = CONCAT('62', SUBSTRING(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(TRIM(`hp`), ' ', ''), '-', ''), '(', ''), ')', ''), '+', ''), 2))
WHERE REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(TRIM(COALESCE(`hp`, '')), ' ', ''), '-', ''), '(', ''), ')', ''), '+', '') REGEXP '^0[0-9]+$';

UPDATE `pengguna`
SET `hp` = CONCAT('62', SUBSTRING(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(TRIM(`hp`), ' ', ''), '-', ''), '(', ''), ')', ''), '+', ''), 2))
WHERE REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(TRIM(COALESCE(`hp`, '')), ' ', ''), '-', ''), '(', ''), ')', ''), '+', '') REGEXP '^0[0-9]+$';
