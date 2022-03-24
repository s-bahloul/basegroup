<?php
//demarer la session
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
    
    
    <title>Traitement mise à jour</title>

</head>
<body>

    <?php

//$_FILES — Variable de téléchargement de fichier via HTTP
if(isset($_FILES['avatar_prof'])){
    
    //recupérer son image dans le dossier destination
    $destinPhoto = "../img/";

    //basename — Retourne le nom de la composante finale d'un chemin

 $profPhoto = $destinPhoto . basename($_FILES['avatar_prof']['name']);
    //On recupére la photo et on l'assigne au repertoire de destination 
   
    $_POST['avatar_prof'] =  $profPhoto ;
    
    //Faire la condition de reussite
    //move_uploaded_file — Déplace un fichier téléchargé

    if(move_uploaded_file($_FILES['avatar_prof']['tmp_name'], $profPhoto)){

        echo "<h2 class='text-center'>Le fichier est téléchargé avec succès !</h2>";

        //afficher l'erreur sur le téléchargement du fichier
    }else{
        echo "<h2 class='text-center'>Erreur lors du téléchargement de votre fichier !</h2>";
    }
    
    //erreur sur le format de l'image
}else{
    echo "<h2 class='text-center'>Fichier invalide : seul les format .png, .jpg, .bmp, .svg, .webp sont autorisé !</h2>";
}


//faire la connexion avec la variable phpmyadmin
$user = "root";
$pass = "" ;

//faire le test en cas d'erreur pour avoir le contenu de la page avec le try catch
try {
    //faire la class PDO (l'orienté objet)
    $baseDonnee1 = new PDO('mysql:host=localhost;dbname=basegroup;charset=UTF8', $user, $pass);

    // faire le Debug de pdo
  
    $baseDonnee1->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "<h4 class='container alert alert-info text-center'>Connexion a PDO MySQL</h4>";

    //catch pour attraper l'exception
}catch(PDOException $e){
    print "Erreur !: " . $e->getMessage() . "<br>";
    die();
}  
//la condition pour la requete de selection

//faire la requette SQL de type SELECT
if($baseDonnee1){
//UPDATE permet de dire qu'on va modifier une entrée
$sql = "UPDATE `professeurs` SET `nom_prof`= ?,`prenom_prof`= ?,`avatar_prof`= ?,`date_naissance_prof`= ?,`tel_prof`= ?,`email_prof`= ?,`age_prof`= ?,`metier_prof`= ? WHERE id_prof = ?";
//Requète préparée = connexion + methode prepare + requete sql
$nouveau = $baseDonnee1->prepare($sql);

//Liés les paramètre du formulaire a la table phpmyadmin

//Lier chaque paramètre à un nom de variable 

$nouveau->execute(array(

$_POST['nom_prof'],
$_POST['prenom_prof'],
$_POST['avatar_prof'],
$_POST['date_naissance_prof'],
$_POST['tel_prof'],
$_POST['email_prof'],
$_POST['age_prof'],
$_POST['metier_prof'],

$_GET['id_prof']
));

//condition si la mise à jour est faite

if($nouveau){
    echo "<h2 class='text-center'>La mise à jour est faite avec succès !</h2>";
    echo "<div class='text-center'><a href='accueil.php' class='container btn btn-info'>Voir la mise à jour</a></div> ";
}else{
    echo "<h2 class='alert alert-danger'>Erreur lors de la mise à jour</h2>";
}
}

        }else{
            header("location :../index.php");
        }
        ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>
