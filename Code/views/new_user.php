<?php
/**
 * Created by Romain Lenoir.
 * Date: 12.03.2023
 * Desc: new_user page for create an account.
 */

// tampon de flux stocké en mémoire
$title="IShoes - new_user page";
ob_start();
?>
    <div id="container">
        <form action="index.php?action=insert_user" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <h1>Nouvel Utilisateur</h1>
                <label for="id_user"><b>Pseudo</b></label>
                <input type="text" class="form-control" placeholder="Entrer le nom d'utilisateur" name="id_user" maxlength="15" required>
                <label for="prenom"><b>Prénom</b></label>
                <input type="text" class="form-control" placeholder="Entrer le prénom" name="prenom" maxlength="15" required>
                <label for="nom"><b>Nom</b></label>
                <input type="text" class="form-control" placeholder="Entrer le nom" name="nom" maxlength="30" required>
                <label for="email"><b>Email</b></label>
                <input type="email" class="form-control" placeholder="Entrer l'email" name="email" maxlength="30" required>
                <label for="password"><b>Mot de passe</b></label>
                <input type="password" class="form-control" placeholder="Entrer le mot de passe" maxlength="25" name="password" required>
                <input type="submit" class="form-control" name="insert" value="ENREGISTRER">
            </div>
        </form>
        <?php
        if(isset($_GET['error'])){
            $error = $_GET['error'];
            if($error == "user_not_unique") echo "<p style='color:red'>Votre utilisateur n'est pas unique</p>";
        }
        ?>
    </div>
<?php $content = ob_get_clean();
require "layout_form.php";
