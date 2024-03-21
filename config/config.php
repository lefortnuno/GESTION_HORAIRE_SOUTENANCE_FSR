<?php
session_start(); 

// Connexion à la base de données
$conn = mysqli_connect("localhost", "root", "");

// Vérification de la connexion
if (!$conn) {
    die("La connexion à la base de données a échoué : " . mysqli_connect_error());
}

// Création de la base de données si elle n'existe pas
$create_db_query = "CREATE DATABASE IF NOT EXISTS fsr_bdd";
if (!mysqli_query($conn, $create_db_query)) {
    die("Erreur lors de la création de la base de données : " . mysqli_error($conn));
}

// Sélection de la base de données
mysqli_select_db($conn, "fsr_bdd");

// Création de la table tb_user si elle n'existe pas
$create_table_query = "CREATE TABLE IF NOT EXISTS tb_user (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(200),
    email VARCHAR(200) NOT NULL,
    mdp VARCHAR(250) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1";
if (!mysqli_query($conn, $create_table_query)) {
    die("Erreur lors de la création de la table tb_user : " . mysqli_error($conn));
}

// Vérifier si l'utilisateur existe déjà
$check_user_query = "SELECT * FROM tb_user WHERE email = 'Trofel@gmail.com'";
$dupliquer = mysqli_query($conn, $check_user_query);
if(mysqli_num_rows($dupliquer) == 0) {
    // L'utilisateur n'existe pas, donc l'insérer
    $query = "INSERT INTO tb_user(nom, prenom, email, mdp) VALUES('LEFORT', NULL, 'Trofel@gmail.com', 'Trofel')";
    if (!mysqli_query($conn, $query)) {
        die("Erreur lors de l'insertion de l'utilisateur : " . mysqli_error($conn));
    }
}  