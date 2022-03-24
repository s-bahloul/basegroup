<?php
//Demarrer la session php
session_start();
if(isset($_SESSION["email"])){

//Connexion a la base de donnée ecommer via PDO
//Les variable de phpmyadmin
$user = "root";
$pass = "";
//test d'erreur
try {
    /*
     * PHP Data Objects est une extension définissant l'interface pour accéder à une base de données avec PHP. Elle est orientée objet, la classe s’appelant PDO.
     */
    //Instance de la classe PDO (Php Data Object)
    $dbh = new PDO('mysql:host=localhost;dbname=basegroup', $user, $pass);
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
    //Requète SQL de selection des produits
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
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">

    <title>PHP CRUD CONNEXION</title>
    <title>Supprimer des élèves</title>
</head>
<body>

<!--on appelle le menue-->
<header>
    <?php
    require_once "navbar.php";
    ?>
</header>

<!--on recupere les élements du formulaire avec la method post qui les récupère par un fichier-->
<form method="post" id="form-delete">
    <p class="text-center text-danger">SUPPRIMER L'ELEVE</p>
    <p class="text-center text-success"><?= $details['nom_eleve'] ?></p>
    <p class="text-center text-warning"><?= $details['prenom_eleve'] ?></p>
    <p class="text-center text-info">
        <img src="<?= $details['avatar_eleve'] ?>" class="img-thumbnail" alt="" title="" width="200"/>
    </p>
    <p class="text-center text-warning"><?= $details['date_naissance_eleve'] ?></p>
    <p class="text-center text-warning"><?= $details['age_eleve'] ?></p>
    <p class="text-center text-warning"><?= $details['classe_eleve'] ?></p>

    <p class="form-control" name="absence_eleve" id="absence_eleve" required>
        <option value="0">OUI</option>
        <option value="1">NON</option>
    </p>
    <button type="submit" name="btn-supprimer" class="btn btn-success">confirmer la suppression</button>

</form>

<div class="d-flex justify-center">
    <button type="submit" name="btn-deconnexion">DECONNEXION</button>
    <a href="eleve.php" class="btn btn-primary">Annuler</a>

</div>


<?php
if(isset($_POST['btn-supprimer'])){
//ecrire une requete sql qui supprime votre l'élève
$sql ='DELETE FROM eleve WHERE id_Student = ?';
//Créer une requète préparée pour lutter contre les injection sql

//créer une requête préparée pour lutter contre les injections SQL
$supp = $dbh->prepare($sql);

//Récup de id de l'élève
$idEleve = $_GET['id_Student'];

//lié les paramétres du bouton à la requète SQL
$supp->bindParam (1, $id_Student);
$supp->execute();

if($supp){
echo "<p class='container alert alert-success'>Lélève a bien été supprimer!</p>";
echo "<div class='container'><a  href='eleve.php' class='mt-3 btn-success'>RETOUR</a></div>";

// On cache les détails de l'élève avec du CSS
?>
<style>
    #form-delete {
        display: none;
    }
</style>
<?php
    }else{
        //Sinon message d'erreur et on recomence
        echo "<p class='alert alert-danger'>Erreur lors de la supression de l'élève!</p>";
        echo "<div class='container'><a href='eleve.php' class='mt-3 btn btn-success'>RETOUR</a></div>";
    }
}




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
    header("Location: index.php");
}
?>

</body>
</html>

