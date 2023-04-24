<?php
/*
 * Default_page function
 * Do: redirect to main page
 *
*/
function Default_page() {
    require "views/main.php";
}

/*
 * Home_page function
 * Do: load articles for home page
 *
*/
function Home_page() {
    require "models/model.php";
    DisplayArticles('home');
}

/*
 * Purchases function
 * Do: load purchased articles
 *
*/
function Purchase() {
    require "models/model.php";
    DisplayPurchase();
}

/*
 * Admin_page function
 * Do: load articles for admin page
 *
*/
function Admin_page() {
    require "models/model.php";
    DisplayArticles('admin');
}

/*
 * Historic Function
 * Do: load user historic
 *
*/
function Historic() {
    require "models/model.php";
    HistoricModel();
}

/*
 * Add_purchase Function
 * Do: write in purchase json file
 *
*/
function Add_purchase() {
    require "models/model.php";
    AddPurchaseToJSON();
}

/*
 * Login Function
 * Do: redirect to login page
 *
*/
function Login() {
    require "views/login.php";
}

/*
 * Register Function
 * Do: redirect to new_user page
 *
*/
function Register() {
    require "views/new_user.php";
}

/*
 * Check_login Function
 * Do: Check the logged user
 *
*/
function Check_login() {
    require "models/model.php";
        if(isset($_POST['insert'])) {

        // Retrieves values
        $id_user = $_POST['id_user'];
        $password = $_POST['password'];
        }
    Test_login($id_user, $password);
}

/*
 * Account Function
 * Do: Create a new account
 *
*/
function Account() {
    require "models/model.php";

    if(isset($_POST['insert'])) {

        // Retrieves values
        $id_user = $_POST['id_user'];
        $prenom = $_POST['prenom'];
        $nom = $_POST['nom'];
        $email = $_POST['email'];
        $password = $_POST['password'];
    }
    Insert_user($id_user, $prenom, $nom, $email, $password);
}

/*
 * New_article Function
 * Do: Create a new article
 *
*/
function New_article() {
    require "models/model.php";

    if(isset($_POST['insert'])) {

        // Retrieves values
        $id_article = $_POST['id_article'];
        $mark = $_POST['mark'];
        $desc = $_POST['desc'];
        $price = $_POST['price'];
        $stock_number = 0;

        if(is_array($_FILES)) {
            $file = $_FILES['img_article']['tmp_name'];
            $sourceProperties = getimagesize($file);
            $fileNewName = $id_article;
            $folderPath = "../media/img/articles/";
            $ext = pathinfo($_FILES['img_article']['name'], PATHINFO_EXTENSION);
            $imageType = $sourceProperties[2];
        }
        switch ($imageType) {
            case IMAGETYPE_PNG:
                // It's OK
                break;
            case IMAGETYPE_GIF:
                // It's OK
                break;
            case IMAGETYPE_JPEG:
                // It's OK
                break;
            default:
                header("Location:index.php?error=ext_article");
                return;
        }
        $imagepath=$folderPath.$fileNewName.".".$ext;
        $filename = $fileNewName.".".$ext;
        move_uploaded_file($file, './media/img/articles/'. $filename);
    }
    Add_article($id_article, $mark, $desc, $price, $stock_number, $imagepath, $filename);
    header("Location:index.php?action=admin");
    exit();
}

/*
 * Create_article Function
 * Do: redirect to the TDC_admin page
 *
*/
function Create_article() {
    require "views/TDC_admin.php";
}

/*
 * Update_articles Function
 * Do: update articles
 *
*/
function Update_articles() {
    if(isset($_POST['insert'])) {
        require "models/model.php";
        DisplayArticles('update_articles');
    }
}

/*
 * Show Function
 * Do: display the requested article to the user
 *
*/
function Show($id) {
    require "models/model.php";
    Show_article($id);
}

/*
 * Basket Function
 * Do: load basket for basket page
 *
*/
function Basket() {
    require "models/model.php";
    DisplayBasket();
}

/*
 * Add Function
 * Do: update the basket json file by the requested article by user
 *
*/
function Add($id, $value) {
    if (isset($_SESSION['id_user']) && $_SESSION['id_user']) {
        $id_user = $_SESSION['id_user'];
    }
    else {
        header("Location:index.php?error=not_login");
        return;
    }
    require "models/model.php";
    Add_basket($id_user, $id, $value);
}

/*
 * Remove_basket Function
 * Do: remove an article and affect values in basket if the user deletes him
 *
*/
function Remove_basket($id, $number, $id_article) {
    require "models/model.php";
    AffectValueInArray($id_article, $number);
    RemoveArrayInJSON($id, 'data/dataBasket.json');
    header("Location:index.php?action=basket");
    exit();
}

/*
 * Remove_article Function
 * Do: remove an article and images if the admin deletes him
 *
*/
function Remove_article($id) {
    require "models/model.php";
    RemoveImgInJSON($id);
    RemoveArrayInJSON($id, 'data/dataArticles.json');
    header("Location:index.php?action=admin");
    exit();
}

/*
 * Flag Function
 * Do: reorganize the purchase confirmation page
 *
*/
function Flag() {
    require "models/model.php";
    FlagPurchase();
    header("Location:index.php?action=home");
    exit();
}

/*
 * Lost_page Function
 * Do: redirect to the lost page
 *
*/
function Lost_page() {
    require "views/lost.php";
}

/*
 * Logout Function
 * Do: destroy sessions variable and log out the user
 *
*/
function Logout() {
    $_SESSION['logged'] = false;
    session_destroy();
    header("Location:index.php");
    exit();
}

