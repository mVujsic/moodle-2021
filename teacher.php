<!DOCTYPE html>
<html lang="srb">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/login.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Админ</title>
</head>

<?php
    session_start();

    require_once "./config/PDOconfig.php" ;
	
    $username_or_passwd_err="E-mail мора бити облика xxx@xx.xx";

    if(!isset($_SESSION["type"]) || $_SESSION["type"] != 'nastavnik'){
        header("location: login.php");
        exit;
    }
     

    if(isset($_POST['email'])){
            $sql = "INSERT INTO nalog(email, sifra, tip) VALUES (:email, :sifra, :tip)";
            //$sql = "INSERT INTO nastavnik(ime, prezime, email) VALUES('" . $_POST['ime'] . "','" . . $_POST['prezime'] . "','". $_POST['email'] . "')" ;
            if($stmt = $pdo->prepare($sql)){
                
                $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
                $stmt->bindParam(":sifra", $param_sifra, PDO::PARAM_STR);
                $stmt->bindParam(":tip", $param_tip, PDO::PARAM_STR);
                
                
                $param_email = trim($_POST["email"]);
                $param_sifra = hash('sha1', $_POST['password']);
                $param_tip = 2;
                
                
                if(!$stmt->execute()){
                    echo $stmt->debugDumpParams();
                }
            }

            $sql = "INSERT INTO student(studentID, ime, prezime, email, upisanSemestar, kojiPutSlusaGod, osvojeniEspb, smerID) VALUES (:studentID, :ime, :prezime, :email, 1, 1, 0, " . trim($_POST["smerID"]) . ")";
            //$sql = "INSERT INTO nastavnik(ime, prezime, email) VALUES('" . $_POST['ime'] . "','" . . $_POST['prezime'] . "','". $_POST['email'] . "')" ;
            if($stmt = $pdo->prepare($sql)){
                
                $stmt->bindParam(":studentID", $param_studentID, PDO::PARAM_STR);
                $stmt->bindParam(":ime", $param_ime, PDO::PARAM_STR);
                $stmt->bindParam(":prezime", $param_prezime, PDO::PARAM_STR);
                $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
                
                
                $param_studentID = trim($_POST["studentID"]);
                $param_ime = trim($_POST["ime"]);
                $param_prezime = trim($_POST["prezime"]);
                $param_email = trim($_POST["email"]);
                
                
                if(!$stmt->execute()){
                    echo $stmt->debugDumpParams();
                }
            }
        }
            
        
                
        // zatvori
        unset($pdo);


?>

<body>
    <div class="container-fluid bg">
        <br>
        <br>
        <br>
        <div class="row justify-content-center">
            <div class="col-12 col-sm-8 col-md-4">
                <div class="info" align=center>
                    <h4 style="font-size: 35px;color:white"> <b> Наставник </b></h4>
                </div>
            </div>
        </div>
        <br>
        <div class="row justify-content-center">
            <div class="col-12 col-sm-8 col-md-4">
                    <div class="container-fluid">
                        <a href="studentSearch.php" class="btn btn-primary btn-lg active link1 btn-block"
                            role="button" aria-pressed="true">Претрага студената</a>
                    </div>
                    <div class="container-fluid">
                        <a href="courseSearch.php" class="btn btn-primary btn-lg active link1 btn-block"
                            role="button" aria-pressed="true">Претрага курсева</a>
                    </div>
            </div>
        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>
</body>

</html>