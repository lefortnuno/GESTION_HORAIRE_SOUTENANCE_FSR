<?php
require 'config/config.php';

if (!empty($_SESSION["codeApogee"])) {
    $codeApogee = $_SESSION["codeApogee"];
    $result = mysqli_query($conn, "SELECT * FROM tb_user WHERE codeApogee = $codeApogee");
    $row = mysqli_fetch_assoc($result);
} else {
    header("Location: auth/codeApogee.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    <link rel="stylesheet" type="text/css" href="files/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="files/css/nav.css">
    <style>
        .custom-h1 {
            font-family: 'Open Sans', sans-serif;
            font-weight: 600;
        }
    </style>
</head>

<body>
    <?php
    include ('pages/header/navbar.php');
    ?>

    <div class="container">
        <h3 class="page-header text-center custom-h3">
            Vos informations s'afficheront ici lorsque vous serez inscrit !
        </h3>
        <div class="row">
            <div class="col-sm-11 col-sm-offset-1">

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

                <table class="table table-bordered table-striped">
                    <thead>
                        <th>Code Apogée</th>
                        <th>Nom & Prénom</th>
                        <th>Thème</th>
                        <th>Téléphone</th>
                        <th>Date</th>
                        <th>Horaire</th>
                    </thead>
                    <tbody>
                        <?php
                        // Chargement du fichier XML
                        $file = simplexml_load_file('result/doctorants.xml');

                        $found = false; // Indicateur pour savoir si le code Apogée a été trouvé
                        
                        foreach ($file->student as $row) {
                            if ($row->author['codeApogee'] == $codeApogee) {
                                $found = true; // Le code Apogée a été trouvé
                                ?>
                                <tr>
                                    <td>
                                        <?php echo $row->author['codeApogee']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row->author->firstname . ' ' . $row->author->lastname; ?>
                                    </td>
                                    <td>
                                        <?php echo $row->theme; ?>
                                    </td>
                                    <td>
                                        <?php echo $row->phone; ?>
                                    </td>
                                    <td>
                                        <?php echo $row->theme; ?>
                                    </td>
                                    <td>
                                        <?php echo $row->phone; ?>
                                    </td>
                                </tr>
                                <?php
                            }
                        }

                        // Si le code Apogée n'a pas été trouvé, afficher un message
                        if (!$found) {
                            ?>
                            <tr>
                                <td colspan="4" class="text-center">
                                    Finalisez votre enregistrement en cliquant sur votre Nom !
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>

                </table>

                <div class="old text-right">
                    <a style="text-decoration: none; color: #000;"
                        href="http://localhost/PROJET/GESTION_HORAIRE_SOUTENANCE_FSR/result/index.html" target="_blank">
                        PDF
                        (ancien)</a>
                </div>

            </div>
        </div>
    </div>

    <script src=" files/js/jquery.min.js">
    </script>
    <script src="files/bootstrap/js/bootstrap.min.js"></script>

</body>

</html>