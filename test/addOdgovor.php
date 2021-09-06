
<?php

session_start();
require_once "../config/PDOconfig.php" ;
if(isset( $_POST['submit'] )){
    dodajOdgovor($_GET['id'],$_POST['pitanjeId'],$_POST['odgovorId'],$_POST['odgovor'],$_POST['tacan']);
}
  
 header("Refresh:0; url=test.php?id=" . $_GET["id"]);

function dodajOdgovor($idTest,$idPitanje,$idOdgovor,$odgovor,$tacan){
  global $pdo;
  $sql = "INSERT INTO  odgovori(testId,pitanjeId,odgovorId,odgovor,tacan) VALUES (:testId,:pitanjeId,:odgovorId,:odgovor,:tacan)";
  if($stmt = $pdo->prepare($sql)){

      $stmt->bindParam(":testId", $param_testId, PDO::PARAM_INT);
      $stmt->bindParam(":pitanjeId", $param_pitanjeId, PDO::PARAM_INT);
      $stmt->bindParam(":odgovorId", $param_odgovorId, PDO::PARAM_INT);
      $stmt->bindParam(":odgovor", $param_odgovor, PDO::PARAM_STR);
      $stmt->bindParam(":tacan", $param_tacan, PDO::PARAM_INT);

      $param_testId = $idTest;
      $param_pitanjeId = $idPitanje;
      $param_odgovorId = $idOdgovor;
      $param_odgovor = $odgovor;
      $param_tacan = $tacan;
      $stmt->execute();
  }
}
  ?>