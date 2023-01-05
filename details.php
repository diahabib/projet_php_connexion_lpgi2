<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/styles2.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    
</head>
<body>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Page d'accueil</a></li>
        <li class="breadcrumb-item"><a href="admin.php">Retourner à la page admin</a> </li>
        <li class="breadcrumb-item active">Ajouter nouvel utilisateur</li>
    </ol>
</body>
</html>
<?php
    include("conn.php");
    if (isset($_GET["id"])){
        
        try{
            $conn = new PDO("mysql:host=$server;dbname=$bd",$loginServer,$mdpServer);
            $conn->setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT * FROM etudiants WHERE Id = :id";
            $statement = $conn->prepare($sql);
            $statement->bindParam(':id',$id);
            $id = $_GET["id"];
            $statement->execute();
            $result = $statement->fetchAll();
            
            echo "<table class='table table-hover'>";
            
            //echo"<tr><td><a href='details.php?id=".$row["Id"].">'>".$row["Id"]."</a></td><td>".$row["Prenoms"]."</td><td>".$row["Nom"]."</td><td>".$row["Adresse"]."</td><td>".$row["Email"]."</td><td><a href='Supprimer.php'>".$row["Id"]."</a></td><td><a href='Modifier.php'>".$row["Id"]."</a></td></tr>";
            foreach ($result as $r){
                echo "<tr class='table-primary'><td colspan='2'>".$r['Prenoms']." ".$r['Nom']."</td></tr>";
                echo "<tr class='table-secondary'><td>Id</td><td>".$r['Id']."</td></tr>";
                echo "<tr class='table-light'><td>Prenoms</td><td>".$r['Prenoms']."</td></tr>";
                echo "<tr class='table-secondary'><td>Nom</td><td>".$r['Nom']."</td></tr>";
                echo "<tr class='table-light'><td>Telephone</td><td>".$r['Telephone']."</td></tr>";
                echo "<tr class='table-secondary'><td>Adresse</td><td>".$r['Adresse']."</td></tr>";
                echo "<tr class='table-class='table-light'><td>Email</td><td>".$r['Email']."</td></tr>";
            }
            echo "</table>";

        }catch(PDOException $e){
            echo "Connection failed: " . $e->getMessage();
        }
    }else{
        header("Location:admin.php?msg=pas de details");
    }
?>