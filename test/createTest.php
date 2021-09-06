<?php 
    
    require_once "../config/PDOconfig.php";
    session_start();
    if(isset($_POST["submit"])){
    $sql = "INSERT INTO test(kursID, naziv) VALUES (:kursId, :naziv)";
    if($stmt = $pdo->prepare($sql)){
        
        $stmt->bindParam(":kursId", $param_kurs, PDO::PARAM_STR);
        $stmt->bindParam(":naziv", $param_naziv, PDO::PARAM_STR);
         
        $param_kurs = trim($_GET["id"]);
        $param_naziv = trim($_POST["naziv"]);
                
        $stmt->execute();


    }
                
    header("Refresh:0; url=../course/view.php?id=" . $_GET["id"]);

}

?>