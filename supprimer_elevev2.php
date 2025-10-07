<?php
session_start();
include "_conf.php";
   // Connexion à la base de données
	$connexion = mysqli_connect($serveurBDD, $userBDD, $mdpBDD, $nomBDD);
	if (!$connexion) 
    {
		die('Erreur de connexion à la base de données : ' . mysqli_connect_error());
	}
    // Vérifie qu'un ID est fourni
if (!isset($_GET['id'])) {
    echo "ID manquant.";
    exit();
}
$id_supprimer = intval($_GET['id']);
 $sql = "DELETE FROM utilisateur WHERE id = $id_supprimer";
 $result = mysqli_query($connexion, $sql);

        if ($result > 0) {
            $message = "Utilisateur avec l'ID $id_supprimer supprimé avec succès.";
        } else {
            $message = "Aucun utilisateur trouvé avec l'ID $id_supprimer.";
        }
        echo $message ;