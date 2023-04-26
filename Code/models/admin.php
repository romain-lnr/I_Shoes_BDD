<?php
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