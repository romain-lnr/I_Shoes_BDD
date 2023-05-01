<?php
/*
 * NewArticle Function
 * Do: Create a new article
 *
*/
function NewArticle()
{
    require "models/articles.php";

    if (isset($_POST['insert'])) {

        // Retrieves values
        $id_article = $_POST['id_article'];
        $mark = $_POST['mark'];
        $desc = $_POST['desc'];
        $price = $_POST['price'];
        $stock_number = 0;

        if (is_array($_FILES)) {
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
        $imagepath = $folderPath . $fileNewName . "." . $ext;
        $filename = $fileNewName . "." . $ext;
        move_uploaded_file($file, './media/img/articles/' . $filename);
    }
    AddArticle($id_article, $mark, $desc, $price, $stock_number, $imagepath, $filename);
    header("Location:index.php?action=admin");
    exit();
}

/*
 * CreateArticle Function
 * Do: redirect to the TDC_admin page
 *
*/
function CreateArticle() {
    require "views/TDC_admin.php";
}

/*
 * Show Function
 * Do: display the requested article to the user
 *
*/
function Show($id) {
    require "models/articles.php";
    $article_specs[0] = ShowArticle($id);
    require "views/show_article.php";
}

/*
 * UpdateArticles Function
 * Do: update articles
 *
*/
function UpdateArticles() {
    if(isset($_POST['insert'])) {
        require "models/articles.php";
        UpArticles();
    }
    header("Location:index.php?action=home");
}

/*
 * RemoveArticle Function
 * Do: remove an article and images if the admin deletes him
 *
*/
function RemoveArticle($id) {
    require "models/articles.php";
    RemoveImgInJSON($id);
    RemoveArrayInJSON($id, 'data/dataArticles.json');
    header("Location:index.php?action=admin");
}

