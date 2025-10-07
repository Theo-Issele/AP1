<?php
session_start();
//Générer un mot de passe provisoire
function generer_mot_de_passe($longueur = 12) {
  $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()';
  $mdp_provisoire = '';
  $longueur_caracteres = strlen($caracteres);
  for ($i = 0; $i < $longueur; $i++) 
  {
      $mdp_provisoire .= $caracteres[random_int(0, $longueur_caracteres - 1)];
  }
  return $mdp_provisoire;
}
?>

<html>
<head>
  <meta charset="utf-8">
  <title>Mdp oublié</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>


  <div class="login-root">
    <div class="box-root flex-flex flex-direction--column" style="min-height: 100vh;flex-grow: 1;">
      <div class="loginbackground box-background--white padding-top--64">
        <div class="loginbackground-gridContainer">
          <div class="box-root flex-flex" style="grid-area: top / start / 8 / end;">
            <div class="box-root" style="background-image: linear-gradient(white 0%, rgb(247, 250, 252) 33%); flex-grow: 1;">
            </div>
          </div>
          <div class="box-root flex-flex" style="grid-area: 4 / 2 / auto / 5;">
            <div class="box-root box-divider--light-all-2 animationLeftRight tans3s" style="flex-grow: 1;"></div>
          </div>
          <div class="box-root flex-flex" style="grid-area: 6 / start / auto / 2;">
            <div class="box-root box-background--blue800" style="flex-grow: 1;"></div>
          </div>
          <div class="box-root flex-flex" style="grid-area: 7 / start / auto / 4;">
            <div class="box-root box-background--blue animationLeftRight" style="flex-grow: 1;"></div>
          </div>
          <div class="box-root flex-flex" style="grid-area: 8 / 4 / auto / 6;">
            <div class="box-root box-background--gray100 animationLeftRight tans3s" style="flex-grow: 1;"></div>
          </div>
          <div class="box-root flex-flex" style="grid-area: 2 / 15 / auto / end;">
            <div class="box-root box-background--cyan200 animationRightLeft tans4s" style="flex-grow: 1;"></div>
          </div>
          <div class="box-root flex-flex" style="grid-area: 3 / 14 / auto / end;">
            <div class="box-root box-background--blue animationRightLeft" style="flex-grow: 1;"></div>
          </div>
          <div class="box-root flex-flex" style="grid-area: 4 / 17 / auto / 20;">
            <div class="box-root box-background--gray100 animationRightLeft tans4s" style="flex-grow: 1;"></div>
          </div>
          <div class="box-root flex-flex" style="grid-area: 5 / 14 / auto / 17;">
            <div class="box-root box-divider--light-all-2 animationRightLeft tans3s" style="flex-grow: 1;"></div>
          </div>
        </div>
      </div>
      <div class="box-root padding-top--24 flex-flex flex-direction--column" style="flex-grow: 1; z-index: 9;">
        <div class="box-root padding-top--48 padding-bottom--24 flex-flex flex-justifyContent--center">
          <h1><a rel="dofollow">TH</a></h1>
        </div>
        <div class="formbg-outer">
          <div class="formbg">
            <div class="formbg-inner padding-horizontal--48">
              <span class="padding-bottom--15">Récupération mdp</span>
            <?php
            include "_conf.php";
            if (isset($_POST['email']))
            {

              //récupération email
                $lemail=$_POST['email'];
                echo "Le formulaire a été envoyé avec comme email la valeur : ".$lemail;

                //connexion BDD
                if ($connexion = mysqli_connect($serveurBDD, $userBDD, $mdpBDD, $nomBDD))
                { 
                    //si la connxeion réussi
                    $requete="Select * from utilisateur WHERE email='$lemail'";
                    $resultat = mysqli_query($connexion, $requete);
                    $login=0;
                      while($donnees = mysqli_fetch_assoc($resultat))
                      {
                        $login =$donnees['login']; //mettre le nom du champ dans la table
                        $mdp =$donnees['mdp'];
                      }
                           //Vérification de la présence de l'email dans la BDD
                            if($login!=0)
                            {                             
                              //définir le mdp proviosire
                              $mdp_provisoire = generer_mot_de_passe();
                              // Hashage sécurisé du mot de passe
                              $passwordhash2 = password_hash($mdp_provisoire, PASSWORD_DEFAULT);
                              //envoie mail avec mdp provisoire
                              $message= "Bonjour, voici votre mot de passe provisoire pour vous connecter : $mdp_provisoire";
                              echo "<br> Un email vous à été envoyé avec un mot de passe provisoire.";
                              mail($lemail, 'Mot de passe oublié sur le site TI',$message);

                              $requete2 = "UPDATE utilisateur SET mdp = '$passwordhash2' WHERE email = '$lemail'";
                              $resultat2 = mysqli_query($connexion, $requete2);
                            }
                            else 
                            {
                              echo "ERREUR : Email introuvable";
                            }       
                    // Fermeture de la connexion
                    mysqli_close($connexion);
                }
                else 
                {
                  echo "ERREUR";
                }
            }
            ?>
             
              <form method="POST">
                <div class="field padding-bottom--24">
                  <label for="email">email</label>
                  <input type="email" name="email" required>
                </div>
                <div class="field padding-bottom--24">
                  <input type="submit" name="submit" value="Valider">
                </div>
              </form>
              <a href="../AP1/index.php">Retour à la connexion</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</body>

</html>