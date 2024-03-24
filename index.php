<?php
require 'config/config.php';

if (!empty ($_SESSION["codeApogee"])) {
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
    <link rel="stylesheet" type="text/css" href="files/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="files/css/nav.css">
</head>

<body>
    <?php
    include ('pages/header/navbar.php');
    ?>

    <div class="container">
        <h1 class="page-header text-center">CRUD avec un XML en utilisant PHP</h1>
        <div class="row">
            <div class="col-sm-11 col-sm-offset-1">
                <a href="#addnew" class="btn btn-primary" data-toggle="modal"><span
                        class="glyphicon glyphicon-plus"></span> Nouveau </a>

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

                <table class="table table-bordered table-striped" style="margin-top:20px;">
                    <thead>
                        <th>Code Apogée</th>
                        <th>Nom & Prénom</th>
                        <th>Thème</th>
                        <th>Téléphone</th>
                        <th> </th>
                    </thead>

                    <tbody>
                        <?php
                        // Chargement des fichers xml 
                        $file = simplexml_load_file('files/xml/doctorants.xml');

                        foreach ($file->student as $row) {
                            ?>
                            <tr>
                                <td>
                                    <?php echo $row->author['codeApogee']; ?>
                                </td>
                                <td>
                                    <?php echo $row->author->firstname; ?>
                                    <?php echo $row->author->lastname; ?>
                                </td>
                                <td>
                                    <?php echo $row->theme; ?>
                                </td>
                                <td>
                                    <?php echo $row->phone; ?>
                                </td>
                                <td>
                                    <a href="#edit_<?php echo $row->codeApogee; ?>" data-toggle="modal"
                                        class="btn btn-success btn-sm"><span class="glyphicon glyphicon-edit"></span>
                                        Modifier </a>
                                    <a href="#delete_<?php echo $row->codeApogee; ?>" data-toggle="modal"
                                        class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span>
                                        Supprimer</a>
                                </td>
                                <?php include ('modals/edit_delete_modal.php'); ?>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?php include ('modals/add_modal.php'); ?>

    <script src="files/js/jquery.min.js"></script>
    <script src="files/bootstrap/js/bootstrap.min.js"></script>

</body>

</html>