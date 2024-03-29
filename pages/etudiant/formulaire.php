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
    <title>Validation</title>
    <link rel="stylesheet" type="text/css" href="../../files/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../../files/css/nav.css">
    <link rel="stylesheet" type="text/css" href="../../files/css/form.css">
</head>

<body>

    <?php
    include ('../header/navbar.php');
    ?>

    <div class="container">
        <div class="row">
            <div class="">

                <?php
                if (isset($_SESSION['message'])) {
                    ?>
                    <div class="alert alert-success text-center" style="margin-top:20px;">
                        <?php echo $_SESSION['message']; ?>
                    </div>
                    <?php

                    unset($_SESSION['message']);
                }

                if (isset($_SESSION['errorMessage'])) {
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
                                        <input type="text" placeholder="Entrez votre prénom" name="prenom" id="prenom"
                                            value="<?php echo $row['prenom']; ?>">
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
                                        <select name="theme" id="theme" value="" required>
                                            <option disabled selected>Choisir un domaine de recherche</option>
                                            <optgroup label="Sciences de la Vie">
                                                <option value="Biotechnologie Végétale">Biotechnologie Végétale</option>
                                                <option value="Génie Génétique">Génie Génétique</option>
                                            </optgroup>
                                            <optgroup label="Sciences de la Terre">
                                                <option value="Géologie Marine">Géologie Marine</option>
                                                <option value="Géophysique">Géophysique</option>
                                            </optgroup>
                                            <optgroup label="Sciences de l'Environnement">
                                                <option value="Agriculture Durable">Agriculture Durable</option>
                                                <option value="Écologie Industrielle">Écologie Industrielle</option>
                                            </optgroup>
                                            <optgroup label="Sciences de l'Espace">
                                                <option value="Astrophysique">Astrophysique</option>
                                            </optgroup>
                                            <optgroup label="Sciences de l'Informatique">
                                                <option value="Intelligence Artificielle">Intelligence Artificielle
                                                </option>
                                                <option value="Sécurité Informatique">Sécurité Informatique</option>
                                            </optgroup>
                                            <optgroup label="Sciences Mathématiques">
                                                <option value="Analyse Numérique">Analyse Numérique</option>
                                                <option value="Théorie des Graphes">Théorie des Graphes</option>
                                            </optgroup>
                                            <optgroup label="Sciences Physiques">
                                                <option value="Physique des Particules">Physique des Particules</option>
                                                <option value="Électronique Quantique">Électronique Quantique</option>
                                            </optgroup>
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
                                            <option value="Agroalimentaire">Agroalimentaire</option>
                                            <option value="Astronomie">Astronomie</option>
                                            <option value="Biologie">Biologie</option>
                                            <option value="Chimie">Chimie</option>
                                            <option value="Électronique">Électronique</option>
                                            <option value="Géologie">Géologie</option>
                                            <option value="Génie Environnemental">Génie Environnemental</option>
                                            <option value="Informatique">Informatique</option>
                                            <option value="Mathématiques">Mathématiques</option>
                                            <option value="Physique">Physique</option>
                                            <option value="Pharmacologie">Pharmacologie</option>
                                        </select>
                                    </div>

                                    <div class="input-field">
                                        <label>Specialité </label>
                                        <select name="specialite" id="specialite" value="">
                                            <option disabled selected>Choix de Spécialisation</option>
                                            <optgroup label="Agroalimentaire">
                                                <option value="Génie Agricole">Génie Agricole</option>
                                                <option value="Agroécologie">Agroécologie</option>
                                            </optgroup>
                                            <optgroup label="Astronomie">
                                                <option value="Astrophysique">Astrophysique</option>
                                                <option value="Cosmologie">Cosmologie</option>
                                            </optgroup>
                                            <optgroup label="Biologie">
                                                <option value="Biologie Moléculaire">Biologie Moléculaire</option>
                                                <option value="Biologie Cellulaire">Biologie Cellulaire</option>
                                            </optgroup>
                                            <optgroup label="Chimie">
                                                <option value="Chimie Organique">Chimie Organique</option>
                                                <option value="Chimie Inorganique">Chimie Inorganique</option>
                                            </optgroup>
                                            <optgroup label="Électronique">
                                                <option value="Microélectronique">Microélectronique</option>
                                                <option value="Électronique de Puissance">Électronique de Puissance
                                                </option>
                                            </optgroup>
                                            <optgroup label="Géologie">
                                                <option value="Géologie Marine">Géologie Marine</option>
                                                <option value="Géophysique">Géophysique</option>
                                            </optgroup>
                                            <optgroup label="Génie Environnemental">
                                                <option value="Gestion de l'Eau">Gestion de l'Eau</option>
                                                <option value="Énergie Renouvelable">Énergie Renouvelable</option>
                                            </optgroup>
                                            <optgroup label="Informatique">
                                                <option value="Intelligence Artificielle">Intelligence Artificielle
                                                </option>
                                                <option value="Développement Web">Développement Web</option>
                                                <option value="IAO OFFSHORING">IAO OFFSHORING</option>
                                            </optgroup>
                                            <optgroup label="Mathématiques">
                                                <option value="Analyse Numérique">Analyse Numérique</option>
                                                <option value="Probabilités et Statistiques">Probabilités et
                                                    Statistiques</option>
                                            </optgroup>
                                            <optgroup label="Physique">
                                                <option value="Physique Quantique">Physique Quantique</option>
                                                <option value="Physique des Particules">Physique des Particules</option>
                                            </optgroup>
                                            <optgroup label="Pharmacologie">
                                                <option value="Pharmacocinétique">Pharmacocinétique</option>
                                                <option value="Pharmacogénétique">Pharmacogénétique</option>
                                            </optgroup>

                                        </select>
                                    </div>

                                    <div class="input-field">
                                        <label>Institution </label>
                                        <select name="institution" id="institution" value="">
                                            <option disabled selected>Choix de l'institution</option>
                                            <option>FSR</option> <!-- Faculte des Sciense de Rabat -->
                                            <option>UM5</option> <!-- Université Mohammed V de Rabat -->
                                            <option>UIR</option> <!-- Université Internationale de Rabat -->
                                            <option>UM6P</option> <!-- Université Mohammed VI Polytechnique -->
                                            <option>UH1</option> <!-- Université Hassan Ier de Settat -->
                                            <option>USMBA</option> <!-- Université Sidi Mohamed Ben Abdellah -->
                                            <option>UCAM</option> <!-- Université Cadi Ayyad de Marrakech -->
                                            <option>ENCG</option>
                                            <!-- Ecole Nationale de Commerce et de Gestion -->
                                            <option>ENSAM</option>
                                            <!-- Ecole Nationale Supérieure d'Arts et Métiers -->
                                            <option>ENSIAS</option>
                                            <!-- Ecole Nationale Supérieure d'Informatique et d'Analyse des Systèmes -->
                                            <option>INPT</option>
                                            <!-- Institut National des Postes et Télécommunications -->
                                            <option>INSEA</option>
                                            <!-- Institut National de Statistique et d'Economie Appliquée -->
                                            <option>ENS</option> <!-- Ecole Normale Supérieure -->
                                            <option>ENSI</option>
                                            <!-- Ecole Nationale des Sciences de l'Informatique -->
                                            <option>ENCG</option> <!-- Ecole Nationale de Commerce et de Gestion -->
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
                                            <option>FSR</option> <!-- Faculte des Sciense de Rabat -->
                                            <option>UM5</option> <!-- Université Mohammed V de Rabat -->
                                            <option>UIR</option> <!-- Université Internationale de Rabat -->
                                            <option>UM6P</option> <!-- Université Mohammed VI Polytechnique -->
                                            <option>UH1</option> <!-- Université Hassan Ier de Settat -->
                                            <option>USMBA</option> <!-- Université Sidi Mohamed Ben Abdellah -->
                                            <option>UCAM</option> <!-- Université Cadi Ayyad de Marrakech -->
                                            <option>ENCG</option>
                                            <!-- Ecole Nationale de Commerce et de Gestion -->
                                            <option>ENSAM</option>
                                            <!-- Ecole Nationale Supérieure d'Arts et Métiers -->
                                            <option>ENSIAS</option>
                                            <!-- Ecole Nationale Supérieure d'Informatique et d'Analyse des Systèmes -->
                                            <option>INPT</option>
                                            <!-- Institut National des Postes et Télécommunications -->
                                            <option>INSEA</option>
                                            <!-- Institut National de Statistique et d'Economie Appliquée -->
                                            <option>ENS</option> <!-- Ecole Normale Supérieure -->
                                            <option>ENSI</option>
                                            <!-- Ecole Nationale des Sciences de l'Informatique -->
                                            <option>ENCG</option> <!-- Ecole Nationale de Commerce et de Gestion -->
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
                                            <option>FSR</option> <!-- Faculte des Sciense de Rabat -->
                                            <option>UM5</option> <!-- Université Mohammed V de Rabat -->
                                            <option>UIR</option> <!-- Université Internationale de Rabat -->
                                            <option>UM6P</option> <!-- Université Mohammed VI Polytechnique -->
                                            <option>UH1</option> <!-- Université Hassan Ier de Settat -->
                                            <option>USMBA</option> <!-- Université Sidi Mohamed Ben Abdellah -->
                                            <option>UCAM</option> <!-- Université Cadi Ayyad de Marrakech -->
                                            <option>ENCG</option>
                                            <!-- Ecole Nationale de Commerce et de Gestion -->
                                            <option>ENSAM</option>
                                            <!-- Ecole Nationale Supérieure d'Arts et Métiers -->
                                            <option>ENSIAS</option>
                                            <!-- Ecole Nationale Supérieure d'Informatique et d'Analyse des Systèmes -->
                                            <option>INPT</option>
                                            <!-- Institut National des Postes et Télécommunications -->
                                            <option>INSEA</option>
                                            <!-- Institut National de Statistique et d'Economie Appliquée -->
                                            <option>ENS</option> <!-- Ecole Normale Supérieure -->
                                            <option>ENSI</option>
                                            <!-- Ecole Nationale des Sciences de l'Informatique -->
                                            <option>ENCG</option> <!-- Ecole Nationale de Commerce et de Gestion -->
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