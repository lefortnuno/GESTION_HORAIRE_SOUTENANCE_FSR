<?php
require '../config/config.php';

if(!empty($_SESSION["id"])){
    header("Location: ../index.php");
}

if(isset($_POST["submit"])){
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $email = $_POST["email"];
    $mdp = $_POST["mdp"];
    $cmdp = $_POST["cmdp"];

    $dupliquer = mysqli_query($conn, "SELECT * FROM tb_user WHERE email = '$email'");
    if(mysqli_num_rows($dupliquer) > 0){
        echo
        "<script> alert('Votre Email existe déjà dans la base de donnée !'); </script>";
    }else {
        if($mdp == $cmdp){
            $query = "INSERT INTO tb_user(nom, prenom, email, mdp) VALUES( '$nom', '$prenom', '$email', '$mdp')";
            mysqli_query($conn, $query); 
            echo
            "<script> alert('Enregistrement reussi.'); </script>";
        } else{
            echo
            "<script> alert('Les mot de passe ne correspondent pas !'); </script>";
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enregistrement</title>
</head>
<body>
    <h2>S'enregistrer</h2>
    <form class="" action="" method="post" autocomplete="off">
        <label for="nom">Nom : </label>
        <input type="text" name="nom" id="nom" required value="">  

        <label for="prenom">Prénom : </label>
        <input type="text" name="prenom" id="prenom" value=""> 
        
        <label for="email">Email : </label>
        <input type="email" name="email" id="email" required value="">  
        
        <label for="mdp">Mot de passe : </label>
        <input type="password" name="mdp" id="mdp" required value="">  
        <label for="cmdp">Confirmer mot de passe : </label>
        <input type="password" name="cmdp" id="cmdp" required value="">  

        <button type="submit" name="submit">Enregistrer</button>
    </form>

    <br/>
    <a href="login.php">S'authentifier</a>
</body>
</html>