<?php
//=============================================================================
// Dispatcher script for ooless web apps.
// Author:  Pascal Hurni
// Date:    2022-08-27, 03-05-2014
//=============================================================================

//=============================================================================
// Decode the given route and return the bag augmented with:
//    handler        string  PHP file name that should handle this request (without php extension).
//    status_code    int     HTTP code to return if already determined.
function dispatch($bag)
{
    $matches = [];

    if (preg_match('/^\/$/', $bag['route'])) {

        if (!isset($_SESSION['logged']) || !$_SESSION['logged']) {
            $bag['view'] = 'views/site/index';
        } else {
            $bag['handler'] = 'controllers/articles/home';
        }
        $bag['layout'] = 'views/layout';
    }
    else if (preg_match('/^\/articles\/home\/$/', $bag['route'])) {
        $bag['handler'] = 'controllers/articles/home';
        $bag['layout'] = 'views/layout';
    }
    else if (preg_match('/^\/articles\/admin\/$/', $bag['route'])) {
        $bag['handler'] = 'controllers/articles/admin';
        $bag['layout'] = 'views/layout';
    }
    else if (preg_match('/^\/articles\/delete\/(\d+)$/', $bag['route'], $matches)) {
        $bag['articleID'] = $matches[1];
        $bag['handler'] = 'controllers/articles/delete';
        $bag['layout'] = 'views/layout';
    }
    else if (preg_match('/^\/articles\/show\/(\d+)$/', $bag['route'], $matches)) {
        $bag['articleID'] = $matches[1];
        $bag['handler'] = 'controllers/articles/show';
        $bag['layout'] = 'views/layout';
    }
    else if (preg_match('/^\/articles\/create_basket\/(\d+)$/', $bag['route'], $matches)) {
        $bag['articleID'] = $matches[1];
        $bag['handler'] = 'controllers/basket/create_in_basket';
        $bag['layout'] = 'views/layout';
    }
    else if (preg_match('/^\/articles\/stock_review\/$/', $bag['route'])) {
        $bag['handler'] = 'controllers/articles/review';
        $bag['layout'] = 'views/layout';
    }
    else if (preg_match('/^\/articles\/create_article\/$/', $bag['route'])) {
        $bag['handler'] = 'controllers/articles/create';
        $bag['layout'] = 'views/layout';
    }
    else if (preg_match('/^\/articles\/basket\/$/', $bag['route'])) {
        $bag['handler'] = 'controllers/basket/display';
        $bag['layout'] = 'views/layout';
    }
    else if (preg_match('/^\/users\/login\/$/', $bag['route'])) {
        $bag['view'] = 'views/site/login';
        $bag['layout'] = 'views/layout_form';
    }
    else if (preg_match('/^\/users\/logged\/$/', $bag['route'])) {
        $bag['handler'] = 'controllers/users/login_check';
    }
    else if (preg_match('/^\/users\/TDC\/$/', $bag['route'])) {
        $bag['view'] = 'views/site/TDC_admin';
        $bag['layout'] = 'views/layout_form';
    }
    else if (preg_match('/^\/users\/register\/$/', $bag['route'])) {
        $bag['view'] = 'views/site/new_user';
        $bag['layout'] = 'views/layout_form';
    }
    else if (preg_match('/^\/users\/insert_user\/$/', $bag['route'])) {
        $bag['handler'] = 'controllers/users/insert_user';
        $bag['layout'] = 'views/layout_form';
    }

    return $bag;
}

//=============================================================================
// Return the URL for the given named route (the opposite of the dispatcher)
function route($name) {
    return '/'.$name;
}
