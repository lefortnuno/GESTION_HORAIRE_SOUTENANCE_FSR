<?php
// Inclure votre fichier de connexion à la base de données
require_once '../../config/config.php';
if (isset ($_POST['edit'])) {


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

    // Récupérez les données du formulaire
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];

    // Requête pour mettre à jour les informations de l'utilisateur dans la base de données
    $sql_update = "UPDATE tb_user SET nom = ?, prenom = ?, email = ? WHERE id = ?;";
    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bind_param("sssi", $nom, $prenom, $email, $id);
    $stmt_update->execute();

    if ($stmt_update->errno) {
        echo "Erreur lors de l'exécution de la requête : " . $stmt_update->error;
    }

    $_SESSION['message'] = 'Modification réussi';

    // Charger les données existantes depuis le fichier XML
    $users = simplexml_load_file('../../files/xml/doctorants.xml');
    $user = $users->addChild('user');
    $user->addChild('id', $id);
    $user->addChild('nom', $nom);
    $user->addChild('prenom', $prenom);
    $user->addChild('email', $email);

    $dom = new DomDocument();
    $dom->preserveWhiteSpace = false;
    $dom->formatOutput = true;
    $dom->loadXML($users->asXML());
    $dom->save('../../files/xml/doctorants.xml');

    header('location: ../../index.php');
    exit();
} else {
    $_SESSION['errorMessage'] = 'Selectionner un élément à modifier';
    header('location: ../../index.php');
}
?>