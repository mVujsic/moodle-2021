<?php

require_once "../config/PDOconfig.php" ;

if(isset( $_POST['submit'] )){

  $stmt = $pdo->prepare('DELETE FROM `drzi` WHERE
kursID=' . $_GET["id"] . ' AND idNastavnika=' . $_POST["ukloni"] . ';');

  $stmt->execute();

  echo($stmt->debugDumpParams());

  header("Refresh:0; url=view.php?id=" . $_GET["id"]);
}

?>