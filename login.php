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
	
	// Funkcija za određivanje vrsta naloga ( radi lakšeg rada sa privilegijama )
	function setSessionType($pdo){
		if(!isset($_SESSION["type"])){
			$tip = -1;
			$email = $_SESSION["email"];
			$sql = "SELECT tip FROM nalog WHERE email = :email";
			if($stmt = $pdo->prepare($sql)){
				$stmt->bindParam(':email',$email,PDO::PARAM_STR);
				if($stmt->execute()){
					if($stmt->rowCount() == 1){
							if($row = $stmt->fetch()){
								$tip = $row["tip"];
							}
					}
				}
			}
			
			switch ($tip){
				case -1:
				  echo "Greška, korisnik nije logovan";
				  break;
				case 0:
				  $_SESSION["type"] = 'admin';
				  break;
				case 1:
				  $_SESSION["type"] = 'nastavnik';
				  break;
				case 2:
				  $_SESSION["type"] = 'student';
				  break;
				
			}
		}
	}
    
    $username_or_passwd_err="E-mail мора бити облика xxx@xx.xx";

    $br_pokusaja=0; //TODO
    $isProf=false;
    
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
        setSessionType($pdo);

        if($_SESSION["type"] == 'admin'){
            header("location: admin.php");
        }else if($_SESSION["type"] == 'nastavnik'){
            header("location: teacher.php");
        }else 
            header("location: home.php");
        exit;
    }
     

    if(isset($_POST['email'])){
          
            $sql = "SELECT email, sifra FROM nalog WHERE email = :email";
            
            if($stmt = $pdo->prepare($sql)){
                
                $stmt->bindParam(":email", $param_username, PDO::PARAM_STR);
                
                
                $param_username = trim($_POST["email"]);
                
                
                if($stmt->execute()){

                    if($stmt->rowCount() == 1){
                        if($row = $stmt->fetch()){
                            $email = $row["email"];
                           
                            $hashed_password = $row["sifra"];

                            
                            $password = hash('sha1', $_POST['password']);

                            if($password == $hashed_password){
                               
                                
                                
                               //Postavka Session promenljivih
                                $_SESSION["loggedin"] = true;
                                $_SESSION["email"] = $email;
								setSessionType($pdo);

                                if($_SESSION["type"] == 'admin'){
                                    header("location: admin.php");
                                }else if($_SESSION["type"] == 'nastavnik'){
                                    header("location: teacher.php");
                                }else 
                                    header("location: home.php");
                            } else{
                               
                                $username_or_passwd_err  = "Погрешна шифра.";
                            }
                        }
                    } else{
                       
                        $username_or_passwd_err = "Погрешна адреса или шифра. Покушајте поново";
                    }
                } else{
                    echo "Грешка на серверу молимо покушајте мало касније";
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
                    <h4 style="font-size: 35px;color:white"> <b> Портал за е-учење</b></h4>
                </div>
            </div>
        </div>
        <br>
        <div class="row justify-content-center">
            <div class="col-12 col-sm-8 col-md-4">
                <form class="form-container" method="POST" action="">
                    <div class="form-group">
                        <label for="" style="font-size: 25px;">Пријавна форма</label><br><br>
                        <label for="exampleInputEmail1"><b>Адреса е-поште:</b></label>
                        <input type="email" name='email' class="form-control" id="email" required
                            placeholder="Ваша e-mail адреса">
                        <small id="emailHelp" class="form-text text-muted"><span class="help-block" style="color:red"><?php echo $username_or_passwd_err; ?></span></small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1"><b>Шифра:</b></label>
                        <input type="password" name='password' class="form-control" id="pass" required
                            placeholder="Унесите шифру овде">
                        <small id="emailHelp" class="form-text text-muted">
                            <span class="help-block"></span></small>
                    </div>
                    <div class="form-group form-check">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block" aria-pressed="true" style="font-size: 20px;">Пријави се</button><br>
                    <div class="container-fluid">
                        <a href="http://www.mfkg.rs/sr/" class="btn btn-primary btn-lg active link1 btn-block"
                            role="button" aria-pressed="true">Страница факултета</a>

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