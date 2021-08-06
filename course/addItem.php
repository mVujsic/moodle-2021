<?php

require_once "../config/PDOconfig.php" ;

if(isset( $_POST['submit'] )){

  $stmt = $pdo->prepare('INSERT INTO `item` (`brTeme`, `redBroj`, `naziv`, `tip`, `lokacija`) VALUES
(' . $_POST["brTeme"] . ' , ' . $_POST["redBroj"] . ' ,"' . $_POST["naziv"] . '" ,"' . $_POST["tip"] . '" ,"' . $_POST["lokacija"] . '");');

  $stmt->execute();

  $stmt = $pdo->prepare('SELECT itemId FROM item ORDER BY itemId DESC LIMIT 1');

  $stmt->execute();
  $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
  $itemId = $stmt->fetch()["itemId"];

  $stmt = $pdo->prepare('INSERT INTO `sadrzaj` (`kursId`, `itemId`) VALUES
(' . $_GET["id"] . ' , ' . $itemId . ');');

  var_dump($stmt->execute());

  header("Refresh:0; url=view.php?id=" . $_GET["id"]);
}

?>