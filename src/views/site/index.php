<?php
/**
 * Created by Romain Lenoir.
 * Date: 12.03.2023
 * Desc: main page for displays slider and welcome the user.
 */

// tampon de flux stocké en mémoire
$title="IShoes - main page";
?>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<div class="topnav">
        <a href="<?=route('users/login/')?>"><img src="/images/login.png" height="50"><br>login</a>
        <a href="<?=route('articles/basket/')?>"><img src="/images/basket.png" height="50"><br>Basket</a>
        <a href="<?=route('articles/home/')?>" id="logo"><img src="/images/logo.png" height="90"></a>
    </div>
        <br><br>
        <div class="w3-container w3-center w3-animate-zoom">
            <div class="slideshow-container">

                <div class="mySlides fadeSlide">
                    <div class="numbertext">1 / 3</div>
                    <img src="/images/articles/Air%20Jordan%20Dior.png" style="width:100%" height="700">
                </div>

                <div class="mySlides fadeSlide">
                    <div class="numbertext">2 / 3</div>
                    <img src="/images/articles/Air%20jordan%204%20off%20white.png" style="width:100%" height="700">
                </div>

                <div class="mySlides fadeSlide">
                    <div class="numbertext">3 / 3</div>
                    <img src="/images/articles/Air%20Jordan%20REtro%20High%20TravisScott%20CactusJack.png" style="width:100%" height="700">
                </div>

                <h1 class="prev" onclick="plusSlides(-1)">❮</h1>
                <h1 class="next" onclick="plusSlides(1)">❯</h1>
            </div>
            <br>

            <div style="text-align:center">
                <span class="dot" onclick="currentSlide(1)"></span>
                <span class="dot" onclick="currentSlide(2)"></span>
                <span class="dot" onclick="currentSlide(3)"></span>
            </div>
        </div>
    <script src="/js/slider.js">
    </script>