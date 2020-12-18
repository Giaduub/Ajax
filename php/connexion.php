<?php
// On active l'accès à la session
session_start();


if(isset($_POST) && !empty($_POST)){

    // On vérifie que tous les champs sont remplis
    if(isset($_POST['pseudo']) && !empty($_POST['pseudo']) && isset($_POST['pass']) && !empty($_POST['pass'])){
        // On récupère les valeurs saisies
        $pseudo= strip_tags($_POST['pseudo']);
        $pass = $_POST['pass'];

        // On vérifie si l'email existe dans la base de données
        // On se connecte à la base
        require_once('../php/bdd.php');

        // On écrit la requête
        $sql = 'SELECT * FROM `users` WHERE `pseudo` = :pseudo;';

        // On prépare la requête
        $query = $db->prepare($sql);

        // On injecte (terme scientifique) les valeurs
        $query->bindValue(':pseudo', $pseudo, PDO::PARAM_STR);

        // On exécute la requête
        $query->execute();

        // On récupère les données
        $user = $query->fetch(PDO::FETCH_ASSOC);

        // Soit on a une réponse dans $user, soit non
        // On vérifie si on a une réponse
        if(!$user){
            echo 'Pseudo et/ou mot de passe invalide';
        }else{
            // On vérifie que le mot de passe saisi correspond à celui en base
            // password_verify($passEnClairSaisi, $passBaseDeDonnees)
            if($pass == $user['password']){
                // On crée la session "user"
                // On ne stocke JAMAIS de données dont on ne maîtrise pas le contenu
                $_SESSION['user'] = [
                    'id'    => $user['id'],
                    'nom' => $user['nom'],
                    'pseudo'  => $user['pseudo']
                ];

                header('Location: ../index.php');
            }else{
                echo 'Email et/ou mot de passe invalide';
            }
        }

    }else{
        echo "Veuillez remplir tous les champs...";
    }
}
?>


<?php include ('header.php')?>
<div class="container">
<div class="col-12 my-1">
    <h1>Connexion</h1>
    <form method="post">
        <div class="form-group">
            <label for="email">Pseudo :</label>
            <input class="form-control" type="text" id="pseudo" name="pseudo">
        </div>
        <div class="form-group">
            <label for="pass">Mot de passe :</label>
            <input class="form-control" type="password" id="pass" name="pass">
        </div>
        <button class="btn btn-primary">Me connecter</button>
    </form>
</div>
</div>