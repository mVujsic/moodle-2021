<?php

require_once "../config/PDOconfig.php" ;

if(isset( $_POST['submit'] )){

  $stmt = $pdo->prepare('INSERT INTO `drzi` (`kursID`, `idNastavnika`) VALUES
(' . $_GET["id"] . ' ,' . $_POST["dodaj"] . ');');

  $stmt->execute();

  header("Refresh:0; url=view.php?id=" . $_GET["id"]);
}

?>