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
    $i = -1;
    do {
        $i++;
        $article_specs[$i] = DisplayArticles($i);
    } while ($article_specs[$i] != null);
    require "views/home.php";
}

