<?php session_start(); ?>



<!doctype html>
<form lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PROJET ECOLE GROUPE </title>
   <title>page d'acueil index.po </title>

</head>
<!--creer un formulaire avec la methode post-->
<div class="container-fluid">
    <form id="form-login" method="post">
        <div class="text-center">
            <img src="" alt="" title="">
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">email</label>
            <input type="email" class="form-control" id="email" ,name="email" required>
        </div>

        <div class="mb-3">
             <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
    </div>
    <a href="">mot de passe oublier?</a>
    <br />
    <button type="submit" name="btn-connexion" class="mt-3 btn btn-warning">Connexion</button>
</form>

    ?php
    //creer la method post pourb récuperer le bouton btnconnect
    if (isset($_POST['btn-connexion'])){

    //fait un click, var_dump ($email);
    connection ();
    var_dump("ok click");
    }

<p>Hello marine</p>
<p>Le travail de saida</p>
</div>

</body>
</html>



