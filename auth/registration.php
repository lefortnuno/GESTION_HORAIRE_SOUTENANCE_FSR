<?php
require '../config/config.php';

if (!empty ($_SESSION["codeApogee"])) {
    header("Location: ../index.php");
}

if (isset ($_POST["submit"])) {
    $codeApogee = $_POST["codeApogee"];
    $email = $_POST["email"];
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $numTel = $_POST["numTel"];
    $adresse = $_POST["adresse"];
    $mdp = $_POST["mdp"];
    $cmdp = $_POST["cmdp"];

    $dupliquer = mysqli_query($conn, "SELECT * FROM tb_user WHERE email = '$email' OR codeApogee = '$codeApogee';");
    if (mysqli_num_rows($dupliquer) > 0) {
        echo
            "<script> alert('Code Apogée et/ou Email existant !'); </script>";
    } else {
        if ($mdp == $cmdp) {
            $query = "INSERT INTO tb_user(codeApogee, email, nom, prenom, numTel, adresse, mdp) VALUES('$codeApogee','$email', '$nom', '$prenom', '$numTel', '$adresse', '$mdp')";
            mysqli_query($conn, $query);
            echo
                "<script> alert('Enregistrement reussi.'); </script>";

            header("Location: login.php");
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
                            <input type="number" placeholder="Entrez votre Code Apogée" name="codeApogee"
                                id="codeApogee" value="" required>
                        </div>

                        <div class="input-field">
                            <label>Email </label>
                            <input type="email" placeholder="Entrez votre Email" name="email" id="email" value=""
                                required>
                        </div>

                        <div class="input-field">
                            <label>Nom </label>
                            <input type="text" placeholder="Entrez votre Nom" name="nom" id="nom" value="" required>
                        </div>

                        <div class="input-field">
                            <label>Prénom</label>
                            <input type="text" placeholder="Entrez votre Prénom" name="prenom" id="prenom" value=""
                                required>
                        </div>

                        <div class="input-field">
                            <label>Téléphone </label>
                            <input type="number" placeholder="Entrez votre numéro de téléphone" name="numTel"
                                id="numTel" value="" required>
                        </div>

                        <div class="input-field">
                            <label>Adresse </label>
                            <input type="text" placeholder="Entrez votre adresse" name="adresse" id="adresse" value=""
                                required>
                        </div>

                        <div class="input-field">
                            <label>Mot de passe </label>
                            <input type="password" placeholder="Entrez votre mot de passe" name="mdp" id="mdp" value=""
                                required>
                        </div>

                        <div class="input-field">
                            <label>Confirmation mot de passe </label>
                            <input type="password" placeholder="Confirmez votre mot de passe" name="cmdp" id="cmdp"
                                value="" required>
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