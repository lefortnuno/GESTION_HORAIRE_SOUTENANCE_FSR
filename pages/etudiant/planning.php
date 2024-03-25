<?php
// Charger les données existantes depuis le fichier XML
$xml = simplexml_load_file('../../files/xml/doctorants.xml');

// Définir les horaires de soutenance et de pause
$soutenance_time = strtotime('09:00'); // Heure de début de la soutenance à 9h00
$pause_time = 20 * 60; // Durée de la pause entre chaque soutenance en secondes (20 minutes)
$pause_longue_time = 40 * 60; // Durée de la pause longue après chaque 3 soutenances en secondes (40 minutes)
$dejeuner_start_time = strtotime('11:20'); // Heure de début du déjeuner à 11h20
$dejeuner_end_time = strtotime('14:00'); // Heure de fin du déjeuner à 14h00
$fin_journee = strtotime('16:30'); // Heure de fin de la journée à 16h30

// Initialiser un tableau pour stocker les informations sur les soutenances par discipline
$soutenance_schedule = array();

// Initialiser un tableau pour chaque discipline
$disciplines = array();

// Initialiser un compteur pour suivre le nombre d'étudiants soutenus par discipline
$student_count = array();

// Parcourir chaque étudiant dans le XML
foreach ($xml->student as $student) {
    // Récupérer la discipline de l'étudiant
    $discipline = (string) $student->disciplines;

    // Vérifier si la discipline existe déjà dans le tableau des soutenances
    if (!isset ($soutenance_schedule[$discipline])) {
        // Si la discipline n'existe pas, initialiser un tableau vide pour stocker les soutenances de cette discipline
        $soutenance_schedule[$discipline] = array();
        // Initialiser le compteur d'étudiants pour cette discipline à zéro
        $student_count[$discipline] = 0;
    }

    // Incrémenter le compteur d'étudiants pour cette discipline
    $student_count[$discipline]++;

    // Ajouter les informations de l'étudiant au tableau de planification des soutenances de sa discipline
    $soutenance_schedule[$discipline][] = array(
        'date' => date('Y-m-d', $soutenance_time),
        'heure_debut' => date('H:i', $soutenance_time),
        'heure_fin' => date('H:i', $soutenance_time + (20 * 60)), // Heure de fin de la soutenance
        'nom' => (string) $student->author->firstname . ' ' . (string) $student->author->lastname,
        'theme' => (string) $student->theme,
        'salle' => 'Salle ' . $discipline // Salle de soutenance correspondant à la discipline
    );

    // Vérifier si c'est le moment de faire une pause
    if ($student_count[$discipline] % 3 == 0 && $student_count[$discipline] != count($xml->student)) {
        // Ajouter une pause longue dans le tableau de planification des soutenances de cette discipline
        $soutenance_schedule[$discipline][] = array(
            'date' => 'PAUSE LONGUE',
            'heure_debut' => '',
            'heure_fin' => '',
            'nom' => '',
            'theme' => '',
            'salle' => '' // Pas de salle pendant la pause longue
        );

        // Ajouter la durée de la pause longue au temps de soutenance actuel
        $soutenance_time += $pause_longue_time;
    } else {
        // Ajouter la durée d'une soutenance au temps de soutenance actuel
        $soutenance_time += $pause_time;
    }

    // Vérifier si c'est l'heure du déjeuner ou si c'est la fin de la journée
    if ($soutenance_time >= $dejeuner_start_time && $soutenance_time < $dejeuner_end_time || $soutenance_time >= $fin_journee) {
        // Passer au lendemain à 9h00
        $soutenance_time = strtotime('+1 day', strtotime(date('Y-m-d', $soutenance_time))) + strtotime('09:00') - strtotime('00:00');
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Planning des soutenances par discipline</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>

    <div class="container">
        <h2 class="mt-5 mb-4">Planning des soutenances par discipline</h2>
        <?php foreach ($soutenance_schedule as $discipline => $soutenances): ?>
            <h3>
                <?= $discipline ?>
            </h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Heure de début</th>
                        <th>Heure de fin</th>
                        <th>Nom et Prénom</th>
                        <th>Thème</th>
                        <th>Salle</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($soutenances as $soutenance): ?>
                        <?php if ($soutenance['date'] !== 'PAUSE LONGUE'): ?>
                            <tr>
                                <td>
                                    <?= $soutenance['date'] ?>
                                </td>
                                <td>
                                    <?= $soutenance['heure_debut'] ?>
                                </td>
                                <td>
                                    <?= $soutenance['heure_fin'] ?>
                                </td>
                                <td>
                                    <?= $soutenance['nom'] ?>
                                </td>
                                <td>
                                    <?= $soutenance['theme'] ?>
                                </td>
                                <td>
                                    <?= $soutenance['salle'] ?>
                                </td>
                            </tr>
                        <?php else: ?>
                            <tr>
                                <td colspan="6">PAUSE LONGUE</td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endforeach; ?>
    </div>

</body>

</html>