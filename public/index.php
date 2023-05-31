<?php /*
session_start();
require "src/controllers/navigation.php";
require "src/controllers/admin.php";
require "src/controllers/articles.php";
require "src/controllers/basket.php";
require "src/controllers/login.php";
require "src/controllers/purchases.php";
require "src/controllers/users.php";

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
        if ((isset($_SESSION['logged'])) && $_SESSION['logged']) HomePage();
        else DefaultPage();
    }
} */
session_start();

define('BASE_DIR', dirname( __FILE__ ).'/..');
define('SOURCE_DIR', BASE_DIR.'/src');

//require "../src/auth.php";
//=============================================================================
// Create the BAG which will contain the request/response meta data

$bag = [];

//=============================================================================
// Extract the route from a friendly URL

$route = $_SERVER["REQUEST_URI"];
if (!empty($_SERVER["QUERY_STRING"])) {
    $route = substr($route, 0, strlen($_SERVER["REQUEST_URI"])-strlen($_SERVER["QUERY_STRING"])-1);
}

$bag['route'] = $route;
$bag['method'] = $_SERVER['REQUEST_METHOD'];

error_log("ooless:index: ".$bag['method']." ".$bag['route']);

//=============================================================================
// Dispatch the request

require SOURCE_DIR.'/dispatcher.php';
$bag = dispatch($bag);

//=============================================================================
// Call the handler

require SOURCE_DIR.'/handler.php';
$bag = handle($bag);

//=============================================================================
// Render the response

require SOURCE_DIR.'/renderer.php';
render($bag);