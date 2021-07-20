<?php
require_once "./config/PDOconfig.php" ;
session_start();

$stmt = $pdo->prepare('SELECT * FROM kurs WHERE pristupniKod = "'.$_POST["courseCode"].'"');
$stmt->execute();

$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
$fetched = $stmt->fetch();

if (!empty($fetched)){
    $stmtCheck = $pdo->prepare('SELECT * FROM pohadja WHERE kursID = "'.$fetched["kursID"].'" AND studentID = '.$_SESSION["userID"].'');
    $stmtCheck->execute();
    $checkResult = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $checkFetched = $stmt->fetch();
    
    if (empty($checkFetched)){
        $stmt2 = $pdo->prepare('INSERT INTO pohadja(`kursID`, `studentID`) VALUES ("'.$fetched["kursID"].'","'.$_SESSION["userID"].'")');
        $stmt2->execute();

    }

    $courseUrl = 'course/view.php?id='.$fetched["kursID"];

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