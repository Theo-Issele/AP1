<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
</head>
<body>
<?php
session_start();
// On inclut le fichier de configuration pour la connexion à la base de données
include "_conf.php";

$login = $_POST["login"];
$password = $_POST["password"];
$password2 = $_POST["password2"];
$nom = $_POST["nom"];
$prenom = $_POST["prenom"];
$email = $_POST["email"];
$categorie = $_POST["categorie"];

// Vérification des mots de passe
if ($password !== $password2) {
    echo "<h1><font color='red'>ERREUR : LES MOTS DE PASSE NE CORRESPONDENT PAS ! VEUILLEZ RÉESSAYER !</font></h1>";
} else {
    // Hashage sécurisé du mot de passe
     $passwordhash = password_hash($password, PASSWORD_DEFAULT);

    echo "<h1>Inscription Validée !</h1><br><br>
    Voici un récapitulatif de vos informations :<br><br>
    <li><strong>Login:</strong> $login</li>
    <li><strong>Nom:</strong> $nom</li>
    <li><strong>Prénom:</strong> $prenom</li>
    <li><strong>Email:</strong> $email</li>
    <li><strong>Catégorie:</strong> $categorie</li>";

    // Connexion à la base de données
    $connexion = mysqli_connect($serveurBDD, $userBDD, $mdpBDD, $nomBDD);

    if ($connexion) { 
        // Requête d'insertion
        $requete = "INSERT INTO utilisateur (nom, prenom, email, login, mdp, categorie) 
                    VALUES ('$nom', '$prenom', '$email', '$login', '$passwordhash', '$categorie')";

        if (mysqli_query($connexion, $requete)) {
            echo "<br>Inscription réussie !";
        } else {
            echo "<br>Erreur lors de l'inscription : " . mysqli_error($connexion) . "<br>";
        }

        // Fermeture de la connexion
        mysqli_close($connexion);
    } else {
        echo "<br>Erreur de connexion à la base de données.";
    }
}
?>
<br><br>
<a href="index.php"> <button class="submit-button" type="submit">Connectez-vous</button> </a>
</body>
</html>
