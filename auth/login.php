<?php
require "../config/config.php";

if (!empty ($_SESSION["id"])) {
    header("Location: ../index.php");
}

if (isset ($_POST["submit"])) {
    $email = $_POST["email"];
    $mdp = $_POST["mdp"];

    $result = mysqli_query($conn, "SELECT * FROM tb_user WHERE email = '$email'");
    $row = mysqli_fetch_assoc($result);

    if (mysqli_num_rows($result) > 0) {
        if ($mdp == $row["mdp"]) {
            $_SESSION["login"] = true;
            $_SESSION["id"] = $row["id"];

            echo
                "<script> alert('Connection reussi.'); </script>";

            header("Location: ../index.php");
        } else {
            echo
                "<script> alert('Mot de passe incorrect !'); </script>";
        }
    } else {
        echo
            "<script> alert('Ce compte n\\'existe pas !'); </script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>S'authentifier</title>
    <link rel="stylesheet" href="../files/css/login.css">
</head>

<body>
    <div class="box">
        <form class="container" action="" method="post" autocomplete="off">
            <div class="top-header">
                <span>Email Institutionnel</span>
                <header>Session d'Authentification</header>
            </div>

            <div class="input-field">
                <input type="email" name="email" id="email" required value="" class="input"
                    placeholder="Email Institutionnel" required />
                <i class="bx bx-user"></i>
            </div>
            <div class="input-field">
                <input type="password" name="mdp" id="mdp" required value="" class="input" placeholder="Mot de passe"
                    required />
                <i class="bx bx-lock-alt"></i>
            </div>
            <div class="input-field">
                <input type="submit" name="submit" class="submit" value="S'authentifier" />
            </div>

            <div class="bottom">
                <div class="left">
                    <label>
                        <a href="codeApogee.php">Par Code Apogée</a></label>
                </div>

                <div class="right">
                    <label>
                        <a href="registration.php">Créer un compte !</a></label>
                </div>
        </form>
    </div>
    </div>

    <!-- <h2>S'authentifier</h2>
    <form action="" class="" method="post" autocomplete="off">
        <label for="email"> Adresse electronique : </label>
        <input type="email" name="email" id="email" required value="">

        <label for="mdp"> Mot de passe : </label>
        <input type="password" name="mdp" id="mdp" required value="">

        <button type="submit" name="submit">S'authentifier</button>
    </form>

    <br />
    <a href="registration.php">S'enregistrer</a> -->
</body>

</html>