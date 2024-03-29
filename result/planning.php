<?php
session_start();
// Contenu du fichier .bat
$contenu_bat = "cd C:\wamp64\www\PROJET\GESTION_HORAIRE_SOUTENANCE_FSR\result \n";
$contenu_bat .= "java -jar C:\SaxonHE12-4J\saxon-he-12.4.jar -s:doctorants.xml -xsl:transformation.xsl -o:index.html \n";
$contenu_bat .= "wkhtmltopdf index.html programme.pdf \n";
// $contenu_bat .= "pause \n";

// Chemin du fichier .bat à générer
$chemin_fichier_bat = "C:\\wamp64\\www\\PROJET\\GESTION_HORAIRE_SOUTENANCE_FSR\\result\\planning.bat";

// Ouverture du fichier .bat en écriture
$fichier = fopen($chemin_fichier_bat, "w");

// Vérification si l'ouverture du fichier a réussi
if ($fichier === false) {
    $_SESSION['errorMessage'] = 'Impossible de généré votre planning !';
} else {
    // Écriture du contenu dans le fichier .bat
    fwrite($fichier, $contenu_bat);

    // Fermeture du fichier .bat
    fclose($fichier);

    $_SESSION['message'] = 'Planning généré avec succès. Veuillez le lancer';
    header("Location:  http://localhost/PROJET/GESTION_HORAIRE_SOUTENANCE_FSR/index.php");
    // header("Location:  http://localhost/PROJET/GESTION_HORAIRE_SOUTENANCE_FSR/result/index.html"); 

}
?>