
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
</head>

<body>
<?php
require_once "../config/PDOconfig.php" ;

session_start();
header('Content-Type: text/html;charset=utf-8');

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
  header("location: ../login.php");
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

  <h1 align="left">
<?php
  function getStudentBodovi($studentId,$testId){
    global $pdo;
    $sql = 'SELECT bodovi FROM polaze WHERE studentID = :studentID AND testId = :testId';
    if($stmt = $pdo->prepare($sql)){

      $stmt->bindParam(":studentID",$param_studentId,PDO::PARAM_STR);
      $stmt->bindParam(":testId",$param_testId,PDO::PARAM_INT);

      $param_studentId = $studentId;
      $param_testId = $testId;

      $stmt->execute();

      $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
      $fetched = $stmt->fetch();

      return $fetched["bodovi"];
    }
  }

  function getBrojPitanja($id){
    global $pdo;
    $sql = "SELECT COUNT(pitanjeId) FROM pitanja WHERE testId = :testId";
    if($stmt = $pdo->prepare($sql)){

        $stmt->bindParam(":testId", $param_kurs, PDO::PARAM_INT);

        $param_kurs = $id;
        $stmt->execute();

        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $fetched = $stmt->fetchColumn();
    
        return $fetched;
    }
  }

  function getBrojOdgovora($pitanjeId,$testId){
    global $pdo;
    $sql = "SELECT COUNT(odgovorId) FROM odgovori WHERE pitanjeId = :pitanjeId AND testId = :testId";
    if($stmt = $pdo->prepare($sql)){

        $stmt->bindParam(":pitanjeId", $param_pitanje, PDO::PARAM_INT);
        $stmt->bindParam(":testId", $param_test, PDO::PARAM_INT);

        $param_pitanje = $pitanjeId;
        $param_test = $testId;
        $stmt->execute();

        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $fetched = $stmt->fetchColumn();
    
        return $fetched;
    }
  }
  if($_SESSION["type"] == 'student'){
    $brBodova = getStudentBodovi($_SESSION['userID'],trim($_GET['id']));
    if(is_numeric($brBodova))
      echo("Osvojeno je: ".$brBodova);

  }
  $nextPitanje = getBrojPitanja($_GET['id']) + 1;
  if ($_SESSION["type"] =='admin' || $_SESSION["type"] =='nastavnik'){
    echo('
    <div class="row">
    <div class="col-sm-6">
  <h6 align="left">
  <form action="addPitanje.php?id=' . $_GET["id"] . '" method=post>
    <input type="hidden" id="pitanjeId" name="pitanjeId" value ='.$nextPitanje.'><br>
    <input type="text" id="pitanje" name="pitanje"><br>
    <label for="pitanje">Pitanje:</label><br>
    <input type="number" id="bodovi" name="bodovi"><br>
    <label for="bodovi">Bodovi:</label><br>
    <input type="submit" name="submit" value="Unesi stavku">
  </form>
  </h6></div></div>
  ');
  }
  $sql = "SELECT * FROM pitanja WHERE testId = :testId";
  if($stmt = $pdo->prepare($sql)){  
    $stmt->bindParam(":testId", $param_test, PDO::PARAM_INT);

    $param_test = trim($_GET["id"]);
    $stmt->execute();

    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
      if($_SESSION["type"] == 'student'){
      echo('<form action="calculateBodovi.php?id='.$_GET['id'].'" method=post>');
      }

    while($res = $stmt->fetch()){
      $pitanje = $res["pitanje"];
      $pitanjeId = $res["pitanjeId"];
      $nextOdgovor = getBrojOdgovora($pitanjeId,$param_test) + 1;
      echo('<div class="row"><div class="col-sm-6"><pre>'.$pitanje.'</pre>');
      if ($_SESSION["type"] =='admin' || $_SESSION["type"] =='nastavnik'){
        echo('
        
         
         <h6 align="left">
        <form action="addOdgovor.php?id=' . $_GET["id"] . '" method=post>
            <input type="hidden" id="pitanjeId" name="pitanjeId" value ='.$pitanjeId.'><br>
            <input type="hidden" id="odgovorId" name="odgovorId" value ='.$nextOdgovor.'><br>
            <input type="text" id="odgovor" name="odgovor"><br>
            <label for="odgovor">Odgovor:</label><br>
            <input type="number" id="tacan" name="tacan"><br>
            <label for="tacan">Tacan(1 ili 0):</label><br>
    <input type="submit" name="submit" value="Unesi stavku">
  </form>
  </h6></div></div>
  ');
  }
      $sqlOdg = "SELECT * FROM odgovori WHERE pitanjeId = :pitanjeId AND testId = :testId";
      if($stmtOdg = $pdo->prepare($sqlOdg)){  
        $stmtOdg->bindParam(":pitanjeId", $param_pitanjeId, PDO::PARAM_INT);
        $stmtOdg->bindParam(":testId", $param_testId, PDO::PARAM_INT);

        $param_pitanjeId = $pitanjeId;
        $param_testId = trim($_GET['id']); 
        $stmtOdg->execute();

        $result = $stmtOdg->setFetchMode(PDO::FETCH_ASSOC);
        while($resOdg = $stmtOdg->fetch()){
            $odgovorId = $resOdg["odgovorId"];
            $odgovor = $resOdg["odgovor"];
            echo('
                <input type="checkbox" id="'.$odgovorId.'" name="odgovor'.$pitanjeId.'[]" value="'.$odgovorId.'">
                <label for="'.$odgovorId.'"><h4>'.$odgovor.'</h4></label><br>
            ');
        }
      }
      
    }
    if($_SESSION["type"] == 'student' && !is_numeric($brBodova)){
    echo('<input type="submit" name="submit" value="Predaj test">
          </form>');
    }
}
?>

</div>
</div><br><br>

</div>
</body>
</html>