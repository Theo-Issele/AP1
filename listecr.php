<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: connexion.php");
    exit();
}
 include '_conf.php';
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
        <a class="navbar-brand" href="compte_rendu.php">Comptes Rendus</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link active" href="creer.php">Créer</a></li>
                <li class="nav-item"><a class="nav-link" href="listecr.php">Mes Comptes Rendus / Modifier</a></li>
                <li class="nav-item"><a class="nav-link" href="perso.php">Information personnel</a></li>
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
 <!-- Section Voir -->
 <section id="voir">
        <h2>Mes Comptes Rendus</h2>
        <?php
       
        $connexion = mysqli_connect($serveurBDD, $userBDD, $mdpBDD, $nomBDD);
        $sql = "SELECT * FROM compte_rendu WHERE id_utilisateur = $id";
        $stmt = mysqli_prepare($connexion, $sql);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        while ($row = mysqli_fetch_assoc($result)) { ?>
        <div class='card my-3'>
            <div class='card-header'>
                <strong><?= htmlspecialchars($row['titre']) ?>  |  <?= htmlspecialchars($row['date']) ?></strong>
            </div>
            <div class='card-body'>
                <p><?= htmlspecialchars($row['descriptif'])?></p>
                <?php echo "
                <a href='modifier_cr.php?id=" . $row['id'] . "' class='btn btn-warning btn-sm'>Modifier</a>"?>
            </div>
        </div>
        <?php
}
        ?>
    </section>
    <hr>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>