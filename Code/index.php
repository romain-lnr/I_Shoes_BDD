<?php
session_start();
require "controllers/navigation.php";
require "controllers/admin.php";
require "controllers/articles.php";
require "controllers/basket.php";
require "controllers/login.php";
require "controllers/purchases.php";
require "controllers/users.php";

// Actions
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    switch ($action) {
        case 'home' :
            HomePage();
            break;
        case 'login' :
            Login();
            break;
        case 'register' :
            Register();
            break;
        case 'logged' :
            CheckLogin();
            break;
        case 'admin' :
            AdminPage();
            break;
        case 'TDC' :
            CreateArticle();
            break;
        case 'purchase' :
            AddPurchase();
            break;
        case 'historic' :
            Historic();
            break;
        case 'logout' :
            Logout();
            break;
        case 'insert_user' :
            Account();
            break;
        case 'create_article' :
            NewArticle();
            break;
        case 'update_articles' :
            UpdateArticles();
            break;
        case 'basket' :
            Basket();
            break;
        case 'purchase_articles' :
            Purchase();
            break;
        case 'flag_refresh' :
            Flag();
            break;
        default :
            LostPage();
    }
}
else {
    if (isset($_GET['error'])) {
        $error = $_GET['error'];

        switch ($error) {
            case 'ext_article':
                require "views/TDC_admin.php";
                break;
            case 'not_even_stock':
                HomePage();
                break;
            case 'not_login':
                require "views/login.php";
                break;
            case 'user_not_correct':
                require "views/login.php";
                break;
            case 'password_not_correct':
                require "views/login.php";
                break;
            case 'user_not_unique':
                require "views/new_user.php";
                break;
        }
    }
    else if (isset($_GET['receive_home'])) {
        $id = $_GET['receive_home'];
        Show($id);
    }
    else if (isset($_GET['receive_basket'])) {
        $id = $_GET['receive_basket'];
        $number = $_GET['value'];
        $id_article = $_GET['id_article'];
        RemoveBasket($id, $number, $id_article);
    }
    else if (isset($_GET['receive_admin'])) {
        $id = $_GET['receive_admin'];
        RemoveArticle($id);
    }
    else if (isset($_GET['receive_show_article'])) {
        $id = $_GET['receive_show_article'];
        $value = $_POST['value'];
        Add($id, $value);
    } else {
        if ((isset($_SESSION['logged'])) && $_SESSION['logged']) Home_page();
        else DefaultPage();
    }
}