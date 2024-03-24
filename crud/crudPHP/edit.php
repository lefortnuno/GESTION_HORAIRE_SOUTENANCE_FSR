<?php
// Inclure votre fichier de connexion à la base de données
require_once '../../config/config.php';
if (isset ($_POST['edit'])) {


    // Récupérez l'ID de la session
    $codeApogee = $_SESSION["codeApogee"];

    // Requête pour récupérer les informations de l'utilisateur à partir de l'ID
    $sql = "SELECT * FROM tb_user WHERE codeApogee = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $codeApogee);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    // Fermer la requête
    $stmt->close();

    // Récupérez les données du formulaire
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $dateNaiss = $_POST['dateNaiss'];
    $sexe = $_POST['sexe'];
    $numTel = $_POST['numTel'];
    $adresse = $_POST['adresse'];
    $email = $_POST['email'];

    $titre = $_POST['titre'];
    $theme = $_POST['theme'];
    $abstract = $_POST['abstract'];
    $keywords = $_POST['keywords'];
    $disciplines = $_POST['disciplines'];
    $specialite = $_POST['specialite'];
    $institution = $_POST['institution'];
    $structure = $_POST['structure'];

    $nomSup = $_POST['nomSup'];
    $prenomSup = $_POST['prenomSup'];
    $emailSup = $_POST['emailSup'];
    $institutionSup = $_POST['institutionSup'];

    $nomCoSup = $_POST['nomCoSup'];
    $prenomCoSup = $_POST['prenomCoSup'];
    $emailCoSup = $_POST['emailCoSup'];
    $institutionCoSup = $_POST['institutionCoSup'];

    //Date d'eregistrement
    $registrationYear = date('Y');

    // Requête pour mettre à jour les informations de l'utilisateur dans la base de données
    $sql_update = "UPDATE tb_user SET nom = ?, prenom = ?, email = ? WHERE codeApogee = ?;";
    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bind_param("sssi", $nom, $prenom, $email, $codeApogee);
    $stmt_update->execute();

    if ($stmt_update->errno) {
        echo "Erreur lors de l'exécution de la requête : " . $stmt_update->error;
    }

    $_SESSION['message'] = 'Enregistrement réussi';

    // Charger les données existantes depuis le fichier XML
    $submission = simplexml_load_file('../../files/xml/doctorants.xml');

    $student = $submission->addChild('student');

    $author = $student->addChild('author');
    $author->addAttribute('sex', $sexe);
    $author->addAttribute('codeApogee', $codeApogee);
    $author->addAttribute('registrationYear', $registrationYear);
    $firstname = $author->addChild('firstname', $nom);
    $lastname = $author->addChild('lastname', $prenom);
    $birth = $author->addChild('birth', $dateNaiss);

    $title = $student->addChild('title', $titre);
    $abstract = $student->addChild('abstract', substr($abstract, 0, 1000));
    $keywords = $student->addChild('keywords', $keywords);
    $disciplines = $student->addChild('disciplines', $disciplines);
    $speciality = $student->addChild('speciality', $specialite);
    $theme = $student->addChild('theme', $theme);
    $institution = $student->addChild('institution', $institution);

    $structure = $student->addChild('structure', $structure);
    $structure->addAttribute('type', 'group');

    $mail = $student->addChild('mail');
    // Première adresse e-mail
    $mail1 = $mail->addChild('mail', $email);
    $mail1->addAttribute('type', 'institutionnel');
    // Deuxième adresse e-mail
    $mail2 = $mail->addChild('mail', $email);
    $mail2->addAttribute('type', 'autre');

    $phone = $student->addChild('phone', $numTel);

    $adress = $student->addChild('address');
    $ville = $adress->addChild('ville', $adresse);

    $supervisor = $student->addChild('supervisor');
    $firstname = $supervisor->addChild('firstname', $nomSup);
    $lastname = $supervisor->addChild('lastname', $prenomSup);
    $mail = $supervisor->addChild('mail', $emailSup);
    $institution = $supervisor->addChild('institution', $institutionSup);

    $cosupervisor = $student->addChild('cosupervisor');
    $firstname = $cosupervisor->addChild('firstname', $nomCoSup);
    $lastname = $cosupervisor->addChild('lastname', $prenomCoSup);
    $mail = $cosupervisor->addChild('mail', $emailCoSup);
    $institution = $cosupervisor->addChild('institution', $institutionCoSup);

    $dom = new DomDocument();
    $dom->preserveWhiteSpace = false;
    $dom->formatOutput = true;
    $dom->loadXML($submission->asXML());
    $dom->save('../../files/xml/doctorants.xml');

    header('location: ../../index.php');
    exit();
} else {
    $_SESSION['errorMessage'] = 'Selectionner un élément à modifier';
    header('location: ../../index.php');
}
?>