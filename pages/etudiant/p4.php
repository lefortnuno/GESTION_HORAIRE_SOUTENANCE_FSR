<?php
// Charger les données existantes depuis le fichier XML
$xml = simplexml_load_file('../../files/xml/doctorants.xml');

// Définir les constantes
define('SOUTENANCE_START_TIME', strtotime('09:00')); // Heure de début des soutenances à 9h00
define('PAUSE_TIME', 20 * 60); // Durée de la pause entre chaque soutenance en secondes (20 minutes)
define('DEJEUNER_START_TIME', strtotime('11:20')); // Heure de début du déjeuner à 11h20
define('DEJEUNER_END_TIME', strtotime('14:00')); // Heure de fin du déjeuner à 14h00
define('END_OF_DAY', strtotime('16:30')); // Heure de fin de la journée à 16h30

// Fonction pour calculer les horaires de soutenance
function calculateSoutenanceSchedule($students)
{
    $soutenance_time = SOUTENANCE_START_TIME;
    $soutenance_schedule = array();

    foreach ($students as $student) {
        $discipline = (string) $student->disciplines;

        if (!isset ($soutenance_schedule[$discipline])) {
            $soutenance_schedule[$discipline] = array();
        }

        $soutenance_schedule[$discipline][] = array(
            'date' => date('Y-m-d', $soutenance_time),
            'heure_debut' => date('H:i', $soutenance_time),
            'heure_fin' => date('H:i', $soutenance_time + PAUSE_TIME),
            'nom' => (string) $student->author->firstname . ' ' . (string) $student->author->lastname,
            'codeApogee' => (string) $student->author['codeApogee'], // Correction ici
            'theme' => (string) $student->theme, // Correction ici
            'salle' => 'Salle ' . $discipline
        );

        // Vérifier si c'est l'heure du déjeuner
        if ($soutenance_time >= DEJEUNER_START_TIME && $soutenance_time < DEJEUNER_END_TIME) {
            // Passer à l'heure de fin du déjeuner
            $soutenance_time = DEJEUNER_END_TIME;
        } else {
            // Ajouter la durée d'une soutenance au temps de soutenance actuel
            $soutenance_time += PAUSE_TIME;
        }

        // Vérifier si c'est la fin de la journée
        if ($soutenance_time > END_OF_DAY) {
            // Passer à la date suivante et réinitialiser l'heure de soutenance à 9h00
            $soutenance_time = strtotime('+1 day', strtotime(date('Y-m-d', $soutenance_time))) + SOUTENANCE_START_TIME - strtotime('00:00');
        }
    }

    return $soutenance_schedule;
}

// Générer le planning de soutenance par discipline
$soutenance_schedule = calculateSoutenanceSchedule($xml->student);
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
        <?php foreach ($soutenance_schedule as $discipline => $students): ?>
            <h3>
                <?= $discipline ?>
            </h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Heure de début</th>
                        <th>Heure de fin</th>
                        <th>Code Apogée</th>
                        <th>Nom et Prénom</th>
                        <th>Thème</th>
                        <th>Salle</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($students as $student): ?>
                        <tr>
                            <td>
                                <?= $student['date'] ?>
                            </td>
                            <td>
                                <?= $student['heure_debut'] ?>
                            </td>
                            <td>
                                <?= $student['heure_fin'] ?>
                            </td>
                            <td>
                                <?= $student['codeApogee'] ?>
                            </td>
                            <td>
                                <?= $student['nom'] ?>
                            </td>
                            <td>
                                <?= $student['theme'] ?>
                            </td>
                            <td>
                                <?= $student['salle'] ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endforeach; ?>
    </div>
</body>

</html>