ALTER TABLE utenti
  ADD `reset_token_hash` VARCHAR(100) NULL DEFAULT NULL,
  ADD `reset_token_expires_at` DATETIME NULL DEFAULT NULL,
  ADD UNIQUE (`reset_token_hash`);


  ALTER TABLE utenti
  ADD `is_admin` tinyint(1) NULL DEFAULT NULL;