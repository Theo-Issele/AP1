<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: connexion.php");
    exit();
}

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
                <li class="nav-item"><a class="nav-link" href="commenter.php">Commenter</a></li>
                <li class="nav-item"><a class="nav-link" href="perso_prof.php">Information personnel</a></li>
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
    <!-- Section Commenter -->
    <section id="commenter">
        <h2>Commenter un Compte Rendu</h2>
        <form method="POST" action="commentaire.php">
            <div class="mb-3">
                <label for="id_cr" class="form-label">ID du compte rendu</label>
                <input type="number" class="form-control" name="id_cr" required>
            </div>
            <div class="mb-3">
                <label for="commentaire" class="form-label">Votre commentaire</label>
                <textarea class="form-control" name="commentaire" rows="3" required></textarea>
            </div>
            <input type="hidden" name="login" value="<?php echo htmlspecialchars($login); ?>">
            <button type="submit" class="btn btn-primary">Commenter</button>
        </form>
    </section>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>