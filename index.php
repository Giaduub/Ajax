<?php include ('php/header.php') ?>
    <body>

<div class="container">
    <?php
session_start();
if(isset($_SESSION['user']) && !empty($_SESSION['user'])){
    // Ici, l'utilisateur est connecté
    ?>
    <p>Bonjour <?= $_SESSION['user']['pseudo'] ?> <a class="btn btn-danger" href="php/deconnexion.php">Déconnexion</a></p>
<?php
}else{
    // Ici l'utilisateur n'est pas connecté
    ?>
    <a class="btn btn-primary mr-2" href="php/connexion.php">Connexion</a>
<?php
}
?>
</div>
 <section class="chat">
    <div class='container'>
        <div class="row">
        <div class="col-8 my-1">
            <div class="p-2" id="discussion">
            </div>
        </div>
</div>
    
        <main class="row">
            <div class=" col-8 saisie">
                <form method="POST">
                    <div class="input-group">

                        <input type="text" class="white form-control" id="texte" placeholder="Entrez votre texte">
                        <div class="input-group-append">
                            <span class="white input-group-text" id="valid">Envoyer</span>
                        </div>


                    </div>
                </form>
                <div id="reponse"></div>
            </div>

     </div>
        </main>
</section>
    <script type="text/javascript" src="js/script.js"></script>
    </body>

</html>