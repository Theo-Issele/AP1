<?php
session_start();
include "_conf.php";
$login = $_SESSION['login'];
$id =$_SESSION['id'];

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['login'])) {
    header("Location: index.php");
    exit();
}
    // Connexion à la base de données
	$connexion = mysqli_connect($serveurBDD, $userBDD, $mdpBDD, $nomBDD);
	if (!$connexion) 
    {
		die('Erreur de connexion à la base de données : ' . mysqli_connect_error());
	}
// Vérifie si le formulaire a été envoyé
if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    //récupération des données du formulaire
    $titre = $_POST["titre"];
    $descriptif = mysqli_real_escape_string($connexion,$_POST["descriptif"]);
    $id= $_SESSION['id'];
    
if ($connexion) { 
        // Requête d'insertion
        $requete = "INSERT INTO compte_rendu (dateCreation, `date`, descriptif, id_utilisateur, titre) 
                    VALUES (NOW(), NOW(), '$descriptif', '$id', '$titre')";
        if (mysqli_query($connexion, $requete)) {
            
        } else {
            echo "<br>Erreur lors de l'enregistrement : " . mysqli_error($connexion) . "<br>";
        }

        // Fermeture de la connexion
        mysqli_close($connexion);
    } 
    else 
    {
        echo "<br>Erreur de connexion à la base de données.";
    }
}
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
                <li class="nav-item"><a class="nav-link" href="commenter.php">Commenter</a></li>
                <li class="nav-item"><a class="nav-link" href="perso.php">Information personnel</a></li>
            </ul>
            <span class="navbar-text text-white me-3"><?php 
       echo "PARTIE : ".$_SESSION['type'] ;
         ?></span>
            <span class="navbar-text text-white me-3">Connecté : <?php echo htmlspecialchars($login); ?></span>
            <a class="btn btn-outline-light" href="index.php">Déconnexion</a>
        </div>
    </div>
</nav>

<div class="container mt-5">

    <!-- Section Créer / Modifier -->
    <section id="creer">
        <h2>Créer un Compte Rendu</h2>
        <hr>
        <form method="POST" action="traitement_compte_rendu.php">
            <div class="mb-3">
                <label for="titre" class="form-label">Titre</label>
                <input type="text" class="form-control" id="titre" name="titre" required>
            </div>
            <div class="mb-3">
                <label for="contenu" class="form-label">Descriptif</label>
                <textarea class="form-control" id="descriptif" name="descriptif" rows="5" required></textarea>
            </div>
            <input type="hidden" name="auteur" value="<?php echo htmlspecialchars($login); ?>">
            <button type="submit" class="btn btn-primary">Enregistrer</button>
        </form>
    </section>

    <hr>

</div>  

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
