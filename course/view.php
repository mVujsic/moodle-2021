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
    .popupEdit {
      position: relative;
      text-align: center;
      width: 100%;
      }
    .formEdit {
      display: none;
      position: fixed;
      left: 45%;
      top: 5%;
      transform: translate(-50%, 5%);
      border: 3px solid #999999;
      z-index: 9;
      background: white;
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
function editItem(id) {
      $.ajax({
           type: "POST",
           url: 'ajax.php',
           data:{action:'editItem', itemId:id}

      });
  }
function openForm() {
    document.getElementById("editForm").style.display = "block";
  }
function closeForm() {
    document.getElementById("editForm").style.display = "none";
  }

  </script>
</head>
<body>
  <!-- Kurs 7100 je ispunjen u tabelama za isprobavanje -->
<?php

require_once "../config/PDOconfig.php" ;

session_start();
header('Content-Type: text/html;charset=utf-8');

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
  header("location: ../login.php");
  exit;
}

if($_SESSION["type"] == 'student'){
  $stmtCheck = $pdo->prepare('SELECT * FROM pohadja WHERE kursId = "'.$_GET["id"].'" AND studentID = "'.$_SESSION["userID"].'"');
  $stmtCheck->execute();
  $checkResult = $stmtCheck->setFetchMode(PDO::FETCH_ASSOC);
  $checkFetched = $stmtCheck->fetch();

  if (empty($checkFetched)){
      header("location: ../home.php");
  }
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

$ukupanBrojTema = 15;

$stmt = $pdo->prepare('SELECT itemId, brTeme, redBroj, tip, lokacija, kursId, predmet.naziv, item.naziv AS itemNaziv FROM item 
INNER JOIN predmet ON predmet.sifraPred=item.kursId 
WHERE item.kursId = ' . $_GET["id"] . ' ORDER BY item.brTeme ASC, item.redBroj ASC');

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
			  
				  foreach($predmeti as $key => $value){
					  echo('<li><a href="view.php?id='.($_SESSION["type"] == 'admin'? $value["kursID"]:$value["kursID"]).'">'.'БРТСИ'.($_SESSION["type"] == 'admin'? $value["kursID"]:$value["kursID"]).'</a></li>');
				  }
				
            ?>
          </ul></div>
        </li>
        <li class="active"><a href=<?php
        switch($type){
          case 'admin':
            $adress = '../admin.php';
            break;
          case 'student':
            $adress = '../home.php';
            break;
          case 'nastavnik':
            $adress = '../teacher.php';
            break;
        }
        echo('"' . $adress . '"');
         ?>>Контролни панел</a></li>
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

  if ($_SESSION["type"] =='nastavnik') {
    $stmt = $pdo->prepare('SELECT * FROM drzi WHERE idNastavnika = ' . $_SESSION["userID"] . ' AND kursId = ' . $_GET["id"]);
        
    $stmt->execute();

    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
  }

  if ($_SESSION["type"] =='admin' || $stmt->fetch()){
    echo('</div>');
    echo('
    <div class="row">
    <div class="col-sm-6">
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
  </h6></div>
  ');

    if ($_SESSION["type"] =='admin'){
      echo('
      <div class="col-sm-6">
      <h6 align="right">
      <form action="addTeacher.php?id=' . $_GET["id"] . '" method=post>
        <label for="tip">Dodaj nastavnika:</label>
        <select name="dodaj" id="dodaj">');
        $stmt = $pdo->prepare('SELECT ime, prezime, idNastavnika FROM nastavnik WHERE nastavnik.idNastavnika NOT IN (SELECT nastavnik.idNastavnika FROM nastavnik INNER JOIN drzi ON nastavnik.idNastavnika = drzi.idNastavnika WHERE kursId = ' . $_GET["id"] . ')');
        
        $stmt->execute();

        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

        while($ime_prezime = $stmt->fetch()){
          $ime = $ime_prezime["ime"];
          $prezime = $ime_prezime["prezime"];
          $id = $ime_prezime["idNastavnika"];
          echo('<option value=' . $id . '>' . $ime . ' ' . $prezime . '</option>');
          
        }
        echo('</select>
        <input type="submit" name="submit" value="Dodaj">
      </form>
      </h6></div>
      ');

      echo('
      <div class="col-sm-6">
      <h6 align="right">
      <form action="removeTeacher.php?id=' . $_GET["id"] . '" method=post>
        <label for="tip">Ukloni nastavnika:</label>
        <select name="ukloni" id="ukloni">');
        $stmt = $pdo->prepare('SELECT ime, prezime, nastavnik.idNastavnika FROM nastavnik INNER JOIN drzi ON nastavnik.idNastavnika = drzi.idNastavnika WHERE kursId = ' . $_GET["id"]);

        $stmt->execute();

        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

        while($ime_prezime = $stmt->fetch()){
          $ime = $ime_prezime["ime"];
          $prezime = $ime_prezime["prezime"];
          $id = $ime_prezime["idNastavnika"];
          echo('<option value=' . $id . '>' . $ime . ' ' . $prezime . '</option>');
          
        }
        echo('</select>
        <input type="submit" name="submit" value="Ukloni">
      </form>
      </h6></div>');

      }

  
    } 
    if ($_SESSION["type"] =='admin' || $_SESSION["type"] == 'nastavnik'){
      echo('
      <div class="col-sm-6">
      <h6 align="right">
      <form action="../test/createTest.php?id=' . $_GET["id"] . '" method=post>
        <label for="naziv">Naziv:</label><br>
        <input type="text" id="naziv" name="naziv"><br>
        <label for="tip">Kreiraj test:</label>
        <input type="submit" name="submit" value="Dodaj">
      </form>
      </h6></div>
      ');

    }
    ?>
    <div class="row">
    <div class="col-sm-2" style="border: 1px solid black;">
    <?php
      $sql = "SELECT testId,naziv FROM test WHERE kursID = :kursID";
      if($stmt = $pdo->prepare($sql)){  
        $stmt->bindParam(":kursID", $param_kurs, PDO::PARAM_STR);
    
        $param_kurs = trim($_GET["id"]);
        $stmt->execute();
    
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    
        while($res = $stmt->fetch()){
          $naziv = $res["naziv"];
          $testId = $res["testId"];
          echo('<a href="../test/test.php?id='.$testId.'">'. $naziv .'</a><br>');
          
        }
      }
    ?>
    </div>
    </div>
    <?php
    
    $counter = 0;
    if($_SESSION["type"] !='student')
      echo('</div>');
	for($i=1;$i<=$ukupanBrojTema;$i++){
    echo("<hr><div class='row'><div class='col-sm-1'></div><div text-align:left class='row col-sm-11'><h2 align='left'>Tema " . $i . "</h2><div class='col-sm-1'></div><div text-align:left class='row col-sm-11'>");
    while(isset($fetched[$counter]["brTeme"]) && $fetched[$counter]["brTeme"] == $i){

      echo("<h5 id=" . $fetched[$counter]["itemId"] ." align='left'><a padding-left=50px style='color:black;' href='" . $fetched[$counter]["lokacija"] . "'>
      <img style='height:20px;' src=../pics/" . $fetched[$counter]["tip"] .".png> " . $fetched[$counter]["itemNaziv"] . "</a>" . 

      (($_SESSION["type"] =='admin' || $_SESSION["type"] =='nastavnik')? "
         <button type='button' onclick='deleteItem(" . $fetched[$counter]["itemId"] . ")'>Obrisi</button> 
         <button type='button' onclick='openForm()'>Izmeni</button>":"") 
      . "</h5>");
      $counter++;

    }
  echo("</div></div></div>");
  }
  
  ?>
</div>
<div class="popupEdit">
      <div class="formEdit" id="editForm">
        <?php echo('
      <form action="editItem.php?id=' . $_GET["id"] . '" method=post>
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
    <input type="submit" name="edit" onclick="editItem('.$fetched[$counter]["itemId"].')" value="Izmeni">
    <button type="button" onclick="closeForm()">Izlaz</button>
  </form>
  ');
  ?>
      </div>
</div>


</div>
</div><br><br>

</div>
</body>
</html>
