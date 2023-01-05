<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    
</body>
</html>
<?php
include("conn.php");
        
        try{
            $conn = new PDO("mysql:host=$server;dbname=$bd",$loginServer,$mdpServer);
            $conn->setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT * FROM etudiants Order by Nom";
            $result = $conn->query($sql);

            $txt = "";
            $q = $_REQUEST["q"];
            $t = $_REQUEST["t"];           
            
            if ($result->rowCount() > 0){
                echo "<table class='table table-hover'>";
                echo"<tr class='table-primary'><th>Id</th><th>Prenom</th><th>Nom</th><th>Adresse</th><th>Email</th><th>Supprimer</th><th>Modifier</th></tr>";
                if ($q !== ""){   
                    $len = strlen($q);
                    while($row = $result->fetch()){
                        //if (stristr($q, substr($row["Nom"],0,$len)) || stristr($q, substr($row["Prenoms"],0,$len)) || stristr($q, substr($row["Id"],0,$len)) || stristr($q, substr($row["Adresse"],0,$len)) || stristr($q, substr($row["Email"],0,$len)) || stristr($q, substr($row["Telephone"],0,$len)) ){
                        if (stristr($q, substr($row["$t"],0,$len))) {
                            echo"<tr class='table-success'><td><a href='details.php?id=".$row["Id"]."' style='color:white;'>".$row["Id"]."</a></td><td>".$row["Prenoms"]."</td><td>".$row["Nom"]."</td><td>".$row["Adresse"]."</td><td>".$row["Email"]."</td><td><a href='supprimer.php?id=".$row["Id"]."' style='color:white;'>".$row["Id"]."</a></td><td><a href='modifier.php?id=".$row["Id"]."' style='color:white;'>".$row["Id"]."</a></td></tr>";
                        }
                    } 
                    
                }else{
                    while ($row = $result->fetch()){
                        echo"<tr class='table-active'><td><a href='details.php?id=".$row["Id"]."'>".$row["Id"]."</a></td><td>".$row["Prenoms"]."</td><td>".$row["Nom"]."</td><td>".$row["Adresse"]."</td><td>".$row["Email"]."</td><td><a href='supprimer.php?id=".$row["Id"]."'>".$row["Id"]."</a></td><td><a href='modifier.php?id=".$row["Id"]."'>".$row["Id"]."</a></td></tr>";
                    }
                }
                echo "</table>";
            }
        }catch(PDOException $e){
            echo "Connection failed: " . $e->getMessage();
        }

        
?>