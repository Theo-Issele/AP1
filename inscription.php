<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="Inscription.css">
    <title>Inscription</title>
</head>

<body>
    <div class="container">
        <h1>Inscription</h1>
        <form action="inscription2.php" method="POST">
            <div class="form-group">
                <label for="login">Login</label>
                <input type="text" id="login" name="login" required>
            </div>

            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password" required>
            </div>

            <div class="form-group">
                <label for="password2">Répéter le mot de passe</label>
                <input type="password" id="password2" name="password2" required>
            </div>

            <div class="form-group">
                <label for="nom">Nom</label>
                <input type="text" id="nom" name="nom" required>
            </div>

            <div class="form-group">
                <label for="prenom">Prénom</label>
                <input type="text" id="prenom" name="prenom" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="categorie">Catégorie</label>
                <div class="radio-group">
                    <input type="radio" id="eleve" name="categorie" value="eleve" required>
                    <label for="eleve">Elève</label>
                    
                    <input type="radio" id="prof" name="categorie" value="prof">
                    <label for="prof">Professeur</label>
                </div>
            </div>

            <div class="form-group">
                <button type="submit">S'inscrire</button>
            </div>

        </form>

    </div>
    
</body>
</html>
