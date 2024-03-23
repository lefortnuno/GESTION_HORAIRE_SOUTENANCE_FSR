<?php
require '../config/config.php';

if (!empty ($_SESSION["id"])) {
    header("Location: ../index.php");
}

if (isset ($_POST["submit"])) {
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $email = $_POST["email"];
    $mdp = $_POST["mdp"];
    $cmdp = $_POST["cmdp"];

    $dupliquer = mysqli_query($conn, "SELECT * FROM tb_user WHERE email = '$email'");
    if (mysqli_num_rows($dupliquer) > 0) {
        echo
            "<script> alert('Votre Email existe déjà dans la base de donnée !'); </script>";
    } else {
        if ($mdp == $cmdp) {
            $query = "INSERT INTO tb_user(nom, prenom, email, mdp) VALUES( '$nom', '$prenom', '$email', '$mdp')";
            mysqli_query($conn, $query);
            echo
                "<script> alert('Enregistrement reussi.'); </script>";
        } else {
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
    <link rel="stylesheet" type="text/css" href="../files/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../files/css/form.css">
</head>

<body>
    <div class="containerForm" style="margin-top: 0%;">
        <header>S'enregistrer</header>

        <form action="" method="post" autocomplete="off">
            <div class="form first">
                <div class="details personal">
                    <span class="title"> Détails personnels</span>

                    <div class="fields">
                        <div class="input-field">
                            <label>Code Apogée </label>
                            <input type="number" placeholder="Enter ID type" name="codeApogee" id="codeApogee" value=""
                                required>
                        </div>

                        <div class="input-field">
                            <label>Email </label>
                            <input type="email" placeholder="Enter ID number" name="email" id="email" value="" required>
                        </div>

                        <div class="input-field">
                            <label>Nom </label>
                            <input type="text" placeholder="Enter your name" name="nom" id="nom" value="" required>
                        </div>

                        <div class="input-field">
                            <label>Prénom</label>
                            <input type="text" placeholder="Enter your email" name="prenom" id="prenom" value=""
                                required>
                        </div>

                        <div class="input-field">
                            <label>Téléphone </label>
                            <input type="number" placeholder="Enter mobile number" name="numTel" id="numTel" value=""
                                required>
                        </div>

                        <div class="input-field">
                            <label>Adresse </label>
                            <input type="text" placeholder="Enter your email" name="adresse" id="adresse" value=""
                                required>
                        </div>

                        <div class="input-field">
                            <label>Mot de passe </label>
                            <input type="password" placeholder="Enter your occupation" name="mdp" id="mdp" value=""
                                required>
                        </div>

                        <div class="input-field">
                            <label>Confirmation mot de passe </label>
                            <input type="password" placeholder="Enter birth date" name="cmdp" id="cmdp" value=""
                                required>
                        </div>
                    </div>
                </div>

                <div class="details family ">
                    <div class="buttons fieldsForButtons">
                        <a class="backBtn btn btn-primary" href="login.php" class="btnText"
                            style="text-decoration: none; color:#fff;">
                            <i class="uil uil-navigator"></i>
                            <span>S'authentifier</span>
                        </a>

                        <button class="sumbit btn btn-success backBtn2" type="submit" name="submit">
                            <span class="btnText">Enregistrer</span>
                            <i class="uil uil-navigator"></i>
                        </button>
                    </div>
                </div>
            </div>

        </form>
    </div>
</body>

</html>