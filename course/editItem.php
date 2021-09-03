<?php
 
require_once "../config/PDOconfig.php" ;
if(isset( $_POST['edit'] )){
  $stmt = $pdo->prepare('UPDATE `item` 
  SET `brTeme` = ' . $_POST["brTeme"] . ', `redBroj` = ' . $_POST["redBroj"] . ', `naziv` = ' . $_POST["naziv"] . ', `tip` = '. $_POST["tip"].', `lokacija` = '.$_POST["lokacija"].' 
  WHERE `kursId ='.$_GET["id"]);

  $stmt->execute();

  header("Refresh:0; url=view.php?id=" . $_GET["id"]);
}
?>