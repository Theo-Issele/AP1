<?php
session_start();
include "_conf.php";
$login = $_SESSION['login'];
$id =$_SESSION['id'];
$type =$_SESSION['type'];

if ($type == 'prof')
{
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
 <!-- Section Voir -->
 <section id="voir">
        <h2>Liste des élèves</h2>
        <?php
       
        $connexion = mysqli_connect($serveurBDD, $userBDD, $mdpBDD, $nomBDD);
        $sql = "SELECT nom,prenom,id FROM utilisateur WHERE categorie = 'eleve'";
        $stmt = mysqli_prepare($connexion, $sql);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        while ($row = mysqli_fetch_assoc($result)) { ?>
        <div class='card my-3'>
            <div class='card-header'>
                <strong><?= htmlspecialchars($row['nom']) ?> <?= htmlspecialchars($row['prenom']) ?>  |  ID : <?= htmlspecialchars($row['id']) ?></strong>
                   <p align="right"><?php echo "<a href='supprimer_elevev2.php?id=" . $row['id'] . " ' class='btn btn-warning btn-sm'>Supprimer</a>" ?></p>
            </div>
        </div>
        <?php
        }
        ?>
    </section>
    <hr>
    <form action = "supprimer_eleve.php" method="POST">
            <div class="form-group">
                <label for="login">ID à supprimer</label>
                <input type="text" id="id_supprimer" name="id_supprimer" required>
            </div>
                        <div class="form-group">
                <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')">OK</button>
            </div>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
} 
?>