<?php
$_SESSION['logged'] = false;
session_destroy();
$bag['view'] = "views/site/index";
return $bag;