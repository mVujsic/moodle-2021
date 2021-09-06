<?php

require_once "../config/PDOconfig.php";
session_start();
  function getBrojOdgovora($id){
    global $pdo;
    $sql = "SELECT COUNT(odgovorId) FROM odgovori WHERE pitanjeId = :pitanjeId";
    if($stmt = $pdo->prepare($sql)){

        $stmt->bindParam(":pitanjeId", $param_pitanje, PDO::PARAM_INT);

        $param_pitanje = $id;
        $stmt->execute();

        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $fetched = $stmt->fetchColumn();
    
        return $fetched;
    }
  }
if(isset($_POST["submit"])){
    print_r($_POST);
$sql = "SELECT * from pitanja WHERE testId = :testId";
if($stmt = $pdo->prepare($sql)){
    $ukupnoBodova = 0; 
    $stmt->bindParam(":testId", $param_test, PDO::PARAM_STR);
     
    $param_test = trim($_GET["id"]);
            
    $stmt->execute();

    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    while($res = $stmt->fetch()){
      $pitanje = $res["pitanje"];
      $pitanjeId = $res["pitanjeId"];
      $bodovi = $res["bodovi"];
      $izabrani = $_POST["odgovor".$pitanjeId];
      $brojOdgovora = getBrojOdgovora($pitanjeId);
      $tacni = 0;
      $netacni = 0;
      $brIzabrani  = 0;
      $sqlOdg = "SELECT * FROM odgovori WHERE pitanjeId = :pitanjeId";
      if($stmtOdg = $pdo->prepare($sqlOdg)){  
        $stmtOdg->bindParam(":pitanjeId", $param_pitanjeId, PDO::PARAM_INT);

        $param_pitanjeId = $pitanjeId;
        $stmtOdg->execute();

        $result = $stmtOdg->setFetchMode(PDO::FETCH_ASSOC);
        while($resOdg = $stmtOdg->fetch()){
            $odgovorId = $resOdg["odgovorId"];
            $odgovor = $resOdg["odgovor"];
            $tacan = $resOdg["tacan"];
            foreach($izabrani as $odg){
                if($odg == $odgovorId){
                   if($tacan == 1){ $tacni = $tacni + 1; $brIzabrani = $brIzabrani + 1;}
                   if($tacan == 0){ $netacni = $netacni + 1;$brIzabrani = $brIzabrani + 1;}

                }

            }
        }
            $ukupnoBodova = $ukupnoBodova + $bodovi*($tacni/$brIzabrani - $netacni/$brIzabrani);
      }
    }

}

var_dump($ukupnoBodova);
$sql = "INSERT INTO polaze(studentID,testId,bodovi) VALUES(:studentID,:testId,:bodovi)";
if($stmt = $pdo->prepare($sql)){
    $stmt->bindParam(":studentID",$param_studentId,PDO::PARAM_STR);
    $stmt->bindParam(":testId",$param_testId,PDO::PARAM_INT);
    $stmt->bindParam(":bodovi",$param_bodovi,PDO::PARAM_INT);

    $param_studentId = $_SESSION["userID"];
    $param_testId = $_GET['id'];
    $param_bodovi = $ukupnoBodova;

    $stmt->execute();
}
}
 //header("Refresh:0; url=test.php?id=" . $_GET["id"]);
?> 