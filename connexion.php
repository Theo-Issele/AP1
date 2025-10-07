<?php
session_start();
// Inclure les informations de connexion à la base de données
include '_conf.php';

if (!isset($_SESSION['login'])) {

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		
		// Récupérer les données du formulaire
		$login=$_POST["login"];
		$password=$_POST["password"];
	
		// Connexion à la base de données
		$connexion = mysqli_connect($serveurBDD, $userBDD, $mdpBDD, $nomBDD);
		if (!$connexion) {
			die('Erreur de connexion à la base de données : ' . mysqli_connect_error());
		}
	
		// Sécuriser les données
		$login = mysqli_real_escape_string($connexion, $login);
	
		// Rechercher l'utilisateur dans la base de données
		$requete = "SELECT * FROM utilisateur WHERE login = '$login'";
		$resultat = mysqli_query($connexion, $requete);
		
		if (mysqli_num_rows($resultat) == 1) 
		{
			
			$user = mysqli_fetch_assoc($resultat);
		
			// Vérifier le mot de passe
			if (password_verify($password, $user['mdp']))
			{
			
				$_SESSION['login'] = $user['login'];
				$_SESSION['id'] = $user['id'];
				$_SESSION['type'] = $user['categorie'];
			} 
			else 
			{
				echo '<div style="text-align: center; font-family: Arial, sans-serif; font-size: 18px; margin-top: 20px;">';
				echo "Mot de passe incorrect";
				echo '</div>';
				exit();
			}
		} 
		else 
		{
			echo '<div style="text-align: center; font-family: Arial, sans-serif; font-size: 18px; margin-top: 20px;">';
			echo "Nom d'utilisateur introuvable.";
			echo '</div>';
			exit();
		}
	
		// Fermer la connexion
		mysqli_close($connexion);
	}
}

if (isset($_SESSION['login']))
{
	if ($_SESSION['type'] == 'eleve')
	{
	header ("location: compte_rendu.php");
	}
	else {
		header ("location: compte_rendu_prof.php");
	}
}
?>
<?php
/*
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="Inscription.css">
<title>Accueil</title>
</head>
<body>
	<div class="card">
		<h1>Bienvenue <?php echo $user['login']; ?> !</h1><br>
		<h3><?php 
		if ($_SESSION['type'] = "eleve")
		{
			echo "Partie ELEVE";
		}
		else
		{
			echo "Partie PROF";
		}
		?></h3><br>
		<a href="../AP1/perso.php"><button class="submit-button" type="submit" name="infoperso">Information personnel</button></a><br><br>
		<a href="../AP1/listecr.php"><button class="submit-button" type="submit" name="listecr">Liste de vos Compte-rendu</button></a><br><br>
		<a href="../AP1/creer.php"><button class="submit-button" type="submit" name="creercr">Créer/Modifier votre Compte-rendu</button></a><br><br>
		<a href="../AP1/commenter.php"><button class="submit-button" type="submit" name="commentcr">Commenter vos Comptes-rendus</button></a><br><br><br>
		<br><br><a href="index.php"><button class="submit-button" type="submit" name="logout">Déconnexion</button></a>
	</div>
</body>
*/
?>
</html>