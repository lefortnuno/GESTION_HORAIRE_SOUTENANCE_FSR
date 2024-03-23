<?php
require '../../config/config.php';

if (!empty ($_SESSION["id"])) {
    $id = $_SESSION["id"];
    $result = mysqli_query($conn, "SELECT * FROM tb_user WHERE id = $id");
    $row = mysqli_fetch_assoc($result);
} else {
    header("Location: auth/login.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    <link rel="stylesheet" type="text/css" href="../../files/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../../files/css/nav.css">
    <link rel="stylesheet" type="text/css" href="../../files/css/form.css">
</head>

<body>


    <?php
    include ('../header/navbar.php');
    ?>

    <div class="container">
        <!-- <h1 class="page-header text-center">ETUDIANT EN DOCTORAT</h1> -->
        <div class="row">
            <!-- <div class="col-lg-12 col-lg-offset-2">  -->
            <div class="">
                <!-- Mes message d'alert et de notification -->
                <?php
                // session_start();
                if (isset ($_SESSION['message'])) {
                    ?>
                    <div class="alert alert-success text-center" style="margin-top:20px;">
                        <?php echo $_SESSION['message']; ?>
                    </div>
                    <?php

                    unset($_SESSION['message']);
                }

                if (isset ($_SESSION['errorMessage'])) {
                    ?>
                    <div class="alert alert-danger text-center" style="margin-top:20px;">
                        <?php echo $_SESSION['errorMessage']; ?>
                    </div>
                    <?php

                    unset($_SESSION['errorMessage']);
                }
                ?>


                <div class="containerForm">
                    <header>Validation</header>

                    <form method="POST" action="crud/crudPHP/edit.php" autocomplete="off">
                        <div class="form first">
                            <div class="details personal">
                                <span class="title"> Détails personnels</span>

                                <div class="fields">
                                    <div class="input-field">
                                        <label>Code Apogée </label>
                                        <input type="number" placeholder="Enter ID type" name="codeApogee"
                                            id="codeApogee" value="<?php echo $row['id']; ?>">
                                    </div>

                                    <div class="input-field">
                                        <label>Nom </label>
                                        <input type="text" placeholder="Enter your name" name="nom" id="nom"
                                            value="<?php echo $row['nom']; ?>">
                                    </div>

                                    <div class="input-field">
                                        <label>Prénom</label>
                                        <input type="text" placeholder="Enter your email" name="prenom" id="prenom"
                                            value="<?php echo $row['prenom']; ?>">
                                    </div>

                                    <div class="input-field">
                                        <label>Date de naissance </label>
                                        <input type="date" placeholder="Enter birth date" name="datenaiss"
                                            id="datenaiss" value="">
                                    </div>

                                    <div class="input-field">
                                        <label>Genre </label>
                                        <select name="sexe" id="sexe" value="">
                                            <option disabled selected>Choix du sexe </option>
                                            <option>Homme</option>
                                            <option>Femme</option>
                                        </select>
                                    </div>

                                    <div class="input-field">
                                        <label>Téléphone </label>
                                        <input type="number" placeholder="Enter mobile number" name="numTel" id="numTel"
                                            value="">
                                    </div>

                                    <div class="input-field">
                                        <label>Adresse </label>
                                        <input type="text" placeholder="Enter your ccupation" name="adresse"
                                            id="adresse" value="">
                                    </div>

                                    <div class="input-field">
                                        <label>Email </label>
                                        <input type="email" placeholder="Enter ID number" name="email" id="email"
                                            value="<?php echo $row['email']; ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="details ID">
                                <span class="title"> Détails du mémoire</span>

                                <div class="fields">
                                    <div class="input-field">
                                        <label>Titre </label>
                                        <input type="text" placeholder="Enter issued authority" name="titre" id="titre"
                                            value="">
                                    </div>

                                    <div class="input-field">
                                        <label>Thème </label>
                                        <select name="theme" id="theme" value="">
                                            <option disabled selected>Choisir de Théme</option>
                                            <option>T1</option>
                                            <option>T2</option>
                                            <option>T3</option>
                                            <option>T4</option>
                                            <option>T5</option>
                                        </select>
                                    </div>

                                    <div class="input-field">
                                        <label>Abstract </label>
                                        <input type="text" placeholder="Enter issued state" name="abstract"
                                            id="abstract" value="">
                                    </div>

                                    <div class="input-field">
                                        <label>Mot clé </label>
                                        <input type="text" placeholder="Enter your issued date" name="keywords"
                                            id="keywords" value="">
                                    </div>

                                    <div class="input-field">
                                        <label>Disciplines </label>
                                        <select name="disciplines" id="disciplines" value="">
                                            <option disabled selected>Choisir l'institution</option>
                                            <option>Math</option>
                                            <option>Info</option>
                                            <option>Bio</option>
                                            <option>Géo</option>
                                            <option>Chime</option>
                                            <option>Physique</option>
                                        </select>
                                    </div>

                                    <div class="input-field">
                                        <label>Specialité </label>
                                        <input type="text" placeholder="Enter expiry date" name="specialite"
                                            id="specialite" value="">
                                    </div>

                                    <div class="input-field">
                                        <label>Institution </label>
                                        <select name="institution" id="institution" value="">
                                            <option disabled selected>Choisir l'institution</option>
                                            <option>A</option>
                                            <option>B</option>
                                            <option>C</option>
                                            <option>D</option>
                                            <option>E</option>
                                        </select>
                                    </div>

                                    <div class="input-field">
                                        <label>Structure</label>
                                        <input type="text" placeholder="Enter mobile number" name="structure"
                                            id="structure" value="">
                                    </div>
                                </div>
                            </div>

                            <div class="details address">
                                <span class="title">Détails superviseur</span>

                                <div class="fields">
                                    <div class="input-field">
                                        <label>Nom </label>
                                        <input type="text" placeholder="Enter your name" name="nomSup" id="nomSup"
                                            value="">
                                    </div>

                                    <div class="input-field">
                                        <label>Prénom</label>
                                        <input type="text" placeholder="Enter your email" name="prenomSup"
                                            id="prenomSup" value="">
                                    </div>
                                    <div class="input-field">
                                        <label>Email </label>
                                        <input type="email" placeholder="Enter ID number" name="emailSup" id="emailSup"
                                            value="">
                                    </div>

                                    <div class="input-field">
                                        <label>Institution </label>
                                        <select name="institutionSup" id="institutionSup" value="">
                                            <option disabled selected>Choisir l'institution</option>
                                            <option>A</option>
                                            <option>B</option>
                                            <option>C</option>
                                            <option>D</option>
                                            <option>E</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="details family">
                                <span class="title">Détails co-superviseur</span>

                                <div class="fields">
                                    <div class="input-field">
                                        <label>Nom </label>
                                        <input type="text" placeholder="Enter your name" name="nomCoSup" id="nomCoSup"
                                            value="">
                                    </div>

                                    <div class="input-field">
                                        <label>Prénom</label>
                                        <input type="text" placeholder="Enter your email" name="prenomCoSup"
                                            id="prenomCoSup" value="">
                                    </div>
                                    <div class="input-field">
                                        <label>Email </label>
                                        <input type="email" placeholder="Enter ID number" name="emailCoSup"
                                            id="emailCoSup" value="">
                                    </div>

                                    <div class="input-field">
                                        <label>Institution </label>
                                        <select name="instititionCoSup" id="instititionCoSup" value="">
                                            <option disabled selected>Choisir l'institution</option>
                                            <option>A</option>
                                            <option>B</option>
                                            <option>C</option>
                                            <option>D</option>
                                            <option>E</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="buttons fieldsForButtons">
                                    <div class="backBtn btn btn-danger">
                                        <i class="uil uil-navigator"></i>
                                        <span class="btnText">Annuler</span>
                                    </div>

                                    <button class="sumbit btn btn-success backBtn2">
                                        <span class="btnText">Enregistrer</span>
                                        <i class="uil uil-navigator"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>


    <script src="../../files/js/jquery.min.js"></script>
    <script src="../../files/bootstrap/js/bootstrap.min.js"></script>

</body>

</html>