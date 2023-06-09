<?php
require SOURCE_DIR . "/models/site/articles.php";

if ($bag['method'] == 'POST') {

    $name = $_POST['name'];
    $mark = $_POST['mark'];
    $description = $_POST['desc'];
    $price = $_POST['price'];

    if (is_array($_FILES)) {
        $file = $_FILES['image']['tmp_name'];
        $sourceProperties = getimagesize($file);
        $fileNewName = $name;
        $folderPath = "../public/images/articles/"; // Chemin correct vers le dossier des images
        $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $imageType = $sourceProperties[2];
    }
    switch ($imageType) {
        case IMAGETYPE_PNG:
        case IMAGETYPE_GIF:
        case IMAGETYPE_JPEG:
            break;
        default:
            header("Location:index.php?error=ext_article");
            return;
    }
    $imagepath = $folderPath . $fileNewName . "." . $ext;
    $filename = $fileNewName . "." . $ext;
    move_uploaded_file($file, $folderPath . $filename); // Utilisation du chemin complet pour le déplacement du fichier

    $bag['data'] = Create($name, $mark, $description, $price, $filename);
}
header("Location: " . route("articles/admin/"));
return $bag;
