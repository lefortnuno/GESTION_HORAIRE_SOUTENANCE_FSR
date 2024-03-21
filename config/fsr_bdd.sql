DROP DATABASE IF EXISTS fsr_bdd;

CREATE DATABASE fsr_bdd CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

use fsr_bdd;

DROP TABLE IF EXISTS `tb_user`;

CREATE TABLE IF NOT EXISTS `tb_user`(
    id int(11) NOT NULL AUTO_INCREMENT,
    nom varchar(100) NOT NULL,
    prenom varchar(200),
    email varchar(200) NOT NULL,
    mdp varchar(250) NOT NULL,
    PRIMARY KEY(id)
)ENGINE = MyISAM AUTO_INCREMENT = 1 DEFAULT CHARSET = latin1;

INSERT INTO `tb_user`(
    id,
    nom,
    prenom,
    email,
    mdp
) VALUES(
    '3',
    'LEFORT',
    NULL,
    'Trofel@gmail.com',
    'Trofel'
);