<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title
    <link rel="stylesheet" href="css/modifier.css"/>
    <link rel="stylesheet" href="css/bootstrap.min.css"/>
    
</head>
<body>
      
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Page d'accueil</a></li>
        <li class="breadcrumb-item"><a href="admin.php">Retourner à la page admin</a> </li>
        <li class="breadcrumb-item active">modifier</li>
    </ol> 
    <?php
        if (isset($_REQUEST["id"])) {
            $i = $_REQUEST["id"];
            include("conn.php");

            try{
                $conn = new PDO("mysql:host=$server;dbname=$bd",$loginServer,$mdpServer);
                $conn->setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
                $sql = "SELECT * FROM etudiants WHERE Id = '$i'";
                $result = $conn->query($sql);

                foreach($result as $r){
                    $prenoms= $r['Prenoms'];
                    $nom= $r['Nom'];
                    $login = $r['Login'];
                    $mdp = $r['Mdp'];
                    $email= $r['Email'];
                    $adresse=$r['Adresse'];
                }
                $tel= $r['Telephone'];
            }catch(PDOException $e){
                echo "Connection failed: " . $e->getMessage();
            }
        }
            
    ?>
<div class="card text-white bg-primary mb-3" style="max-width: 40rem; margin: auto">
  <div class="card-header">Modification</div>
  <div class="card-body">
    <form action="modifier.php" method="post"  > 
        <fieldset>
            <div class="form-group">
                <label class="form-label mt-4" for="id">Id</label>
                <input class="form-control" type="text" name="id" id="id" value="<?php echo $i;?>" readonly="">
            </div>
            <div class="groups" style="display: flex;justify-content: space-between;">
                <div>
                    <div class="form-group">
                        <label for="prenoms" class="form-label mt-4">Prenoms</label>
                        <input type="text" name="prenoms" class="form-control"  value="<?php echo $prenoms;?>">
                    </div>
                </div>
                <div>
                    <div class="form-group">
                        <label for="nom" class="form-label mt-4">Nom</label>
                        <input type="text" class="form-control" id="nom" name="nom" value="<?php echo $nom;?>">
                    </div>
                </div>
            </div> 
            <div class="groups" style="display: flex;justify-content: space-between;">
                <div>
                    <label for="login" class="form-label mt-4">Login</label>
                    <input type="login" class="form-control" id="login" name="login" value="<?php echo $login;?>">
                </div>
                <div>
                    <label for="mdp" class="form-label mt-4">Mot de passe</label>
                    <input type="password" class="form-control" id="mdp" name="mdp" value="<?php echo $mdp;?>">
                </div>
            </div>   
                
                
            <div class="form-group">
                <label for="email" class="form-label mt-4">email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $email;?>">
            </div>
            <div style="display: flex;justify-content: space-between;">
            <div class="form-group">
                <label for="adresse" class="form-label mt-4">Adresse</label>
                <input type="text" class="form-control" id="adresse" name="adresse" value="<?php echo $adresse;?>">
                </div>
                <div class="form-group">
                <label for="tel" class="form-label mt-4">Telephone</label>
                <input type="number" class="form-control" id="tel" name="tel" value="<?php echo $tel;?>">
                </div>
            </div>
                
            <div style="margin: auto; text-align: center">   
                <div class="form-group" style="margin-top: 20px">
                    <button type="submit" class="btn btn-outline-light" >confirmer</button>
                </div>
            </div> 
            
        </fieldset>
    </form>
    
    </div>
    </div>      


    <?php 
        //f(isset($_REQUEST['adresse']))
          //  $prenoms = $_REQUEST['adresse'];
        //echo $prenoms; //$_REQUEST['nom'] $_REQUEST['login'] $_REQUEST['mdp'] $_REQUEST['email'] $_REQUEST['adresse'] $_REQUEST $_REQUEST['id'];
        if(isset($_REQUEST['id']) && isset($_REQUEST['prenoms']) && isset($_REQUEST['nom']) && isset($_REQUEST['login']) && isset($_REQUEST['mdp']) && isset($_REQUEST['email']) && isset($_REQUEST['adresse']) && isset($_REQUEST['tel'])){        
            $prenoms = $_REQUEST['prenoms'];
            $nom = $_REQUEST['nom'];
            $login = $_REQUEST['login'];
            $mdp = $_REQUEST['mdp'];
            $email = $_REQUEST['email'];
            $adresse = $_REQUEST['adresse'];
            $tel = intval($_REQUEST['tel']);                
            $id = $_REQUEST['id'];
         
            $sql  = "UPDATE etudiants SET Prenoms = '$prenoms', Nom = '$nom', Email = '$email', Adresse = '$adresse', Telephone = '$tel', Login = '$login', Mdp = '$mdp' WHERE Id = '$id' ";
            $statement = $conn->prepare($sql);
            $statement->execute();              
                
            header("Location:admin.php?msg=Modification réussi");
         
        }
        
    ?>

</body>
</html>