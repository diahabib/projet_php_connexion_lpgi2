<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
</html>

<?php
    session_start();
    unset($_SESSION['login']);
    unset($_SESSION['mdp']);
    session_destroy();
    $msg = "<br><span class='alert alert-dismissible alert-danger' class='invalid-feedback'>Vous venez de vous déconnecter !</span>";
    header("Location:index.php?msg=$msg");
?>