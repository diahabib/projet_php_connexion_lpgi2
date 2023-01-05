<?php session_start()?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

    <?php if (isset($_SESSION['login']) && isset($_SESSION['mdp'])): ?>
        <header>
            <div id="container">
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="admin.php">Aller à la page admin</a></li>
                    </ol>
                    
                    
                </div>    
                <div>
                    <h1>Page d'accueil</h1>
                </div>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="deconnexion.php">Se déconnecter</a></li>
                    </ol>
                    
                </div>
            </div>
        </header>
        
        
        <div style="margin: auto;  text-align: center;margin-top: 5rem">
        <h2>Emphasis classes</h2>
        <p class="text-muted">Fusce dapibus, tellus ac cursus commodo, tortor mauris nibh.</p>
        <p class="text-primary">Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
        <p class="text-secondary">Pellentesque ornare sem lacinia quam venenatis vestibulum.</p>
        <p class="text-warning">Etiam porta sem malesuada magna mollis euismod.</p>
        <p class="text-danger">Donec ullamcorper nulla non metus auctor fringilla.</p>
        <p class="text-success">Duis mollis, est non commodo luctus, nisi erat porttitor ligula.</p>
        <p class="text-info">Maecenas sed diam eget risus varius blandit sit amet non magna.</p>
        </div>
    <?php else: ?>
    <div class="card border-primary mb-3" style="max-width: 25rem; height: 20rem;max-height: 20rem; margin: auto; margin-top: 10px;">
        <div class="card-header"  style="font-size: 1.5em;">Page de connexion</div>
        <div class="card-body">
            <form action="index.php" method="POST" id="form1" class="card-header">
                <fieldset>
                    <legend></legend>
                    <input type="text" id="login" name="login" placeholder="Login" class="form-control" /><br>
                    <input type="password" id="mdp" name="mdp" placeholder="Mot de passe" class="form-control"/><br><br>
                    <button type="submit" id="connect" class="btn btn-primary">Se connecter</button>
                </fieldset>
            </form>
        </div>
    </div>
    <?php 
    include('conn.php');
        

        if (!isset($_POST['login']) || !isset($_POST['mdp'])){  
                $message = "<span class='alert alert-dismissible alert-primary' style='position:relative; bottom:5rem'>Saisir login et mot de passe</span>";
                echo $message;
                //header("Location:index.php?msg=$mess");
        }else{
            try{$conn = new PDO("mysql:host=$server;dbname=$bd",$loginServer,$mdpServer);
                $conn->setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
               // echo "Connected successfully";
                $login = $_POST["login"];
                $mdp = $_POST["mdp"];

                $sql = "SELECT * FROM etudiants WHERE login = '$login' AND Mdp = '$mdp'";
                $result = $conn->query($sql);
                echo $result->rowCount() ;
                if ($result->rowCount() > 0){
                    $_SESSION['login'] = $_POST['login'];
                    $_SESSION['mdp'] = $_POST['mdp'];
                    $message= "<h3 class='alert alert-dismissible alert-success'>Bienvenue dans page d'administration du site, $login !</h3>";
                    header("Location:admin.php?msg=$message");
                }else{
                    $message="<span class='alert alert-dismissible alert-danger'>Login ou mot de passe incorrect!!</span>";
                    header("Location:index.php?msg=$message");
                }
            }catch(PDOException $e){
                echo "Connection failed: " . $e->getMessage();
            }

        }

        if (isset($_REQUEST['msg'])){
            echo "<br>".$_REQUEST['msg'];
        }
    ?>
    <?php endif; ?>
    
</body>
</html>