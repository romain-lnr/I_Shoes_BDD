<?php
/*
 * Test_login Function
 * Do: verify user informations in login page
 *
*/
function Test_login($id_user, $password) {

    // Load the file
    $JSONfile = 'data/dataUsers.json';
    $data = file_get_contents($JSONfile);
    // DECODE JSON flow
    $obj = json_decode($data);

    // access the appropriate element
    for ($i = 0; $i < count($obj); $i++) {
        if ($obj[$i]->username == $id_user) {
            if (password_verify($password, $obj[$i]->password)) {
                $_SESSION['id_user'] = $obj[$i]->username;
                $_SESSION['logged'] = true;
                if ($id_user == "admin" && $password == "admin") {
                    $_SESSION['admin_logged'] = true;
                    header("Location:index.php?action=admin");
                } else {
                    $_SESSION['admin_logged'] = false;
                    header("Location:index.php?action=home");
                }
                return;
            } else header("Location:index.php?error=password_not_correct");
        } else header("Location:index.php?error=user_not_correct");
    }
}

/*
 * Insert_user Function
 * Do: Create an account in dataUsers json file
 *
*/
function Insert_user($id_user, $prenom, $nom, $email, $password) {

    // Load the file
    $JSONfile = 'data/dataUsers.json';
    $contents = file_get_contents($JSONfile);

    // HASH Password
    $passhash = password_hash($password, PASSWORD_DEFAULT);

    // Decode the JSON data into a PHP array.
    $json = json_decode($contents, true);
    $user = array_search($id_user, array_column( $json, 'username' ) );
    if ($user !== false) {
        header("Location:index.php?error=user_not_unique");
        return;
    }
    else {
        $json[] = array("username" => $id_user, "firstname" => $prenom, "name" => $nom, "Email" => $email, "password" => $passhash);
    }

    // Encode the array back into a JSON string.
    $encode = json_encode($json, JSON_PRETTY_PRINT);

    // Save the file.
    file_put_contents('data/dataUsers.json', $encode);
    header("Location:index.php?action=login");
    exit();
}

/*
 * Add_article Function
 * Do: Create or update an article in dataArticles json file
 *
*/
function Add_article($id_article, $mark, $desc, $price, $stock_number, $imagepath, $filename) {

    // Load the file
    $JSONfile = 'data/dataArticles.json';
    $contents = file_get_contents($JSONfile);

    // Decode the JSON data into a PHP array.
    $json = json_decode($contents, true);
    $article = array_search($id_article, array_column( $json, 'article' ) );
    if ($article !== false) {
        $json[$article] = array("article" => $id_article, "mark" => $mark, "description" => $desc, "price" => $price, "stock" => $stock_number, "imagepath" => $imagepath, "image" => $filename);
    }
    else {
        $json[] = array("article" => $id_article, "mark" => $mark, "description" => $desc, "price" => $price, "stock" => $stock_number, "imagepath" => $imagepath, "image" => $filename);
    }

    // Encode the array back into a JSON string.
    $encode = json_encode($json, JSON_PRETTY_PRINT);

    // Save the file.
    file_put_contents('data/dataArticles.json', $encode);
}

/*
 * Test_login Function
 * Do: Show articles and update in home and admin page
 *
*/
function DisplayArticles($exit) {

    // Load the file
    $JSONfile = 'data/dataArticles.json';
    $data = file_get_contents($JSONfile);

    // DECODE JSON flow
    $obj = json_decode($data);
    $nb_article = count($obj);

    // access the appropriate element
     for ($i = 0; $i < $nb_article; $i++) {
        $name_article[$i] = $obj[$i]->article;
        $mark_article[$i] = $obj[$i]->mark;
        $desc_article[$i] = $obj[$i]->description;
        $price_article[$i] = $obj[$i]->price;
        $stock_article[$i] = $obj[$i]->stock;
        $imgpath_article[$i] = $obj[$i]->imagepath;
        $img_article[$i] = $obj[$i]->image;
    }
    switch ($exit) {
        case 'home':
            require "views/home.php";
            break;
        case 'admin':
            require "views/admin.php";
            break;
        case 'update_articles':
            for ($i = 0; $i < $nb_article; $i++) {
                $stock[$i] = $_POST["stock_number_".strval($i)];
                Add_article($name_article[$i], $mark_article[$i], $desc_article[$i], $price_article[$i], $stock[$i], $imgpath_article[$i], $img_article[$i]);
            }
            header("Location:index.php?action=home");
            exit();
    }
}

