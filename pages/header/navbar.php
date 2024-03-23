<!-- navbar.php -->
<nav>
    <input id="nav-toggle" type="checkbox">
    <div class="logo"> <strong> <a href="http://localhost/PROJET/GESTION_HORAIRE_SOUTENANCE_FSR/index.php">FSR</a> </strong></div>
    <ul class="links"> 
        <li><a href="http://localhost/PROJET/GESTION_HORAIRE_SOUTENANCE_FSR/pages/etudiant/formulaire.php">
            <?php echo $row["nom"]; ?>
        </a></li>
        <li><a href="#work">Planning</a></li>
        <li><a href="#projects"> </a></li>
        <li><a href="http://localhost/PROJET/GESTION_HORAIRE_SOUTENANCE_FSR/auth/logout.php">Déconnexion</a></li>
    </ul>
    <label for="nav-toggle" class="icon-burger">
        <div class="line"></div>
        <div class="line"></div>
        <div class="line"></div>
    </label>
</nav>
