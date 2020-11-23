<?php

try {
    $servername = "localhost";
    $username = "root";
    $password = ""; //uneti sifru

    $conn = new PDO("mysql:host=$servername;dbname=moodle_db", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    die();
  }

  $_GET['brIndeksa'] = '6352017'; //za test

$stmt = $conn->prepare('SELECT * FROM kurs WHERE pristupniKod = "'.$_POST["courseCode"].'"');
$stmt->execute();

$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
$fetched = $stmt->fetch();

if (!empty($fetched)){
    $stmtCheck = $conn->prepare('SELECT * FROM pohadja WHERE kursID = "'.$fetched["kursId"].'" AND studentID = '.intval($_GET["brIndeksa"]).'');
    $stmtCheck->execute();
    $checkResult = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $checkFetched = $stmt->fetch();
    
    if (!empty($checkFetched)){
        $stmt2 = $conn->prepare('INSERT INTO pohadja(`kursID`, `studentID`) VALUES ("'.$fetched["kursId"].'",'.intval($_GET["brIndeksa"]).')');
        $stmt2->execute();

    }

    $courseUrl = 'course/view.php?id='.$fetched["kursId"];

    ob_start();
    header('Location: '.$courseUrl);
    ob_end_flush();
    die();
}
else{
    echo('<h3 align=center>Неисправан код</h3><form method="post" action="courseCode.php">
    <input type="text" name="courseCode">
    <input type="submit" value="Submit">
  </form>');
}


?>