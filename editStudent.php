<!DOCTYPE html>
<html lang="srb">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/login.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Добродошли на е-учење</title>
</head>

<?php
    session_start();

    require_once "./config/PDOconfig.php" ;
	
    if(!isset($_SESSION["type"]) || $_SESSION["type"] != 'admin'){
        header("location: login.php");
        exit;
    }

    $sql = "SELECT * from student WHERE studentID=:indeks";

    if($stmt = $pdo->prepare($sql)){
        
        $stmt->bindParam(":indeks", $param_indeks, PDO::PARAM_STR);
        
        $param_indeks = $_GET["indeks"];
        
        if(!$stmt->execute()){
            echo $stmt->debugDumpParams();
        }

        $info = $stmt->fetch();
    }  
     

    if(isset($_POST['novi_email'])){
            $sql = "UPDATE student SET
            ime = :ime,
            prezime = :prezime,
            email = :novi_email,
            upisanSemestar = :sem,
            kojiPutSlusaGod = :kojiput,
            osvojeniEspb = :espb,
            smerID = :smer
            WHERE studentID=:indeks";

            if($stmt = $pdo->prepare($sql)){
                
                $stmt->bindParam(":ime", $param_ime, PDO::PARAM_STR);
                $stmt->bindParam(":prezime", $param_prezime, PDO::PARAM_STR);
                $stmt->bindParam(":novi_email", $param_novi, PDO::PARAM_STR);
                $stmt->bindParam(":sem", $param_sem, PDO::PARAM_STR);
                $stmt->bindParam(":kojiput", $param_kojiput, PDO::PARAM_STR);
                $stmt->bindParam(":espb", $param_espb, PDO::PARAM_STR);
                $stmt->bindParam(":smer", $param_smer, PDO::PARAM_STR);
                $stmt->bindParam(":indeks", $param_indeks, PDO::PARAM_STR);
                
                $param_ime = trim($_POST["ime"]);
                $param_prezime = trim($_POST["prezime"]);
                $param_novi = trim($_POST["novi_email"]);
                $param_sem = trim($_POST["semestar"]);
                $param_kojiput = trim($_POST["kojiput"]);
                $param_espb = trim($_POST["espb"]);
                $param_smer = trim($_POST["smer"]);
                $param_indeks = $_GET["indeks"];
        
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
                    <h4 style="font-size: 35px;color:white"> <b> Измена података</b></h4>
                </div>
            </div>
        </div>
        <br>
        <div class="row justify-content-center">
            <div class="col-12 col-sm-8 col-md-4">
                <form class="form-container" method="POST" action="">
                    <div class="form-group">
                        <label for="" style="font-size: 25px;">Нови подаци</label><br><br>
                        <label for="exampleInputIme1"><b>Име:</b></label>
                        <input type="text" name='ime' value=<?php echo('"' . $info["ime"] . '"');?> class="form-control" id="ime" required
                            placeholder="Име">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPrezime1"><b>Презиме:</b></label>
                        <input type="text" name='prezime' value=<?php echo('"' . $info["prezime"] . '"');?> class="form-control" id="prezime" required
                            placeholder="Презиме">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><b>E-пошта:</b></label>
                        <input type="email" name='novi_email'  value=<?php echo('"' . $info["email"] . '"');?>class="form-control" id="novi_email" required
                            placeholder="Нова имејл адреса">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><b>Семестар:</b></label>
                        <input type="number" name='semestar'  value=<?php echo('"' . $info["upisanSemestar"] . '"');?>class="form-control" id="semestar" required
                            placeholder="Семестар">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><b>Који пут слуша:</b></label>
                        <input type="number" name='kojiput'  value=<?php echo('"' . $info["kojiPutSlusaGod"] . '"');?>class="form-control" id="kojiput" required
                            placeholder="Који пут слуша">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><b>ЕСПБ:</b></label>
                        <input type="number" name='espb'  value=<?php echo('"' . $info["osvojeniEspb"] . '"');?>class="form-control" id="espb" required
                            placeholder="ЕСПБ">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><b>Смер:</b></label>
                        <input type="number" name='smer'  value=<?php echo('"' . $info["smerID"] . '"');?>class="form-control" id="smer" required
                            placeholder="Шифра смера">
                    </div>
                    <div class="form-group form-check">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block" aria-pressed="true" style="font-size: 20px;">Измени податке</button><br>
                    <div class="container-fluid">
                        <a href="admin.php" class="btn btn-primary btn-lg active link1 btn-block"
                            role="button" aria-pressed="true">Страница админа</a>

                    </div>
                </form>

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