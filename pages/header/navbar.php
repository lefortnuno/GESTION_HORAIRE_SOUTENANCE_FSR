<!-- navbar.php -->
<nav>
    <input id="nav-toggle" type="checkbox">
    <div class="logo"> <strong> <a href="http://localhost/PROJET/GESTION_HORAIRE_SOUTENANCE_FSR/index.php">FSR</a>
        </strong></div>
    <ul class="links">
        <?php if ($row["conf"] == 0) { ?>
            <li><a href="http://localhost/PROJET/GESTION_HORAIRE_SOUTENANCE_FSR/pages/etudiant/formulaire.php">
                    <?php echo $row["nom"]; ?>
                </a></li>
            <?php
        } else {
            ?>
            <li><a style="text-decoration-line: line-through;"
                    href="http://localhost/PROJET/GESTION_HORAIRE_SOUTENANCE_FSR/index.php">
                    <?php echo $row["nom"]; ?>
                </a></li>
            <?php
        } ?>

        <li><a href="http://localhost/PROJET/GESTION_HORAIRE_SOUTENANCE_FSR/result/planning.php">Planning</a></li>
        <!-- <li><a href="http://localhost/PROJET/GESTION_HORAIRE_SOUTENANCE_FSR/pages/etudiant/planning.php">P.Online</a>
        </li> -->
        <li><a href="#projects"> </a></li>
        <li><a href="http://localhost/PROJET/GESTION_HORAIRE_SOUTENANCE_FSR/auth/logout.php">Déconnexion</a></li>
    </ul>
    <label for="nav-toggle" class="icon-burger">
        <div class="line"></div>
        <div class="line"></div>
        <div class="line"></div>
    </label>
</nav>