<?php

require_once "../config/PDOconfig.php" ;

if(isset( $_POST['submit'] )){

  $stmt = $pdo->prepare('INSERT INTO `item` (`brTeme`, `redBroj`, `naziv`, `tip`, `lokacija`, `kursId`) VALUES
(' . $_POST["brTeme"] . ' , ' . $_POST["redBroj"] . ' ,"' . $_POST["naziv"] . '" ,"' . $_POST["tip"] . '" ,"' . $_POST["lokacija"] . '" ,"' . $_GET["id"] . '");');

  $stmt->execute();

  header("Refresh:0; url=view.php?id=" . $_GET["id"]);
}

?>