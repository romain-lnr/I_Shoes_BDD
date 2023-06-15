<?php
require_once SOURCE_DIR. '/models/site/articlesService.php';

if ($bag['method'] == 'POST') {

    $name = $_POST['name'];
    $mark = $_POST['mark'];
    $description = $_POST['desc'];
    $price = $_POST['price'];

    if (is_array($_FILES)) {
        $file = $_FILES['image']['tmp_name'];
        $sourceProperties = getimagesize($file);
        if (isset($sourceProperties[2])) {
            $fileNewName = $name;
            $folderPath = "../public/images/articles/"; // Chemin correct vers le dossier des images
            $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            $imageType = $sourceProperties[2];
        } else {
            $bag['data'] = array('error' => 'ImgNotGood');
            $bag['layout'] = 'views/layout_form';
            $bag['view'] = 'views/site/TDC_admin';
            return $bag;
        }
    }
    switch ($imageType) {
        case IMAGETYPE_PNG:
        case IMAGETYPE_GIF:
        case IMAGETYPE_JPEG:
            break;
        default:
            $bag['data'] = array('error' => 'ImgNotGood');
            $bag['layout'] = 'views/layout_form';
            $bag['view'] = 'views/site/TDC_admin';
            return $bag;
    }
    $imagepath = $folderPath . $fileNewName . "." . $ext;
    $filename = $fileNewName . "." . $ext;
    move_uploaded_file($file, $folderPath . $filename); // Utilisation du chemin complet pour le déplacement du fichier

    $bag['data'] = ['article' => Create($name, $mark, $description, $price, $filename)];
}
$bag['response_headers'] = ['Location' => '/articles/admin/'];
return $bag;
