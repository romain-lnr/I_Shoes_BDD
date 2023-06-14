<?php
/**
 * Created by Romain Lenoir.
 * Date: 12.03.2023
 * Desc: Login page for log in to an account.
 */

$title="IShoes - login page"; ?>
        <div id="container">
            <form action="<?=route('users/logged/')?>" method="POST">
                <div class="form-group">
                    <h1>Connexion</h1>
                    <label><b>Nom d'utilisateur</b></label>
                    <input type="text" class="form-control" placeholder="Entrer le nom d'utilisateur" name="id_user" required>
                    <label><b>Mot de passe</b></label>
                    <input type="password" class="form-control" placeholder="Entrer le mot de passe" name="password" required>
                    <input type="submit" class="form-control" name="insert" value='LOGIN' >
                </div>
                <a href="<?=route("users/register/")?>" style="float: right;"><b>Nouvel Utilisateur</b></a>
                <a href="<?=route("users/home/")?>" style="float: left;"><b>Retour</b></a>

		    <?php
                if(isset($bag['data']['error'])){
                    $error = $bag['data']['error'];
                    if($error == "LogNotTrue") echo "<br><p style='color:red'>Erreur : Vos coordonnéess sont incorrectes</p>";
                    if($error == "NotLog") echo "<br><p style='color:red'>Erreur : Veuillez vous connecter</p>";
                }
                ?>
            </form>
        </div>