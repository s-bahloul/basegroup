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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Ajouter produit</title>
</head>

<body>

<div class="container">
    <!--créer le formulaire et utiliser l"ID pour le traitement-->
   <!-- L' enctype attribut spécifie comment les données du formulaire doivent 
   être encodées lors de leur soumission au serveur, peut être utilisé que si method="post".-->

   <form  action="traitementMisJour.php?id_prof=<?= $coordoneProf['id_prof'] ?>" method="post" id="form-update"  enctype="multipart/form-data">
        <h1 class="text-center text-primary bg-info">Mise à jour des coordonnées de l'enseignant </h1>

            <div class="md-3">
                <label for="nom_prof">Nom </label>
                <input type="text" class="form-control" id="nom_prof" name="nom_prof" placeholder="<?= $coordoneProf['nom_prof'] ?>" required>
            </div>

            <div class="md-3">
                <label for="prenom_prof">Prenom </label>
                <input type="text" class="form-control" id="prenom_prof" name="prenom_prof" placeholder="<?= $coordoneProf['prenom_prof'] ?>" required>
            </div>
            <div class="md-3">
                <label for="avatar_prof">Image du Produit</label>
                <input type="file" class="form-control" id="avatar_prof" name="avatar_prof" placeholder="<?= $coordoneProf['avatar_prof'] ?>" required>
            </div>

            <div class="md-3">
                <label for="date_naissance">Date de naissance</label>
                <input type="date" class="form-control" id="date_naissance"  name="date_naissance_prof" placeholder="<?= $coordoneProf['date_naissance_prof'] ?>" required>
            </div>
            <div class="md-3">
                <label for="">Numéro de téléphone</label>
                <input type="tel"  class="form-control" id="telNo"  name="tel_prof" placeholder="<?= $coordoneProf['tel_prof'] ?>" required>
            </div>
            <div class="md-3">
                <label for="email"  ><b>Email</b></label>
                <input type="email" placeholder="<?= $coordoneProf['email_prof'] ?>" name="email_prof" required>
            </div>

            <div class="md-3">
                <label for="age_prof">Age </label>
                <input type="number"  class="form-control" id="age-prof"  name="age_prof" placeholder="<?= $coordoneProf['age_prof'] ?>" required>
                
            </div>
            <div class="md-3">
                <label for="metier-prof">Matiére</label>
                <input type="text" class="form-control" id="metier_prof" name="metier_prof" placeholder="<?= $coordoneProf['metier_prof'] ?>" required>
            </div>

            <div class="md-3">
                <label for="vaccin_prof">Enseignant vacciné</label>
                <select class="form-control" id="etat_prof" name="etat_prof" placeholder="<?= $coordoneProf['etat_prof'] ?>" required>
                    <option value="0"> Oui</option>
                    <option value="1"> Nom</option>
                </select>
            </div>

            </div>

        
        <button type="submit"  class="btn btn-primary" name="btnConnexion"> </button>
        <a href="accueil.php" class="btn btn-info">Annuler</a>

    </form>

</div>


<?php

 }else{
          
            header("location :../index.php");
 }
        
        ?>
</body>
</html>
