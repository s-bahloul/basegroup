<?php
if (isset($_SESSION["email"])){
echo "Bienvenue : " . $_SESSION["email"];
?>


<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/styles.css">

    <title> CRUD GROUPE </title>
    <title>La liste des élèves </title>
</head>


<body>

<header>
<?php require_once 'menu.php' ?>
></header>



<?php
// connexion de base de donnée basegroup via PDO
// Les variables de phpmyadmin
$user = "root";
$pass = "";

//test d'erreur
try {
    //Instance de la classe PDO (Php Data Object)
    $dbh = new PDO('mysql:host=localhost;dbname=basegroup', $user, $pass);
    // PHP Data Objects est une extension définissant l'interface pour accéder à une base de données avec php. elle est orientée objet, la clase s'appelant PDO.

//Instance de la classe PDO (Php Data Object)
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// ci- dessous vous etes connectés à PDO est caché en utilisant un commmentaire en php


//echo "<p class='container alert alert-success text-center'>Vous êtes connnectez à PDO My SQL</p>";

} catch (PDOException $e) {
    print "erreur!: " . $e->getMessage() . "<br/>";
    die();
}


//Deconnexion et destruction de la session $_SESSION['email']
function deconnexion()
{
    var_dump("hello");
    echo "elloo";
    session_unset();
    session_destroy();
    header('Location: index.php');
}

//Click sur le bouton de deconnexion
if (isset($_POST['btn-deconnexion'])) {
    deconnexion();
}



// Je créeais la requete pour afficher la table élèves

if ($dbh) {
    //Requète SQL de selection des élèves
    $sql = "SELECT * FROM eleves";
    // Gràace à PDO on accède à la method query ()
    //PDO::query() prépare et exécute une requête préparée et, une fois exécutée, le jeu de résultats associé.
    $eleves = $dbh->query("$sql");

}

?>



    <div class="text-center">
        <a href="cordonneEleve.php"class="btn btn-danger">Ajouter un élève</a>
    </div>

    <h3 class="mt-3 text-warning">La liste des élèves</h3>


<div class="row">
        <!--Pour chaque col on affiche une ligne de la table éleves de la BDD ecommerce-->
        <?php
            foreach ($eleves as $eleve){
        ?>
                        <img src="<?= $eleve['avatar_eleve'] ?>" class="carte-img-top img-fluid">
                             alt="<?=$eleve['nom_eleve']?><?=$eleve['prenom_eleve']?>" title="<?= $eleve['prenom_eleve'] ?><?=$eleve['prenom_eleve']?>"
                                 <h4 class="title-carte text-danger"><?= $eleves['nom_eleve'] ?><?=$eleve['prenom_eleve']?></h4>


                            <?php
                            //var_dump($eleve['abcence_eleve']);
                            if ($eleve['absence_eleve'] == true) {
                                echo "Oui";
                            } else {
                                echo "NON";
                            }
                            ?>
                        </div>

                        </br>

                            <a href="cordonneEleve.php?id_produit=<?= $eleve['id_eleve'] ?>"
                               class="mt-2 btn btn-success">Coordonnés de l'élève</a>

                            <a href="miseajour.php?id_produit=<?= $eleve['id_eleve'] ?>"
                               class="mt-2 btn btn-warning">mise à jour des coordonnées</a>

                            <a href="supprimer_eleves.php?id_produit=<?= $eleve['id_eleve'] ?>"
                               class="mt-2 btn btn-danger">Supprimer l'élève</a>

                        </div>


                    </div>
                </div>
            </div>


</div>
    <?php
    } else {
        echo "<a href='' class='btn btn-warning'>S'inscrire</a>";
        header('Location: index.php');
    }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
            crossorigin="anonymous"></script>
</body>
</html>
