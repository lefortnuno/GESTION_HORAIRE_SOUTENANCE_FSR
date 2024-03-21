<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "fsr_bdd");

// Vérifier la connexion
if (!$conn) {
    die("La connexion à la base de données a échoué : " . mysqli_connect_error());
}
