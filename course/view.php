<!DOCTYPE html>
<html lang="en">
<head>
  <title>Контролни панел</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
    /* Remove the navbar's default margin-bottom and rounded borders */ 
    .navbar {
      margin-bottom: 0;
      border-radius: 0;
    }
    
  </style>

  <script>
function deleteItem(id) {
      $.ajax({
           type: "POST",
           url: 'ajax.php',
           data:{action:'deleteItem', itemId:id}

      });
      var myobj = document.getElementById(id);
      myobj.remove();
  }
  </script>
</head>
<body>
  <!-- Kurs 7100 je ispunjen u tabelama za isprobavanje -->
<?php

require_once "../config/PDOconfig.php" ;

session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true ){
  header("location: login.php");
  exit;
}
$type = $_SESSION["type"];
$email = $_SESSION["email"];
$_SESSION['userID'] = getUserId($email,$type,$pdo);

switch($type){
  case 'admin':
    $stmt = $pdo->prepare('SELECT * FROM kurs');
    break;
  case 'student':
    $stmt = $pdo->prepare('SELECT * FROM pohadja WHERE studentID = "'.$_SESSION['userID'].'"');
    break;
  case 'nastavnik':
    $stmt = $pdo->prepare('SELECT * FROM drzi WHERE idNastavnika = "'.$_SESSION['userID'].'"');
    break;
}
$stmt->execute();

$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
$predmeti = $stmt->fetchAll();

$stmt = $pdo->prepare('SELECT MAX(brTeme) AS ukupanBrojTema FROM item 
INNER JOIN sadrzaj ON item.itemId=sadrzaj.itemId 
WHERE sadrzaj.kursId = ' . $_GET["id"]);

$stmt->execute();

$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
$fetched = $stmt->fetch();
$ukupanBrojTema = $fetched["ukupanBrojTema"];

$stmt = $pdo->prepare('SELECT item.itemId, brTeme, redBroj, tip, lokacija, kursId, predmet.naziv, item.naziv AS itemNaziv FROM item 
INNER JOIN sadrzaj ON item.itemId=sadrzaj.itemId 
INNER JOIN predmet ON predmet.sifraPred=sadrzaj.kursId 
WHERE sadrzaj.kursId = ' . $_GET["id"] . ' ORDER BY item.brTeme ASC, item.redBroj ASC');

$stmt->execute();

$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
$fetched = $stmt->fetchAll();


?>

<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li>
        <div class="dropdown">
          <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" style="padding-top:40%; background-color: black; border:none;">
          <span class="glyphicon glyphicon-th-list"></span></button>
          <ul class="dropdown-menu">
          <?php 
			  if($_SESSION["type"] == 'student'){
				  foreach($predmeti as $key => $value){
					  echo('<li><a href="course/view.php?id='.$value["kursID"].'">'.'БРТСИ'.$value["kursID"].'</a></li>');
				  }
				}
            ?>
          </ul></div>
        </li>
        <li class="active"><a href="#">Контролни панел</a></li>
        <li><a href="courses.php">Сви курсеви</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li>
          <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" style="margin-top:10%; background-color: black; border:none;">
              <?php 
			  if($_SESSION["type"] == 'admin'){
				  echo('admin');
			  }
			  if($_SESSION["type"] == 'nastavnik'){
				  $stmtNastavnik = $pdo->prepare('SELECT * FROM nastavnik WHERE idNastavnika = "'.intval($_SESSION['userID']).'"');
				  $stmtNastavnik->execute();
				  
				  $result = $stmtNastavnik->setFetchMode(PDO::FETCH_ASSOC);
				  $nastavnik = $stmtNastavnik->fetch();
				  echo($nastavnik["ime"] . ' ' . $nastavnik["prezime"]);
			  }
			  if($_SESSION["type"] == 'student'){
				  $stmtStudent = $pdo->prepare('SELECT * FROM student WHERE studentID = "'.intval($_SESSION['userID']).'"');
				  $stmtStudent->execute();
				  
				  $result = $stmtStudent->setFetchMode(PDO::FETCH_ASSOC);
				  $student = $stmtStudent->fetch();
				  echo($student["ime"] . ' ' . $student["prezime"]);
			  }
			  
             ?>
            <span class="caret"></span></button>
            <ul class="dropdown-menu">
              <li><form action="../config/logout.php" method="post"><button type="submit">Одјави се</button></form></li> 
              <li><a href="menjanjeSifre.php">Промена шифре</a></li>
              <li><a href=<?php echo("user/profile.php?id=" . $_SESSION['userID']);?>>Профил</a></li>
            </ul>
          </div>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div style="padding-top:50px; padding-left: 50px; padding-right: 50px;background-image: url('../pics/headerbg.jpg');">

<div class="container-fluid bg-3 text-center" style="background-color: white; padding-bottom:30px;">      
<div class="container-fluid bg-3 text-center row" style="background-color: white;">    
<div class="col-sm-10">

  <h1 align="left"><?php 
  $stmt = $pdo->prepare('SELECT naziv FROM predmet WHERE sifraPred = ' . $_GET["id"]);

  $stmt->execute();

  $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
  $nazivPredmeta = $stmt->fetch()["naziv"];
  echo($nazivPredmeta);?>
  
</h1>


<br>
<?php 
  if ($_SESSION["type"] !='student') echo('
  <h6 align="left">
  <form action="addItem.php?id=' . $_GET["id"] . '" method=post>
    <label for="brTeme">Broj teme:</label><br>
    <input type="number" id="brTeme" name="brTeme"><br>
    <label for="redBroj">Redni broj:</label><br>
    <input type="number" id="redBroj" name="redBroj"><br>
    <label for="naziv">Naziv:</label><br>
    <input type="text" id="naziv" name="naziv"><br>
    <label for="lokacija">Lokacija:</label><br>
    <input type="text" id="lokacija" name="lokacija"><br>
    <label for="tip">Tip podatka:</label><br>
    <select name="tip" id="tip">
      <option value="pdf">pdf</option>
      <option value="wav">wav</option>
      <option value="doc">doc</option>
      <option value="ppt">ppt</option>
      <option value="avi">avi</option>
      <option value="txt">text</option>
      <option value="test">test</option>
    </select>
    <input type="submit" name="submit" value="Unesi stavku">
  </form>
  </h6>
  ');

  $counter = 0;

	for($i=1;$i<=$ukupanBrojTema;$i++){
    echo("<hr><div class='row'><div class='col-sm-1'></div><div text-align:left class='row col-sm-11'><h2 align='left'>Tema " . $i . "</h2><div class='col-sm-1'></div><div text-align:left class='row col-sm-11'>");
    while(isset($fetched[$counter]["brTeme"]) && $fetched[$counter]["brTeme"] == $i){

      echo("<h5 id=" . $fetched[$counter]["itemId"] ." align='left'><a padding-left=50px style='color:black;' href='" . $fetched[$counter]["lokacija"] . "'><img style='height:20px;' src=../pics/" . $fetched[$counter]["tip"] .".png> " . $fetched[$counter]["itemNaziv"] . "</a>" . 

      (($_SESSION["type"] !='student')? "   <button type='button' onclick='deleteItem(" . $fetched[$counter]["itemId"] . ")'>Obrisi</button>":"") 
      . "</h5>");
      $counter++;

    }
  echo("</div></div></div>");
  }
  
  ?>
</div>
<div class="col-sm-2" style="border: 1px solid black;">
  Sidebar za testove
</div>
</div>
</div><br><br>

</div>
</body>
</html>