/*
 * Show_article Function
 * Do: display the requested articles for the user
 *
*/
function Show_article($id) {

    // Load the file
    $JSONfile = 'data/dataArticles.json';
    $data = file_get_contents($JSONfile);

    // DECODE JSON flux
    $obj = json_decode($data);

    // access the appropriate element
    $img_article = $obj[$id]->imagepath;
    $name_article = $obj[$id]->article;
    $mark_article = $obj[$id]->mark;
    $desc_article = $obj[$id]->description;
    $price_article = $obj[$id]->price;
    $stock_article = $obj[$id]->stock;

    require "views/show_article.php";
}

/*
 * Add_basket Function
 * Do: create an array when the user take an article in the basket
 *
*/
function Add_basket($id_user, $id, $number) {
    // Load the file
    $JSONfile = 'data/dataBasket.json';
    $contents = file_get_contents($JSONfile);

    // Decode the JSON data into a PHP array.
    $json = json_decode($contents, true);

    $boolValue = Test_value($id, $number);

    if ($boolValue) {

        // Affect the value
        AffectValueInArray($id, -$number);

        // Write in JSON
        $user_basket = array_search($id_user, array_column($json, 'username'));
        $id_basket = array_search($id, array_column($json, 'id_article'));

        if ($user_basket !== false && $id_basket !== false) {
            $json[$id_basket] = array("username" => $id_user, "id_article" => $id, "number" => $_SESSION['value'][$id] + $number);
            $_SESSION['value'][$id] += $number;
        } else {
            $json[] = array("username" => $id_user, "id_article" => $id, "number" => $number);
            $_SESSION['value'][$id] = $number;
        }
    } else {
        header("Location:index.php?error=not_even_stock");
        return;
    }

    // Encode the array back into a JSON string
    $encode = json_encode($json, JSON_PRETTY_PRINT);

    // Save the file.
    file_put_contents('data/dataBasket.json', $encode);
    header("Location:index.php?action=home");
    exit();
}

/*
 * Test_value Function
 * Do: return true or false if the user takes more article value than the stock of article
 *
*/
function Test_value($id, $number) {
    $JSONfile = 'data/dataArticles.json';
    $data = file_get_contents($JSONfile);
    $obj = json_decode($data);

    if ($obj[$id]->stock >= $number && $number >= 1) return true;
    else return false;
}

/*
 * AffectValueInArray Function
 * Do: add values in dataArticles json file
 *
*/
function AffectValueInArray($id, $number) {

    // Load the file
    $JSONfile = 'data/dataArticles.json';
    $data = file_get_contents($JSONfile);
    $obj = json_decode($data);

    $obj[$id]->stock += $number;

    // Encode the array back into a JSON string
    $encode = json_encode($obj, JSON_PRETTY_PRINT);

    // Save the file.
    file_put_contents('data/dataArticles.json', $encode);
}
/*
 * AddPurchaseToJSON Function
 * Do: create an array or arrays to the purchase page
 *
*/
function AddPurchaseToJSON() {

    // Load the file
    $JSONfile = 'data/dataBasket.json';
    $data = file_get_contents($JSONfile);

    // DECODE JSON flow
    $obj = json_decode($data);
    $nb_article = count($obj);

    for ($i = 0; $i < $nb_article; $i++) {
        $id_user[$i] = $obj[$i]->username;
        $id_article[$i] = $obj[$i]->id_article;
        $number[$i] = $obj[$i]->number;
        $flag[$i] = false;
    }
    for ($i = 0; $i < $nb_article; $i++) {

        // Load the file
        $JSONfile = 'data/dataPurchases.json';
        $contents = file_get_contents($JSONfile);

        // Decode the JSON data into a PHP array.
        $json = json_decode($contents, true);

        // Write in JSON
        if ($_SESSION['id_user'] == $id_user[$i]) {
            $json[] = array("username" => $id_user[$i], "id_article" => $id_article[$i], "number" => $number[$i], "flag" => $flag[$i]);

            // Encode the array back into a JSON string.
            $encode = json_encode($json, JSON_PRETTY_PRINT);

            // Save the file.
            file_put_contents('data/dataPurchases.json', $encode);

            // Load the file
            $data = file_get_contents('data/dataBasket.json');

            // Decode JSON flow
            $obj = json_decode($data);
            array_splice($obj, $i);
            $json = json_encode($obj, JSON_PRETTY_PRINT);
            file_put_contents('data/dataBasket.json', $json);
        }
    }
    header("Location:index.php?action=purchase_articles");
    exit();
}

/*
 * RemoveArrayInJSON Function
 * Do: remove a line in a json file
 *
*/
function RemoveArrayInJSON($id, $path) {

    // Load the file
    $data = file_get_contents($path);

    // Decode JSON flow
    $obj = json_decode($data);
    array_splice($obj, $id, 1);
    $json = json_encode($obj, JSON_PRETTY_PRINT);
    file_put_contents($path, $json);
}

