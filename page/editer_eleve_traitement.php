<?php
session_start();
if(isset($_SESSION["email"])){
?>
<!doctype html>
<html lang="en">
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

    <title>PHP CRUD CONNECTION</title>
    <title> Traitement élèves editer</title>
</head>
<body>

<header>
    <?php require_once 'menu.php'?>
</header>


<!--important n,e pas oblier le enctype-->
<!--Upload de fichier-->
<form enctype="multipart/form-data>

<?php
//Existance de ma superglobale $_FILES-->
//<input de type file + attribut name="">

if(isset($_FILES['avatar_eleve'])){
    //Repertoire de destination
    $repertoireDestination = "../img/";
    //La photo uploader
    //basename — Retourne le nom de la composante finale d'un chemin
    //dans tableau multi dimmension 1 = image 2 = son nom
    $photo_eleve = $repertoireDestination . basename($_FILES['avatar_eleve']['name']);
    //Recup de l'image uploader
    //On assigne l'image uploader au repertoire de destination + la photo + son nom
    $_POST['image_produit'] = $photo_produit;

    //Les conditions de resussite
    //move_uploaded_file — Déplace un fichier téléchargé
    //On assigne a la photo un nom temporaire random en cas d'echec d'upload
    if(move_uploaded_file($_FILES['avatar_eleve']['tmp_name'], $photo_eleve)){
        echo "<p class='container alert alert-success'>Le fichier est valide et téléchargé avec succès !</p>";
    }else{
        echo "<p class='container alert alert-danger'>Erreur lors du téléchargement de votre fichier !</p>";
    }
}else{
    echo "<p class='container alert alert-danger'>Le fichier est invalide seul les format .png, .jpg, .bmp, .svg, .webp sont autorisé !</p>";
}


//Connexion a la base de donnée basegroup via PDO
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
    $sql = "UPDATE `eleves` SET `id_student`= ?,`nom_eleve`= ?,`avatar_eleve`= ?,`date_naissance_eleve`= ?,`age_eleve`= ?,`classe_eleve`= ? WHERE absence_eleve = ?";


    //Requète préparée = connexion + methode prepare + requete sql
    //Les requètes préparée lutte contre les injections SQL
    //PDO::prepare — Prépare une requête à l'exécution et retourne un objet
    $update = $dbh->prepare($sql);
    //executer la requète préparée
    //PDOStatement::execute — Exécute une requête préparée
    //Elle execute la reqète passé dans un tableau de valeur
    $update->execute(array(
        $_POST['id_student'],
        $_POST['nom_eleve'],
        $_POST['avatar_eleve'],
        $_POST['date_naissance_eleve'],
        $_POST['age_eleve'],
        $_POST['classe_eleve'],
        $_GET['absence_eleve']


    ));

    if($update){
        echo "<p class='container alert alert-success'> L'élève a été mis à jour!</p>";

    }else{
        echo "<p class='alert alert-danger'>Erreur lors de l'ajout de l'élève</p>";
    }
}
}else{
    echo "<a href='' class='btn btn-warning'>S'inscrire</a>";
}
?>
</body>
</html>