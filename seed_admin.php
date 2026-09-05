<?php
/**
 * Endesha faili hii MARA MOJA tu baada ya ku-import database.sql
 * kwenye browser: http://localhost/wakala_system/seed_admin.php
 * Inasahihisha namba ya simu iliyosimbwa (encrypted) ya akaunti ya kwanza ya mkuu.
 * FUTA faili hii baada ya kuitumia.
 */
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/classes/Database.php';
require_once __DIR__ . '/classes/Encryption.php';

$db = Database::getConnection();

$phone = '0700000000'; // badilisha na namba halisi ya wakala mkuu
$phoneEnc = Encryption::encrypt($phone);

$stmt = $db->prepare("UPDATE users SET phone_enc = ? WHERE username = 'mkuu'");
$stmt->execute([$phoneEnc]);

echo "Akaunti ya mkuu imesahihishwa. Username: mkuu | Password: mkuu123<br>";
echo "Tafadhali FUTA faili hii (seed_admin.php) sasa kwa usalama.";
