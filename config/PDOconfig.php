<?php

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'gzxCSajZ1'); // Ovde staviti vasu sifru
define('DB_NAME', 'moodle_db');
 
/* Konekcija ka bazi */
try{
    $pdo = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
} catch(PDOException $e){
    die("GRESKA " . $e->getMessage());
}
?>