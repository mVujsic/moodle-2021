<?php
require_once "./config/PDOconfig.php" ;
session_start();

$stmt = $pdo->prepare('SELECT * FROM kurs WHERE pristupniKod = "'.$_POST["courseCode"].'"');
$stmt->execute();

$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
$fetched = $stmt->fetch();

if (!empty($fetched)){
    $stmtCheck = $pdo->prepare('SELECT * FROM pohadja WHERE kursId = "'.$fetched["kursId"].'" AND studentID = "'.$_SESSION["userID"].'"');
    $stmtCheck->execute();
    $checkResult = $stmtCheck->setFetchMode(PDO::FETCH_ASSOC);
    $checkFetched = $stmtCheck->fetch();
    
    if (empty($checkFetched)){
        $stmt2 = $pdo->prepare('INSERT INTO pohadja(`kursId`, `studentID`) VALUES ("'.$fetched["kursId"].'","'.$_SESSION["userID"].'")');
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