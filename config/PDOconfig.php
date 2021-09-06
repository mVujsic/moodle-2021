<?php

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', ''); // Ovde staviti vasu sifru
define('DB_NAME', 'moodle_db');
 
/* Konekcija ka bazi */
try{
    $pdo = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME.";charset=UTF8", DB_USERNAME, DB_PASSWORD);
} catch(PDOException $e){
    die("GRESKA " . $e->getMessage());
}

function getUserId($email,$type,$pdoVar){
	if($type =='admin'){
		return 0;
	}
	
	if($type == 'student'){
		$studentIDstmt = $pdoVar->prepare('SELECT * FROM student WHERE email = :email');
		$studentIDstmt->bindParam(':email',$email,PDO::PARAM_STR);
		$studentIDstmt->execute();

		$studentIDresult = $studentIDstmt->setFetchMode(PDO::FETCH_ASSOC);
		$studentIDfetched = $studentIDstmt->fetch();

		return $studentIDfetched["studentID"];
	}
	if($type == 'nastavnik'){
		$nastavnikIDstmt = $pdoVar->prepare('SELECT * FROM nastavnik WHERE email = :email');
		$nastavnikIDstmt->bindParam(':email',$email,PDO::PARAM_STR);
		$nastavnikIDstmt->execute();

		$nastavnikIDresult = $nastavnikIDstmt->setFetchMode(PDO::FETCH_ASSOC);
		$nastavnikIDfetched = $nastavnikIDstmt->fetch();

		return $nastavnikIDfetched["idNastavnika"];
	
	}
}

?>