<?php
session_start();
include '_conf.php';

if (!isset($_SESSION['login'])) {
    header("Location: index.php");
    exit();
}

$connexion = mysqli_connect($serveurBDD, $userBDD, $mdpBDD, $nomBDD);
$id_utilisateur = $_SESSION['id'];

// Vérifie qu'un ID est fourni
if (!isset($_GET['id'])) {
    echo "ID manquant.";
    exit();
}

$id_cr = intval($_GET['id']);

// Traitement du formulaire si soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // recupérer le titre du Compte rendu est le mettre dans la variable $titre
    $titre = mysqli_real_escape_string($connexion, $_POST['titre']);
    // recupérer le descriptif du Compte rendu est le mettre dans la variable $desciptif
    $descriptif = mysqli_real_escape_string($connexion, $_POST['descriptif']);
    // préparer la requête sql
    $update_sql = "UPDATE compte_rendu SET titre='$titre', descriptif='$descriptif',`date`= NOW() WHERE id=$id_cr AND id_utilisateur=$id_utilisateur";
    // traiter la requête sql
    if (mysqli_query($connexion, $update_sql)) {
        header("Location: listecr.php");
        exit();
    } else {
        echo "Erreur lors de la mise à jour : " . mysqli_error($connexion);
    }
} else {
    // Affiche les infos existantes
    $sql = "SELECT * FROM compte_rendu WHERE id=$id_cr AND id_utilisateur=$id_utilisateur";
    $res = mysqli_query($connexion, $sql);
    if ($row = mysqli_fetch_assoc($res)) {
        $titre = $row['titre'];
        $descriptif = $row['descriptif'];
    } else {
        echo "Compte rendu introuvable ou non autorisé.";
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier Compte Rendu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h2>Modifier le Compte Rendu</h2>
    <form method="POST">
        <div class="mb-3">
            <label for="titre" class="form-label">Titre</label>
            <input type="text" name="titre" id="titre" class="form-control" value="<?php echo htmlspecialchars($titre); ?>" required>
        </div>
        <div class="mb-3">
            <label for="descriptif" class="form-label">Descriptif</label>
            <textarea name="descriptif" id="descriptif" class="form-control" rows="6" required><?php echo htmlspecialchars($descriptif); ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Enregistrer</button>
        <a href="listecr.php" class="btn btn-secondary">Annuler</a>
    </form>
</body>
</html>