/*
 * RemoveImgInJSONFunction
 * Do: remove an image in the articles directory
 *
*/
function RemoveImgInJSON($id) {

    // Load the file
    $JSONfile = 'data/dataArticles.json';

    $data = file_get_contents($JSONfile);

    // Decode JSON flow
    $obj = json_decode($data);
    $filename = $obj[$id]->image;
    unlink("media/img/articles/".$filename);
}

/*
 * HistoricModel Function
 * Do: create the users historic
 *
*/
function HistoricModel() {

    // Load the file
    $JSONfile = 'data/dataPurchases.json';
    $data = file_get_contents($JSONfile);

    // DECODE JSON flow
    $obj = json_decode($data);
    $nb_article = count($obj);

    for ($i = 0; $i < $nb_article; $i++) {
        $msg[$i] = "L'utilisateur {".$obj[$i]->username. "} a acheté l'article numéro ".$obj[$i]->id_article. ", ". $obj[$i]->number. " fois";
    }
    require "views/historic.php";
}

/*
 * DisplayBasket Function
 * Do: load the basket for basket page
 *
*/
function DisplayBasket() {

    // Load the file
    $JSONfile = 'data/dataBasket.json';
    $data = file_get_contents($JSONfile);

    // DECODE JSON flow
    $obj = json_decode($data);
    $nb_article = count($obj);
    $tab = 0;
    $isArticle = false;

    // access the appropriate element
    for ($i = 0; $i < $nb_article; $i++) {

        // Load the file
        $JSONfile = 'data/dataBasket.json';
        $data = file_get_contents($JSONfile);

        // DECODE JSON flow
        $obj = json_decode($data);

        if ($obj[$i]->username == $_SESSION['id_user']) {
            $id[$i] = $obj[$i]->id_article;
            $number[$tab] = $obj[$i]->number;

            // Load the file
            $JSONfile = 'data/dataArticles.json';
            $data = file_get_contents($JSONfile);

            // DECODE JSON flow
            $obj = json_decode($data);

            // access the appropriate element
            $img_article[$tab] = $obj[$id[$i]]->imagepath;
            $name_article[$tab] = $obj[$id[$i]]->article;
            $mark_article[$tab] = $obj[$id[$i]]->mark;
            $desc_article[$tab] = $obj[$id[$i]]->description;
            $price_article[$tab] = $obj[$id[$i]]->price;
            $stock_article[$tab] = $obj[$id[$i]]->stock;

            $tab++;

            if (!$isArticle) $isArticle = true;
        }
    }
    require "views/basket.php";
}

/*
 * DisplayPurchase Function
 * Do: load the purchased articles for purchase page
 *
*/
function DisplayPurchase() {

    // Load the file
    $JSONfile = 'data/dataPurchases.json';
    $data = file_get_contents($JSONfile);

    // DECODE JSON flow
    $obj = json_decode($data);
    $nb_purchase = count($obj);
    $tab = 0;

    $id_user = $_SESSION['id_user'];

    for ($i = 0; $i < $nb_purchase; $i++) {

        // Load the file
        $JSONfile = 'data/dataPurchases.json';
        $data = file_get_contents($JSONfile);

        // Decode JSON flow
        $obj = json_decode($data);
        $flag[$tab] = $obj[$i]->flag;
        if ($obj[$i]->username == $id_user) {

            $id = $obj[$i]->id_article;
            $number[$tab] = $obj[$i]->number;

            // Load the file
            $JSONfile = 'data/dataArticles.json';
            $data = file_get_contents($JSONfile);

            // DECODE JSON flow
            $obj = json_decode($data);

            // access the appropriate element
            $imgpath_article[$tab] = $obj[$id]->imagepath;
            $name_article[$tab] = $obj[$id]->article;
            $mark_article[$tab] = $obj[$id]->mark;
            $desc_article[$tab] = $obj[$id]->description;
            $price_article[$tab] = $obj[$id]->price;
            $stock_article[$tab] = $obj[$id]->stock;

            $tab++;
        }
    }
    require "views/purchase.php";
}

/*
 * FlagPurchase Function
 * Do: Modify the column flag of dataPurchases to false to true when the user leaves the purchase page
 *
*/
function FlagPurchase()
{

    // Load the file
    $JSONfile = 'data/dataPurchases.json';
    $data = file_get_contents($JSONfile);

    // Decode JSON flow
    $obj = json_decode($data);
    $nb_purchase = count($obj);
    $id_user = $_SESSION['id_user'];

    for ($i = 0; $i < $nb_purchase; $i++) {
        if ($obj[$i]->username == $id_user) {
            $obj[$i]->flag = true;
        }
    }
    // Encode the array back into a JSON string.
    $json = json_encode($obj, JSON_PRETTY_PRINT);

    // Save the file.
    file_put_contents('data/dataPurchases.json', $json);
}
