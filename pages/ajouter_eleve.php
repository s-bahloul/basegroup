<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono&display=swap" rel="stylesheet">

    <title>PHP CRUD CONNECTION</title>
    <title> Page Ajouter élève</title>
</head>
<body>

<header>
    <?php require_once 'menu.php' ?>
</header>

<div class="container-fluid">
            <span class="mt-3 d-flex justify-content-around">
                <h3 class="mt-3 text-warning">BIENVENUE <?= $_SESSION['email'] ?></h3>
                <form method="post">
                    <button id="btn-deconnexion" name="btn-deconnexion" class="btn btn-danger">DECONNEXION</button>
                </form>
            </span>


    <!--Creation formulaire traitement ajout d'un élève-->
    <div class="container">
        <!--ajout de l'attribut enctype qui Permet de telecharger  tous type de fichier (.pdf, .txt, .jpg,.webp, etc...)-->

        <form action="ajouter_eleve_traitement.php" id="form-login" method="post" enctype="multipart/form-data">
            <div class="text-center">
                <img src="image/imageslogoe.jpg" alt="logo e-commerce" title="ecommerce.com">
            </div>
            <div class="mb-3">
                <label for="nom_eleve" class="form-label">Nom de l'élève</label>
                <input type="text" class="form-control" id="nom_eleve" name="nom_eleve" required>
            </div>

            <div class="mb-3">
                <label for="prenom_eleve" class="form-label">Prénom de l'élève</label>
                <textarea class="form-control" rows="5" id="prenom_eleve" name="prenom_eleve"
                          required></textarea>
            </div>

            <div class="mb-3">
                <label for="avatar_eleve" class="form-label">Avatar de l'élève</label>
                <input type="file" class="form-control" id="avatar_eleve" name="avatar_eleve" required>
            </div>

            <div class="mb-3">
                <label for="date_naissance_eleve" class="form-label">Date de naissance de l'élève</label>
                <input type="date" class="form-control" id="date_naissance_eleve" name="date_naissance_eleve" required>
            </div>


            <div class="mb-3">
                <label for="age_eleve" class="form-label">Age de l'élève</label>
                <input type="number" class="form-control" id="age_eleve" name="age_eleve" required>
            </div>

            <div class="mb-3">
                <label for="classe_eleve" class="form-label">Classe de l'élève</label>
                <input type="number" class="form-control" id="classe_eleve" name="classe_eleve" required>
            </div>



            <label for="absence_ eleve" class="form-label">Absence de l'élève</label>
                <select class="form-control" name="absence_eleve" id="absence_ eleve" required>
                    <option value="0">OUI</option>
                    <option value="1">NON</option>
                </select>
            </div>




            <div class="d-flex justify-content-around">
                <button type="submit" name="btn-connexion" class="btn btn-warning">Ajouter</button>
                <a href="produit.php" class="btn btn-success">Annuler</a>
            </div>
        </form>

    </div>
</div>

<?php
//Deconnexion et destruction de la session $_SESSION['email']
function deconnexion()
{
    var_dump("hello");
    echo "elloo";
    session_unset();
    session_destroy();
    //header('Location: index.php');
}

//Click sur le bouton de deconnexion
if (isset($_POST['btn-deconnexion'])) {
    deconnexion();
}


?>

<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
</body>
</html>