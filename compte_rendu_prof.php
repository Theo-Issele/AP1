<?php
session_start();

$login = $_SESSION['login'];
$id =$_SESSION['id']
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des Comptes Rendus</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="compte_rendu_prof.php">Comptes Rendus</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link" href="listecr_prof.php">Voir Les Comptes Rendus</a></li>
                <li class="nav-item"><a class="nav-link" href="perso_prof.php">Information personnel</a></li>
                <li class="nav-item"><a class="nav-link" href="liste_eleve.php">Liste Élève</a></li>
            </ul>
            <span class="navbar-text text-white me-3"><?php 
            echo "PARTIE : ".$_SESSION['type'] ;
         ?></span>
            <span class="navbar-text text-white me-3">Connecté : <?php echo htmlspecialchars($login); ?></span>
            <a class="btn btn-outline-light" href="deconnexion.php">Déconnexion</a>
        </div>
    </div>
</nav>

<div class="container mt-5">

        <h2>Bienvenue sur l'Accueil de mon site</h2><hr>

</div>  

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
