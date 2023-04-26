<?php
/**
 * Created by Romain Lenoir.
 * Date: 12.03.2023
 * Desc: Login page for log in to an account.
 */

// tampon de flux stocké en mémoire
$title="IShoes - login page";
ob_start();
?>
        <div id="container">
            <form action="index.php?action=logged" method="POST">
                <div class="form-group">
                    <h1>Connexion</h1>
                    <label><b>Nom d'utilisateur</b></label>
                    <input type="text" class="form-control" placeholder="Entrer le nom d'utilisateur" name="id_user" required>
                    <label><b>Mot de passe</b></label>
                    <input type="password" class="form-control" placeholder="Entrer le mot de passe" name="password" required>
                    <input type="submit" class="form-control" name="insert" value='LOGIN' >
                </div>
                <a href="index.php?action=register" style="float: right;"><b>Nouvel Utilisateur</b></a>
                <a href="index.php?action=home" style="float: left;"><b>Retour</b></a>

		    <?php
                if(isset($_GET['error'])){
                    $error = $_GET['error'];
                    if($error == "user_not_correct") echo "<br><p style='color:red'>Utilisateur ou mot de passe incorrect</p>";
                    if($error == "password_not_correct") echo "<br><p style='color:red'>Utilisateur ou mot de passe incorrect</p>";
                    if($error == "not_login") echo "<br><p style='color:red'>Veuillez vous connecter</p>";
                }
                ?>
            </form>
        </div>
<?php $content = ob_get_clean();
require "layout_form.php"; ?>
