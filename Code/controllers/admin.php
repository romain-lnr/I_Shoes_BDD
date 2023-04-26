<?php
/*
 * Admin_page function
 * Do: load articles for admin page
 *
*/
function AdminPage() {
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

