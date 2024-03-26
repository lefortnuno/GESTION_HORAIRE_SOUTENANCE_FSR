<!-- AFFICHAGE AVEC TRI -->

<?php
// Charger les données existantes depuis le fichier XML
$xml = simplexml_load_file('../../files/xml/doctorants.xml');

// Créer un tableau pour stocker les informations sur les étudiants
$students = array();

// Parcourir chaque étudiant dans le XML et stocker ses informations dans le tableau
foreach ($xml->student as $student) {
    $students[] = array(
        'nom' => (string) $student->author->firstname . ' ' . (string) $student->author->lastname,
        'codeApogee' => (string) $student->author['codeApogee'],
        'theme' => (string) $student->theme,
        'disciplines' => 'Salle ' . (string) $student->disciplines
    );
}

// Trier les étudiants par nom
// Trier les étudiants par nom (insensible à la casse)
usort($students, function ($a, $b) {
    return strcasecmp($a['nom'], $b['nom']);
});


// Définir les horaires de soutenance et de pause
$soutenance_time = strtotime('09:00'); // Heure de début de la soutenance à 9h00
$pause_time = 20 * 60; // Durée de la pause entre chaque soutenance en secondes (20 minutes)
$dejeuner_start_time = strtotime('11:20'); // Heure de début du déjeuner à 11h20
$dejeuner_end_time = strtotime('14:00'); // Heure de fin du déjeuner à 14h00
$fin_journee = strtotime('16:30'); // Heure de fin de la journée à 16h30

// Initialiser un tableau pour stocker les informations sur les soutenances
$soutenance_schedule = array();

// Initialiser un compteur pour suivre le nombre d'étudiants soutenus
$student_count = 0;

// Parcourir chaque étudiant trié par nom et générer les dates et horaires de soutenance
foreach ($students as $student) {
    // Vérifier si c'est toujours pendant les heures de travail
    if (date('H:i', $soutenance_time) > '16:30') {
        // Si c'est après 16h30, reporter la soutenance au lendemain à 9h00
        $soutenance_time = strtotime('+1 day', strtotime(date('Y-m-d', $soutenance_time))) + strtotime('09:00') - strtotime('00:00');
    }

    // Ajouter les informations de l'étudiant au tableau de planification des soutenances
    $soutenance_schedule[] = array(
        'date' => date('Y-m-d', $soutenance_time),
        'heure_debut' => date('H:i', $soutenance_time),
        'heure_fin' => date('H:i', $soutenance_time + (20 * 60)), // Heure de fin de la soutenance
        'codeApogee' => $student['codeApogee'],
        'nom' => $student['nom'],
        'theme' => $student['theme'],
        'disciplines' => $student['disciplines']
    );

    // Incrémenter le compteur d'étudiants soutenus
    $student_count++;

    // Vérifier si c'est le moment de faire une pause
    if ($student_count % 3 == 0 && $student_count != count($students)) {
        // Ajouter une pause dans le tableau de planification des soutenances
        $soutenance_schedule[] = array(
            'date' => 'PAUSE',
            'heure_debut' => '',
            'heure_fin' => '',
            'codeApogee' => '',
            'nom' => '',
            'theme' => '',
            'disciplines' => ''
        );

        // Ajouter la durée de la pause au temps de soutenance actuel
        $soutenance_time += $pause_time;
    }

    // Vérifier si c'est l'heure du déjeuner
    if ($soutenance_time >= $dejeuner_start_time && $soutenance_time < $dejeuner_end_time) {
        // Passer à l'heure de fin du déjeuner
        $soutenance_time = $dejeuner_end_time;
    } else {
        // Ajouter la durée d'une soutenance au temps de soutenance actuel
        $soutenance_time += $pause_time;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Planning des soutenances</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>

    <div class="container">
        <h2 class="mt-5 mb-4">Planning des soutenances</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Horaire</th>
                    <th>Code Apogée</th>
                    <th>Nom et Prénom</th>
                    <th>Thème</th>
                    <th>Salle</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($soutenance_schedule as $item): ?>
                    <tr>
                        <td>
                            <?= $item['date'] ?>
                        </td>
                        <td>
                            <?= $item['heure_debut'] ?> -
                            <?= $item['heure_fin'] ?>
                        </td>
                        <td>
                            <?= $item['codeApogee'] ?>
                        </td>
                        <td>
                            <?= $item['nom'] ?>
                        </td>
                        <td>
                            <?= $item['theme'] ?>
                        </td>
                        <td>
                            <?= $item['disciplines'] ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</body>

</html>