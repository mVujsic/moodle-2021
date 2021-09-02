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

    $sql = "SELECT * from nastavnik WHERE email=:stari_email";

    if($stmt = $pdo->prepare($sql)){
        
        $stmt->bindParam(":stari_email", $param_stari, PDO::PARAM_STR);
        
        $param_stari = $_GET["email"];
        
        if(!$stmt->execute()){
            echo $stmt->debugDumpParams();
        }

        $info = $stmt->fetch();
    }  
     

    if(isset($_POST['novi_email'])){
            $sql = "UPDATE nastavnik SET
            ime = :ime,
            prezime = :prezime,
            email = :novi_email
            WHERE email=:stari_email";
            if($stmt = $pdo->prepare($sql)){
                
                $stmt->bindParam(":ime", $param_ime, PDO::PARAM_STR);
                $stmt->bindParam(":prezime", $param_prezime, PDO::PARAM_STR);
                $stmt->bindParam(":novi_email", $param_novi, PDO::PARAM_STR);
                $stmt->bindParam(":stari_email", $param_stari, PDO::PARAM_STR);
                
                
                $param_ime = trim($_POST["ime"]);
                $param_prezime = trim($_POST["prezime"]);
                $param_novi = trim($_POST["novi_email"]);
                $param_stari = $_GET["email"];
        
                
                
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
                    <h4 style="font-size: 35px;color:white"> <b> Креирање наставничког налога</b></h4>
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
                        <label for="exampleInputEmail1"><b>Нова е-пошта:</b></label>
                        <input type="email" name='novi_email'  value=<?php echo('"' . $info["email"] . '"');?>class="form-control" id="novi_email" required
                            placeholder="Nova e-mail адреса">
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