<?php
require "../config/config.php";

if (!empty($_SESSION["codeApogee"])) {
    header("Location: ../index.php");
}

if (isset($_POST["submit"])) {
    $codeApogee = $_POST["codeApogee"];
    $mdp = $_POST["mdp"];

    $result = mysqli_query($conn, "SELECT * FROM tb_user WHERE codeApogee = '$codeApogee'");
    $row = mysqli_fetch_assoc($result);

    if (mysqli_num_rows($result) > 0) {
        if ($mdp == $row["mdp"]) {
            $_SESSION["login"] = true;
            $_SESSION["codeApogee"] = $row["codeApogee"];
            $_SESSION['message'] = 'Connection reussi.';

            header("Location: ../index.php");
        } else {
            $_SESSION['errorMessage'] = 'Mot de passe incorrect !';
        }
    } else {
        $_SESSION['errorMessage'] = 'Ce compte n\'existe pas !';
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
                <span>Code Apogée</span>
                <header>Session d'Authentification</header>
            </div>

            <div class="input-field">
                <input type="codeApogee" name="codeApogee" id="codeApogee" required value="" class="input"
                    placeholder="Code Apogée" required />
                <i class="bx bx-user"></i>
            </div>
            <div class="input-field">
                <input type="password" name="mdp" id="mdp" required value="" class="input" placeholder="Mot de passe"
                    required />
                <i class="bx bx-lock-alt"></i>
            </div>
            <div class="input-field">
                <input type="submit" name="submit" class="submit" value="S'authentifier" />
                <?php
                if (isset($_SESSION['message'])) {
                    ?>
                    <div style="margin-top:20px; color: green; text-align: center;">
                        <?php echo $_SESSION['message']; ?>
                    </div>
                    <?php

                    unset($_SESSION['message']);
                }

                if (isset($_SESSION['errorMessage'])) {
                    ?>
                    <div style="margin-top:20px; color: red; text-align: center;">
                        <?php echo $_SESSION['errorMessage']; ?>
                    </div>
                    <?php

                    unset($_SESSION['errorMessage']);
                }
                ?>
            </div>

            <div class="bottom">
                <div class="left">
                    <label>
                        <a href="login.php">Par Email Institutionnel</a></label>
                </div>

                <div class="right">
                    <label>
                        <a href="registration.php">Créer un compte !</a></label>
                </div>
        </form>
    </div>
    </div>
</body>

</html>