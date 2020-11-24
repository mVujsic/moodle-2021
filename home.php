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
    
    /* Add a gray background color and some padding to the footer */
    footer {
      background-color: #f2f2f2;
      padding: 25px;
    }
    
  </style>
</head>
<body>
<?php

require_once "./config/PDOconfig.php" ;

session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
  header("location: login.php");
  exit;
}

$studentIDstmt = $pdo->prepare('SELECT * FROM student WHERE email = "'.$_SESSION["email"].'"');
$studentIDstmt->execute();

$studentIDresult = $studentIDstmt->setFetchMode(PDO::FETCH_ASSOC);
$studentIDfetched = $studentIDstmt->fetch();

$_SESSION['studentID'] = $studentIDfetched["studentID"];

$stmt = $pdo->prepare('SELECT * FROM pohadja WHERE studentID = "'.$_SESSION['studentID'].'"');
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
              foreach($fetched as $key => $value){
                  echo('<li><a href="course/view.php?id='.$value["kursID"].'">'.'БРТСИ'.$value["kursID"].'</a></li>');
              }
            ?>
          </ul></div>
        </li>
        <li class="active"><a href="#">Контролни панел</a></li>
        <li><a href="kursevi.php">Сви курсеви</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li>
          <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" style="margin-top:10%; background-color: black; border:none;">
              <?php 
              $stmtStudent = $pdo->prepare('SELECT * FROM student WHERE studentID = "'.intval($_SESSION['studentID']).'"');
              $stmtStudent->execute();
              
              $result = $stmtStudent->setFetchMode(PDO::FETCH_ASSOC);
              $student = $stmtStudent->fetch();
              echo($student["ime"] . ' ' . $student["prezime"]);
             ?>
            <span class="caret"></span></button>
            <ul class="dropdown-menu">
              <li><form action="./config/logout.php" method="post"><button type="submit">Одјави се</button></form></li> 
              <li><a href="menjanjeSifre.php">Промена шифре</a></li>
              <li><a href=<?php echo("user/profile.php?id=" . $_SESSION['studentID']);?>>Профил</a></li>
            </ul>
          </div>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div style="padding-left: 50px; padding-right: 50px;background-image: url('pics/headerbg.jpg');">
<div class="headerlogo" style="background-color: white; ">
    <img src="pics/FINK-logo-450.png" style="margin-top: 50px; max-width:100%;"
    class="img-fluid" alt="Responsive image">
</div>

<div class="jumbotron" style="margin-bottom:0; background-image:linear-gradient(lightskyblue, white);">
  <div class="container text-center">
    <h1 style="font-family: 'Arial', Times, serif; float: left;">
      <span class="glyphicon glyphicon-user" style="background-color: white; padding: 15px; float:left;"></span>
      &nbsp;
      <?php 
      echo($student["ime"] . ' ' . $student["prezime"]);
      //echo($student["ime"] + ' ' + $student["prezime"]);
      ?>
    </h1>    
  </div>
</div>

<div class="container-fluid bg-3 text-center" style="background-color: white; padding-bottom:30px;">      
<div class="container-fluid bg-3 text-center row" style="background-color: white;">    
<div class="col-sm-10">
<form method="post" action="courseCode.php">
  <input type="text" name="courseCode">
  <input type="submit" value="Submit">
</form>
  <h3>Курсеви</h3><br>
  <?php 
  echo('<div class="row">');
  $counter = 0;
  foreach($fetched as $key => $value){
      $stmtPredmet = $pdo->prepare('SELECT * FROM predmet WHERE sifraPred = "'.$value["kursID"].'"');
      $stmtPredmet->execute();
      $result = $stmtPredmet->setFetchMode(PDO::FETCH_ASSOC);
      $predmet = $stmtPredmet->fetch();
      echo('
      <div class="col-sm-3">
      <p>'.$predmet["naziv"].'</p>
        <a href="course/view.php?id='.$predmet["sifraPred"].'">
        <img src="http://moodle.fink.rs/theme/image.php/fordson/theme/1601546586/noimg" class="img-responsive" style="width:100%" alt="Image">
        </a>
      </div>');
      $counter++;
      if($counter == 4){
        echo('</div><br><div class="row">');
        $counter = 0;
    }
    if($counter == 4) {echo("</div>"); $counter=0;}
  }
  if($counter != 0) {echo("</div>");}
  ?>
</div>
<div class="col-sm-2" style="border: 1px solid black;">
  Sidebar za testove
</div>
</div>
</div><br><br>

<!--<footer class="container-fluid text-center">
  <p>Footer Text</p>
</footer> -->

</div>
</body>
</html>
