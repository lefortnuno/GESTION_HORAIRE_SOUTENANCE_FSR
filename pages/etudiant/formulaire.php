<?php
require '../../config/config.php';

if (!empty($_SESSION["codeApogee"])) {
    $codeApogee = $_SESSION["codeApogee"];
    $result = mysqli_query($conn, "SELECT * FROM tb_user WHERE codeApogee = $codeApogee");
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
        <!-- <h1 class="page-header text-cEntrez votre">ETUDIANT EN DOCTORAT</h1> -->
        <div class="row">
            <!-- <div class="col-lg-12 col-lg-offset-2">  -->
            <div class="">
                <!-- Mes message d'alert et de notification -->
                <?php
                // session_start();
                if (isset($_SESSION['message'])) {
                    ?>
                    <div class="alert alert-success text-cEntrez votre" style="margin-top:20px;">
                        <?php echo $_SESSION['message']; ?>
                    </div>
                    <?php

                    unset($_SESSION['message']);
                }

                if (isset($_SESSION['errorMessage'])) {
                    ?>
                    <div class="alert alert-danger text-cEntrez votre" style="margin-top:20px;">
                        <?php echo $_SESSION['errorMessage']; ?>
                    </div>
                    <?php

                    unset($_SESSION['errorMessage']);
                }
                ?>

                <div class="containerForm">
                    <header>Validation</header>

                    <form method="POST"
                        action="http://localhost/PROJET/GESTION_HORAIRE_SOUTENANCE_FSR/crud/crudPHP/edit.php"
                        autocomplete="off">
                        <div class="form first">
                            <div class="details personal">
                                <span class="title"> Détails personnels</span>

                                <div class="fields">
                                    <div class="input-field">
                                        <label>Code Apogée </label>
                                        <input type="number" placeholder="Entrez votre Code Apogée" name="codeApogee"
                                            id="codeApogee" value="<?php echo $row['codeApogee']; ?>" readonly
                                            style="background-color:rgba(13, 0, 0, 0.2);">
                                    </div>

                                    <div class="input-field">
                                        <label>Nom </label>
                                        <input required type="text" placeholder="Entrez votre nom" name="nom" id="nom"
                                            value="<?php echo $row['nom']; ?>">
                                    </div>

                                    <div class="input-field">
                                        <label>Prénom</label>
                                        <input required type="text" placeholder="Entrez votre prénom" name="prenom"
                                            id="prenom" value="<?php echo $row['prenom']; ?>">
                                    </div>

                                    <div class="input-field">
                                        <label>Date de naissance </label>
                                        <input required type="date" placeholder="Entrez votre date de naissance"
                                            name="dateNaiss" id="dateNaiss" value="">
                                    </div>

                                    <div class="input-field">
                                        <label>Genre </label>
                                        <select name="sexe" id="sexe" value="">
                                            <option disabled selected>Choix du sexe </option>
                                            <option value="H">Homme</option>
                                            <option value="F">Femme</option>
                                        </select>
                                    </div>

                                    <div class="input-field">
                                        <label>Téléphone </label>
                                        <input required type="number" placeholder="Entrez votre numéro de téléphone"
                                            name="numTel" id="numTel" value="<?php echo $row['numTel']; ?>">
                                    </div>

                                    <div class="input-field">
                                        <label>Adresse </label>
                                        <input required type="text" placeholder="Entrez votre adresse" name="adresse"
                                            id="adresse" value="<?php echo $row['adresse']; ?>">
                                    </div>

                                    <div class="input-field">
                                        <label>Email </label>
                                        <input required type="email" placeholder="Entrez votre email" name="email"
                                            id="email" value="<?php echo $row['email']; ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="details ID">
                                <span class="title"> Détails du mémoire</span>

                                <div class="fields">
                                    <div class="input-field">
                                        <label>Titre </label>
                                        <input required type="text" placeholder="Saisissez le titre" name="titre"
                                            id="titre" value="">
                                    </div>

                                    <div class="input-field">
                                        <label>Thème </label>
                                        <select name="theme" id="theme" value="">
                                            <option disabled selected>Choix du Théme</option>
                                            <option>T1</option>
                                            <option>T2</option>
                                            <option>T3</option>
                                            <option>T4</option>
                                            <option>T5</option>
                                        </select>
                                    </div>

                                    <div class="input-field">
                                        <label>Abstract </label>
                                        <input required type="text" placeholder="Saisissez l'abstract" name="abstract"
                                            id="abstract" value="">
                                    </div>

                                    <div class="input-field">
                                        <label>Mot clé </label>
                                        <input required type="text" placeholder="Saisissez le mot clé" name="keywords"
                                            id="keywords" value="">
                                    </div>

                                    <div class="input-field">
                                        <label>Disciplines </label>
                                        <select name="disciplines" id="disciplines" value="">
                                            <option disabled selected>Choix de la discipline</option>
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
                                        <input required type="text" placeholder="Saisissez votre Specialité"
                                            name="specialite" id="specialite" value="">
                                    </div>

                                    <div class="input-field">
                                        <label>Institution </label>
                                        <select name="institution" id="institution" value="">
                                            <option disabled selected>Choix de l'institution</option>
                                            <option>A</option>
                                            <option>B</option>
                                            <option>C</option>
                                            <option>D</option>
                                            <option>E</option>
                                        </select>
                                    </div>

                                    <div class="input-field">
                                        <label>Structure</label>
                                        <input required type="text" placeholder="Saisissez votre Structure"
                                            name="structure" id="structure" value="">
                                    </div>
                                </div>
                            </div>

                            <div class="details address">
                                <span class="title">Détails superviseur</span>

                                <div class="fields">
                                    <div class="input-field">
                                        <label>Nom </label>
                                        <input required type="text" placeholder="Nom du superviseur" name="nomSup"
                                            id="nomSup" value="">
                                    </div>

                                    <div class="input-field">
                                        <label>Prénom</label>
                                        <input required type="text" placeholder="Prénom du superviseur" name="prenomSup"
                                            id="prenomSup" value="">
                                    </div>
                                    <div class="input-field">
                                        <label>Email </label>
                                        <input required type="email" placeholder="Email du superviseur" name="emailSup"
                                            id="emailSup" value="">
                                    </div>

                                    <div class="input-field">
                                        <label>Institution </label>
                                        <select name="institutionSup" id="institutionSup" value="">
                                            <option disabled selected>Institution du superviseur</option>
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
                                        <input required type="text" placeholder="Nom du co-superviseur" name="nomCoSup"
                                            id="nomCoSup" value="">
                                    </div>

                                    <div class="input-field">
                                        <label>Prénom</label>
                                        <input required type="text" placeholder="Prénom du co-superviseur"
                                            name="prenomCoSup" id="prenomCoSup" value="">
                                    </div>
                                    <div class="input-field">
                                        <label>Email </label>
                                        <input required type="email" placeholder="Email du co-superviseur"
                                            name="emailCoSup" id="emailCoSup" value="">
                                    </div>

                                    <div class="input-field">
                                        <label>Institution </label>
                                        <select name="institutionCoSup" id="institutionCoSup" value="">
                                            <option disabled selected>Institutiondu co-superviseur</option>
                                            <option>A</option>
                                            <option>B</option>
                                            <option>C</option>
                                            <option>D</option>
                                            <option>E</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="buttons fieldsForButtons">
                                    <a href="http://localhost/PROJET/GESTION_HORAIRE_SOUTENANCE_FSR/index.php"
                                        class="backBtn btn btn-danger">
                                        <i class="uil uil-navigator"></i>
                                        <span class="btnText">Annuler</span>
                                    </a>

                                    <button type="submit" name="edit" class="sumbit btn btn-success backBtn2">
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