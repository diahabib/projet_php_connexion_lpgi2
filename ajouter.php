<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    
</head>
<body>
    
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Page d'accueil</a></li>
        <li class="breadcrumb-item"><a href="admin.php">Retourner à la page admin</a> </li>
        <li class="breadcrumb-item active">Ajouter nouvel utilisateur</li>
    </ol>
<div class="card border-primary mb-3" style="max-width: 40rem; margin: auto">
  <div class="card-header">Ajout Utilisateur</div>
  <div class="card-body">
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" > 
        <fieldset>
            <div class="form-group">
                <label class="form-label mt-4" for="id">Id</label>
                <input class="form-control" type="text" name="id" id="id"readonly="">
            </div>
            <div class="groups" style="display: flex;justify-content: space-between;">
                <div>
                    <div class="form-group">
                        <label for="prenoms" class="form-label mt-4">Prenoms</label>
                        <input type="text" name="prenoms" class="form-control">
                    </div>
                </div>
                <div>
                    <div class="form-group">
                        <label for="nom" class="form-label mt-4">Nom</label>
                        <input type="text" class="form-control" id="nom" name="nom" >
                    </div>
                </div>
            </div> 
            <div class="groups" style="display: flex;justify-content: space-between;">
                <div>
                    <label for="login" class="form-label mt-4">Login</label>
                    <input type="login" class="form-control" id="login" name="login">
                </div>
                <div>
                    <label for="mdp" class="form-label mt-4">Mot de passe</label>
                    <input type="password" class="form-control" id="mdp" name="mdp" >
                </div>
            </div>   
                
                
            <div class="form-group">
                <label for="email" class="form-label mt-4">email</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>
            <div style="display: flex;justify-content: space-between;">
            <div class="form-group">
                <label for="adresse" class="form-label mt-4">Adresse</label>
                <input type="text" class="form-control" id="adresse" name="adresse">
                </div>
                <div class="form-group">
                <label for="tel" class="form-label mt-4">Telephone</label>
                <input type="number" class="form-control" id="tel" name="tel">
                </div>
            </div>
                
            <div style="margin: auto; text-align: center">   
                <div class="form-group" style="margin-top: 20px">
                    <button type="submit" class="btn btn-primary" >confirmer</button>
                </div>
            </div> 
            
        </fieldset>
    </form>
    
    </div>
    </div>  
    <?php
    include("conn.php");
        if(isset($_REQUEST['prenoms'])  && isset($_REQUEST['nom']) && isset($_REQUEST['login']) && isset($_REQUEST['mdp']) && isset($_REQUEST['email']) && isset($_REQUEST['adresse']) && isset($_REQUEST['tel'])){        
                $prenom = $_REQUEST['prenoms'];
                $nom = $_REQUEST['nom'];
                $login = $_REQUEST['login'];
                $mdp = $_REQUEST['mdp'];
                $email = $_REQUEST['email'];
                $adresse = $_REQUEST['adresse'];
                $telephone = intval($_REQUEST['tel']);
            try{
                $conn = new PDO("mysql:host=$server;dbname=$bd",$loginServer,$mdpServer);
                $conn->setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            
                $conn->beginTransaction();
                $sql  = "INSERT INTO etudiants(Prenoms, Nom, Login, Mdp, Email, Adresse, Telephone)  VALUES('$prenom', '$nom', '$login', '$mdp','$email', '$adresse', '$telephone')  ";
                $conn->exec($sql);
                $conn->commit();             
                
            header("Location:admin.php?msg=Ajout de l'utilisateur réussi");
            
            }catch(PDOException $e){
                $conn->rollback();
                echo "Connection failed: " . $e->getMessage();
                header("Location:admin.php?msg=Ajout de l'utilisateur échoué");
            }
         
        }
    ?>

</body>
</html>