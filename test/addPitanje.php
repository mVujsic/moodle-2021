<?php

session_start();
require_once "../config/PDOconfig.php" ;
if(isset( $_POST['submit'] )){
    dodajPitanje($_GET['id'],$_POST['pitanjeId'],$_POST['pitanje'],$_POST['bodovi']);
}
  
 header("Refresh:0; url=test.php?id=" . $_GET["id"]);
function dodajPitanje($id,$num,$pitanje,$bodovi){
  global $pdo;
  $sql = "INSERT INTO  pitanja(testId,pitanjeId,pitanje,bodovi) VALUES (:testId,:pitanjeId,:pitanje,:bodovi)";
  if($stmt = $pdo->prepare($sql)){

      $stmt->bindParam(":testId", $param_testId, PDO::PARAM_INT);
      $stmt->bindParam(":pitanjeId", $param_pitanjeId, PDO::PARAM_INT);
      $stmt->bindParam(":pitanje", $param_pitanje, PDO::PARAM_STR);
      $stmt->bindParam(":bodovi", $param_bodovi, PDO::PARAM_INT);

      $param_testId = $id;
      $param_pitanjeId = $num;
      $param_pitanje = $pitanje;
      $param_bodovi = $bodovi;
      $stmt->execute();
  }
}

?>