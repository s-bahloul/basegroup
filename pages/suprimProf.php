<?php

//pour une nouvelle session (demarer)

session_start();
if(isset($_SESSION['email'])){

?>

<h1 class="h1-accueil">Bienvenue</h1>

<p class="h1-accueil"><?= $_SESSION['email'] ?></p>

<!DOCTYPE html>

<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Suppression des coordonnées</title>
</head>
<header>
        <?php
        require_once "navbar.php";
        ?>
    </header>
<body>
        <!--faire les variable de phpmyadmin-->
        <?php
        $user = "root";
        $pass = "";
        //faire le try catch pour les erreurs
        try{
            $baseDonnee1 = new PDO('mysql:host=localhost; dbname=basegroup; charset=UTF8', $user, $pass);
            
            //faire le debug
            $baseDonnee1->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
            echo "<h4 class='container alert alert-info text-center'>Connexion a PDO MySQL</h4>";

        }catch(PDOException $e){
            print "ERREUR !: " . $e->getMessage() . "<br>";
            die();
        }

        //Requète SQL de selection des prof
    $sql = "SELECT * FROM professeurs WHERE id_prof = ?";
    //variable idProf
    $idProf = $_GET['id_prof'];

    //preparer la requette avec "prepare"
    //Lorsque la requête est préparée, la base de données va analyser, 
    //compiler et optimiser son plan pour exécuter la requête.
    $requete = $baseDonnee1->prepare($sql);

    //recuperer la valeur id grace à $-GET['id_prof'] et l'analyser
    $requete->bindParam(1, $idProf);
    //exécuter la requête
    $requete->execute();

    //PDO:FETCH_ASSOCplace les résultats dans un tableau où les valeurs 
    //sont mappées à leurs noms de champ.
    $coordoneProf = $requete->fetch(PDO::FETCH_ASSOC);

}
?>
    <div class="container bg-dark">
        <div class="mx-auto bg-info w-50" id="coordonneProf">
    

            <img src="<?= $coordoneProf['avatar_prof'] ?>" class="card-img-top" alt="avatar-prof">

            <div class="card-body" >

                <h5 class="card-title"><?=$coordoneProf['nom_prof']?> <?=$coordoneProf['prenom_prof']?></h5>
                <p class="card-text"><?= $coordoneProf['date_naissance_prof'] ?></p>
                <p class="card-text"><?= $coordoneProf['age_prof'] ?></p>
                <p class="card-text"><?= $coordoneProf['tel_prof'] ?></p>
                <p class="card-text"><?= $coordoneProf['email_prof'] ?></p>
                <p class="card-text"><?= $coordoneProf['metier_prof'] ?></p>
                <p class="card-text"><?= $coordoneProf['etat_prof'] ?></p>

                <h4 class="text-center text-white">Supprimer les coordonnées de m'enseignant</h4>

                <div class="container">

                <form method="post">
                    <button type="submit" name="btn-supprimer" class="btn btn-outline-primary btn-lg mb-2">Confimer la supression</button>
                </form>

                <a href="accueil.php" class="btn btn-outline-primary btn-lg mb-2">Annuler</a>
                </div>

            </div>
        </div>

    </div>
    <?php
    if(isset($_POST['btn-supprimer'])){

        //selectionner des enseignants
        $sql = "DELETE FROM professeurs WHERE id_prof = ?";

        //  preparer la requete sql 

        $effacer = $baseDonnee1->prepare($sql);

        //Recup de id de la table professeurs
        $idProf = $_GET['id_prof'];

        //Lié les paramètres du bouton a la requète SQL
        $effacer->bindParam(1, $idProf);

        //exécuter la requete
        $effacer->execute();

        if($effacer){

            echo "<h2 class='text-center'>Les coordonnées de l'enseignant sont supprimés !</h2>";
            ?>
            <style>
                #coordonneProf{
                    display: none;
                }
            </style>
            <?php
    
            
            //faire le bouton de retours sur la page produits
            echo "<div class='container'><a href='accueil.php' class='mt-3 btn btn-success'>Retour sur la liste des enseignants</a></div>";
           
        }else{
            echo "<p class='alert alert-danger'>Erreur  !</p>";
            }

    }else{
            echo "<a href='' class='btn btn-info'>S'inscrire</a>";
            header("location :../index.php");
        }
    
    ?>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>
