<?php
/*
 * Admin_page function
 * Do: load articles for admin page
 *
*/
function AdminPage() {
    require "models/articles.php";
    DisplayArticles('admin');
}

/*
 * Historic Function
 * Do: load user historic
 *
*/
function Historic() {
    require "models/admin.php";
    $i = -1;
    do {
        $i++;
        $msg[$i] = HistoricModel($i);
    } while ($msg[$i] != null);
    require "views/historic.php";
}

