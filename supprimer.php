<?php
        
    if (isset($_REQUEST["id"])) {//&&isset($_POST["mdp"])){
        $i = $_REQUEST["id"];
        include("conn.php");

        try{
            $conn = new PDO("mysql:host=$server;dbname=$bd",$loginServer,$mdpServer);
            $conn->setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
            $sql = "DELETE  FROM etudiants WHERE Id = '$i'";
                
            $result = $conn->query($sql);
            header("Location:admin.php?msg=Suppression réussi");
        }catch(PDOException $e){
            echo "Connection failed: " . $e->getMessage();
        }
    }else{
        header("Location:admin.php?msg=La suppression a échoué");
    }
            
?>