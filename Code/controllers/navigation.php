<?php
/*
 * Default_page function
 * Do: redirect to main page
 *
*/
function DefaultPage() {
    require "views/main.php";
}

/*
 * Home_page function
 * Do: load articles for home page
 *
*/
function HomePage() {
    require "models/articles.php";
    DisplayArticles('home');
}

