<?php
session_start();
include '_conf.php';

// connexion à la base de donnée
$connexion = mysqli_connect($serveurBDD, $userBDD, $mdpBDD, $nomBDD);
// Récupérer les informations de l'utilisateur connecté
$login = $_SESSION['login'];
$sql = "SELECT * FROM utilisateur WHERE login = '$login'";
$resultat = mysqli_query($connexion, $sql);
$user = mysqli_fetch_assoc($resultat);
if (isset($_POST['update'])) {
    $newLogin = mysqli_real_escape_string($connexion, $_POST['login']);
    $newNom = mysqli_real_escape_string($connexion, $_POST['nom']);
    $newPrenom = mysqli_real_escape_string($connexion, $_POST['prenom']);
    $newEmail = mysqli_real_escape_string($connexion, $_POST['email']);

    $updateSQL = "UPDATE utilisateur SET 
                    login = '$newLogin',
                    nom = '$newNom',
                    prenom = '$newPrenom',
                    email = '$newEmail'
                  WHERE login = '$login'";

    if (mysqli_query($connexion, $updateSQL)) {
        $_SESSION['login'] = $newLogin; // Si login change
        header("Location: ".$_SERVER['PHP_SELF']); // Rafraîchir la page
        exit();
    } else {
        echo "Erreur lors de la mise à jour : " . mysqli_error($connexion);
    }
}
?>

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

<div align="center"><h1 class="logo-title">Vos informations</h1><br>
<form method="POST" action="">
    <p>Login :
    <input type="text" name="login" value="<?php echo $user['login']; ?>" required></p><br>
    <p>Nom :
    <input type="text" name="nom" value="<?php echo $user['nom']; ?>" required></p><br>
    <p>Prénom :
    <input type="text" name="prenom" value="<?php echo $user['prenom']; ?>" required></p><br>
    <p>Email :
    <input type="email" name="email" value="<?php echo $user['email']; ?>" required></p><br>
    <p>Catégorie :
    <input type="email" name="categorie" value="<?php echo $user['categorie']; ?>" required></p><br>
    <input type="submit" name="update" value="Mettre à jour">
</form>
<br>


<a href="compte_rendu.php"> <button class="submit-button" type="submit" name="previous">Revenir à l'accueil</button> </a></div>
</div>  

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>