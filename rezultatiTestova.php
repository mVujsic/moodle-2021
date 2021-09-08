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

    if(!isset($_SESSION["type"]) || $_SESSION["type"] == 'student'){
        header("location: login.php");
        exit;
    }
	  
    $search_term = isset($_GET["searchterm"])? $_GET["searchterm"]:"";
    $pagesize = 10;
    $pagenum = isset($_GET["page"])? $_GET["page"]:1;
    $sql = "SELECT * FROM polaze INNER JOIN student ON polaze.studentID = student.studentID WHERE polaze.studentID LIKE :searchterm OR CONVERT(polaze.testId, CHAR) LIKE :searchterm";
    if($stmt = $pdo->prepare($sql)){
        $stmt->bindParam(":searchterm", $param_searchterm, PDO::PARAM_STR);
        $param_searchterm = "%" . $search_term . "%";
    }



?>

<body>
    <div class="container-fluid bg">
        <br>
        <br>
        <br>
        <div class="row justify-content-center">
            <div class="col-12 col-sm-12 col-md-12">
                <div class="info" align=center>
                    <h4 style="font-size: 35px;color:white"> <b> Резултати тестова</b></h4>
                </div>
            </div>
        </div>
        <br>
        <div class="row justify-content-center">
            <div class="col-10 col-sm-10 col-md-10">
                <form class="form-container" method="GET" action="rezultatiTestova.php">
                    <div class="form-group">
                        <input type="text" name='searchterm' class="form-control" id="searchterm" 
                            placeholder="Термин претраге">
                    </div>
                    <div class="form-group form-check">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block" aria-pressed="true" style="font-size: 20px;">Претрага</button>
                    <a href="admin.php" class="btn btn-primary btn-lg active link1 btn-block"
                            role="button" aria-pressed="true">Контролни панел</a><br><br>
                    <div class="container-fluid">

                        <div class="row" style=" border-bottom:1px solid black;">
                            <div class="col-4 col-sm-4 col-md-4"><b>Индекс студента</b></div>
                            <div class="col-4 col-sm-4 col-md-4"><b>Шифра теста</b></div>
                            <div class="col-4 col-sm-4 col-md-4"><b>Бодови</b></div>
                        
                        </div>

                        <?php

                        if($stmt->execute()){
                            while($row = $stmt->fetch()){
                                echo("<div class='row' style='border-bottom:1px solid black;'>");
                                echo("<div class='col-4 col-sm-4 col-md-4'>");
                                echo("<span>" . $row["studentID"] . "</span>");
                                echo("</div>");
                                echo("<div class='col-4 col-sm-4 col-md-4'>");
                                echo("<span>" . $row["testId"] . "</span>");
                                echo("</div>");
                                echo("<div class='col-4 col-sm-4 col-md-4'>");
                                echo("<span>" . $row["bodovi"] . "</span>");echo("</div>");
                                echo("</div>");
                            }
                        }

                        ?>
                        

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

<?php                 
    // zatvori
    unset($pdo);
?>

</html>