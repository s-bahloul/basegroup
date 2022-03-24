<?php
//Demarrer la session php
session_start();
if(isset($_SESSION["email"])){

    //Connexion a la base de donnée basegroupe via PDO
//Les variable de phpmyadmin
    $user = "root";
    $pass = "";
//test d'erreur
    try {
        /*
         * PHP Data Objects est une extension définissant l'interface pour accéder à une base de données avec PHP. Elle est orientée objet, la classe s’appelant PDO.
         */
        //Instance de la classe PDO (Php Data Object)
        $dbh = new PDO('mysql:host=localhost;dbname=basegroup;charset=UTF8', $user, $pass);
        //Debug de pdo
        /*
         * L'opérateur de résolution de portée (aussi appelé Paamayim Nekudotayim) ou, en termes plus simples,
         * le symbole "double deux-points" (::), fournit un moyen d'accéder aux membres static ou constant, ainsi qu'aux propriétés ou méthodes surchargées d'une classe.
         */
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "<p class='container alert alert-success text-center'>Vous êtes connectez a PDO MySQL</p>";

    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }

    if($dbh){
        //Requète SQL de selection des élèves
        $sql = "SELECT * FROM eleves WHERE id_student = ?";

        $id_student = $_GET['id_student'];
        //Grace a PDO on accède à la methode query()
        //Requète préparée
        $request = $dbh->prepare($sql);
        //Lié les paramètres
        $request->bindParam(1, $id_student);

        //Execution de la requète
        $request->execute();
        //Retourne un objet de resultats
        $details = $request->fetch(PDO::FETCH_ASSOC);

    }

    ?>
    <!doctype html>
    <html lang="fr">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->

        <link href="../css/bootstrap.css" rel="stylesheet"/>
        <link href="../css/styles.css" rel="stylesheet"/>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Cabin:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

        <title>PHP CRUD CONNEXION</title>
        <title>Description élève</title>
    </head>
    <body>
    <header>
        <?php
        require_once "navbar.php";
        ?>
    </header>
    <div class="container-fluid">
            <span class="mt-3 d-flex justify-content-around">
                <h3 class="mt-3 text-warning">BIENVENUE <?= $_SESSION['email'] ?></h3>
                <form method="post">
                    <button id="btn-deconnexion" name="btn-deconnexion" class="btn btn-danger">DECONNEXION</button>
                </form>
            </span>





        <div class="container">

            <!--On passe ID pour le traitement-->
            <form method="post">
                <p class="text-center text-danger">COORDONNE DES ELEVES</p>
                <p class="text-center text-danger"><?= $details['nom_eleve'] ?></p>
                <p class="text-center text-danger"><?= $details['prenom_eleve'] ?></p>
                <p class="text-center text-danger"><?= $details['date_naissance_eleve'] ?></p>
                <p class="text-center text-danger"><?= $details['age_eleve'] ?></p>
                <p class="text-center text-danger"><?= $details['classe_eleve'] ?></p>
                <p class="text-center text-danger">
                    <img src="<?= $details['avatar_eleve'] ?>" class="img-thumbnail" alt="" title="" width="200"/>
                </p>

                <div class="d-flex justify-center">
                    <button type="submit" name="btn-deconnexion">DECONNEXION</button>
                    <a href="../page/eleve.php" class="btn btn-primary">Annuler</a>

                </div>

            </form>


        </div
    </div>
    </body>
    </html>


    <?php

    //Deconnexion et destruction de la session $_SESSION['email']
    function deconnexion(){
        var_dump("hello");
        echo "elloo";
        session_unset();
        session_destroy();

    }

    //Click sur le bouton de deconnexion
    if(isset($_POST['btn-deconnexion'])){
        deconnexion();
    }

}else{
    header("Location: ../index.php");
}








