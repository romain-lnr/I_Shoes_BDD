<?php
/*
 * HistoricModel Function
 * Do: create the users historic
 *
*/
function HistoricModel($i) {

    // Load the file
    $JSONfile = 'data/dataPurchases.json';
    $data = file_get_contents($JSONfile);

    // DECODE JSON flow
    $obj = json_decode($data);
    $nb_article = count($obj);

    if ($i != $nb_article) {
        return "L'utilisateur {".$obj[$i]->username. "} a acheté l'article numéro ".$obj[$i]->id_article. ", ". $obj[$i]->number. " fois";
    }
    return null;
}