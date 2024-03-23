<?php
session_start();

// Connexion à la base de données
$conn = mysqli_connect("localhost", "root", "");

// Vérification de la connexion
if (!$conn) {
    die ("La connexion à la base de données a échoué : " . mysqli_connect_error());
}

// Création de la base de données si elle n'existe pas
$create_db_query = "CREATE DATABASE IF NOT EXISTS fsr_bdd DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci";
if (!mysqli_query($conn, $create_db_query)) {
    die ("Erreur lors de la création de la base de données : " . mysqli_error($conn));
}

// Sélection de la base de données
mysqli_select_db($conn, "fsr_bdd");

// Création de la table tb_user si elle n'existe pas
$create_table_query = "CREATE TABLE IF NOT EXISTS tb_user ( 
    codeApogee INT(11) NOT NULL PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(200),
    dateNaiss DATE,
    sexe BOOLEAN DEFAULT NULL,
    numTel VARCHAR(15) NOT NULL,
    adresse VARCHAR(200) NOT NULL,
    email VARCHAR(200) NOT NULL,
    mdp VARCHAR(250) NOT NULL,
    titre VARCHAR(100),
    theme VARCHAR(100),
    abstract VARCHAR(200),
    keywords VARCHAR(100),
    discipline VARCHAR(100),
    specialite VARCHAR(100),
    institution VARCHAR(100),
    structure VARCHAR(100),
    nomSup VARCHAR(100),
    prenomSup VARCHAR(100),
    emailSup VARCHAR(150),
    institutionSup VARCHAR(100),
    nomCoSup VARCHAR(100),
    prenomCoSup VARCHAR(100),
    emailCoSup VARCHAR(150),
    institutionCoSup VARCHAR(100),
    validation BOOLEAN DEFAULT 0
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1";

if (!mysqli_query($conn, $create_table_query)) {
    die ("Erreur lors de la création de la table tb_user : " . mysqli_error($conn));
}

// Vérifier si l'utilisateur existe déjà
$check_user_query = "SELECT * FROM tb_user WHERE email = 'Trofel@gmail.com' OR codeApogee = '23031093' ";
$dupliquer = mysqli_query($conn, $check_user_query);
if (mysqli_num_rows($dupliquer) == 0) {
    // L'utilisateur n'existe pas, donc l'insérer
    $query = "INSERT INTO tb_user(codeApogee, email, nom, prenom, numTel, adresse, mdp) VALUES('23031093', 'Trofel@gmail.com', 'LEFORT', NULL, '06 42 35 91 84', 'Rabat Sale', 'Trofel')";
    if (!mysqli_query($conn, $query)) {
        die ("Erreur lors de l'insertion de l'utilisateur : " . mysqli_error($conn));
    }
}