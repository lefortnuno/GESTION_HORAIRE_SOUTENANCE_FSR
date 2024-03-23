<?php
session_start();
if (isset ($_POST['edit'])) {

    // Inclure votre fichier de connexion à la base de données
    require_once '../../config/config.php';

    // Récupérez l'ID de la session
    $id = $_SESSION["id"];

    // Requête pour récupérer les informations de l'utilisateur à partir de l'ID
    $sql = "SELECT * FROM tb_user WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    // Fermer la requête
    $stmt->close();

    // Requête pour mettre à jour les informations de l'utilisateur dans la base de données
    $sql_update = "UPDATE votre_table SET firstname = ?, lastname = ?, address = ? WHERE id = ?";
    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bind_param("sssi", $firstname, $lastname, $address, $id);
    $stmt_update->execute();

    $_SESSION['message'] = 'Modification réussi';
    header('location: ../../index.php');
    exit();
} else {
    $_SESSION['errorMessage'] = 'Selectionner un élément à modifier';
    header('location: ../../index.php');
}
?>