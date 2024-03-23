DROP DATABASE IF EXISTS fsr_bdd;
 
CREATE DATABASE fsr_bdd DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

use fsr_bdd;

DROP TABLE IF EXISTS `tb_user`;

CREATE TABLE IF NOT EXISTS `tb_user`(
    codeApogee int(11) NOT NULL,
    nom varchar(100) NOT NULL,
    prenom varchar(200),
    dateNaiss date,
    sexe BOOLEAN DEFAULT NULL,
    numTel varchar(15) NOT NULL,
    adresse varchar(200) NOT NULL,
    email varchar(200) NOT NULL,
    mdp varchar(250) NOT NULL,
    titre varchar(100),
    theme varchar(100),
    abstract varchar(200),
    keywords varchar(100),
    discipline varchar(100),
    specialite varchar(100),
    institution varchar(100),
    structure varchar(100),
    nomSup varchar(100),
    prenomSup varchar(100),
    emailSup varchar(150),
    institutionSup varchar(100),
    nomCoSup varchar(100),
    prenomCoSup varchar(100),
    emailCoSup varchar(150),
    institutionCoSup varchar(100),
    validation BOOLEAN DEFAULT 0,
    PRIMARY KEY(id)
)ENGINE = MyISAM DEFAULT CHARSET = latin1;

INSERT INTO `tb_user`(
    codeApogee,
    email,
    nom,
    prenom,
    numTel,
    adresse,
    mdp
) VALUES(
    '23031093',
    'Trofel@gmail.com',
    'LEFORT',
    NULL,
    '06 42 35 91 84',
    'Rabat Salé',
    'Trofel'
);

SELECT codeApogee, email, nom, prenom, numTel, adresse, mdp FROM tb_user;
