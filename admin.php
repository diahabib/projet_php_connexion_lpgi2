<?php session_start()?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page admin</title>    
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script>
        function showTable(str,type){
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200){
                    document.getElementById("liste").innerHTML = this.responseText;
                }
            };
            xhttp.open("GET", "listetudiants.php?q=" + str + "& t=" + type, true);
            xhttp.send();
        }
    </script>
</head>
<body>
    <header>
        <div id="container">
            <div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active"><a href="index.php">Page d'accueil</a></li>
                </ol>
                
                
            </div>    
            <div>
                <h1>Page d'administration</h1>
            </div>
            <div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active"><a href="deconnexion.php">Se déconnecter</a></li>
                </ol>
                
            </div>
        </div>
    </header>
    
    
    
    <?php
    
        if (!isset($_SESSION['login']) ||!isset($_SESSION['mdp'])){
            $msg = "<br><span class='msg3'>Vous êtes deconnecté. Veuillez-vous connecter svp!</span>";
            header("location:index.php?$msg");
        }
        
        if (isset($_REQUEST['msg'])){
            echo ($_REQUEST['msg']);
        }

        
    ?>
    <p id="liste">
        <script>showTable("","Id");</script>
    </p>

    <div class="ajt" >
    <button class="btn btn-lg btn-primary" type="button" ><a href="ajouter.php" class="ajout">Ajouter un nouvel utilisateur</a></button>
    </div>
    
    
    
    
    <h3></h3>
<div class="card text-white bg-primary mb-3" style="max-width: 100%; margin: auto">
  <div class="card-header" style="margin: auto;margin-bottom: -2%; color:brown; font-size: 1.5em">Formulaire de recherche par :</div>
  <div class="card-body">
    <form action="admin.php" method="post" > 
        <fieldset>
            <div style="display: flex;justify-content: space-between;">
                <div>
                    <label for="id" class="form-label mt-4">Id</label>
                    <input type="text" name="id" class="form-control" onkeyup="showTable(this.value,'Id')">
                </div>
                <div class="form-group">
                    <label for="prenoms" class="form-label mt-4">Prenoms</label>
                    <input type="text" class="form-control" id="prenoms" name="prenoms" onkeyup="showTable(this.value, 'Prenoms')">
                </div>
                <div>
                    <label for="nom" class="form-label mt-4">Nom</label>
                    <input type="text" class="form-control" id="nom" name="nom" onkeyup="showTable(this.value,'Nom')">
                </div>
                <div>
                    <label for="email" class="form-label mt-4">Email</label>
                    <input type="text" class="form-control" id="email" name="email" onkeyup="showTable(this.value,'Email')">
                </div>
                <div class="form-group">
                <label for="adresse" class="form-label mt-4">Adresse</label>
                <input type="text" class="form-control" id="adresse" name="adresse" onkeyup="showTable(this.value, 'Adresse')">
                </div>
                <div class="form-group">
                
                <label for="tel" class="form-label mt-4">Telephone</label>
                <input type="text" class="form-control" id="tel" name="tel" onkeyup="showTable(this.value, 'Telephone')">
                </div>
            </div>
            
        </fieldset>
    </form>
    
    </div>
    </div>
        
</body>
</html>