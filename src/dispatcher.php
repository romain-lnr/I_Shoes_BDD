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
        $bag['view'] = 'views/site/index';
        $bag['layout'] = 'views/layout';
    }
    else if (preg_match('/^\/users\/home\/$/', $bag['route'])) {
        $bag['handler'] = 'controllers/home/articles';
        $bag['layout'] = 'views/layout';
    }
    else if (preg_match('/^\/articles\/show\/$/', $bag['route'])) {
        $bag['handler'] = 'controllers/articles/show';
        $bag['layout'] = 'views/layout';
    }
    else if (preg_match('/^\/users\/login\/$/', $bag['route'])) {
        $bag['view'] = 'views/site/login';
        $bag['layout'] = 'views/layout_form';
    }
    else if (preg_match('/^\/users\/logged\/$/', $bag['route'])) {
        $bag['handler'] = 'controllers/users/login_check';
    }
    else if (preg_match('/^\/users\/register\/$/', $bag['route'])) {
        $bag['view'] = 'views/site/new_user';
        $bag['layout'] = 'views/layout_form';
    }
    else if (preg_match('/^\/users\/insert_user\/$/', $bag['route'])) {
        $bag['handler'] = 'controllers/users/insert_user';
        $bag['layout'] = 'views/layout_form';
    }
    else if (preg_match('/^\/users\/basket\/$/', $bag['route'])) {
        $bag['view'] = 'views/site/basket';
        $bag['layout'] = 'views/layout';
    }
    else if (preg_match('/^\/articles\/home\/$/', $bag['route'])) {
        $bag['handler'] = 'controllers/site/articles/showArticles';
    }
    /* //-----------------------------------------------------------------------------
    elseif (preg_match('/^\/(login|register)$/', $bag['route'], $matches)) {
        if ($bag['method'] == 'POST') {
            $bag['handler'] = 'controllers/site/'.$matches[1];
        } elseif ($bag['method'] == 'GET') {
            $bag['view'] = 'views/site/'.$matches[1];
        }
    }
    //-----------------------------------------------------------------------------
    elseif (preg_match('/^\/logout$/', $bag['route']) && $bag['method'] == 'POST') {
        $bag['handler'] = 'controllers/site/logout';
    }
    //-----------------------------------------------------------------------------
    else if (preg_match('/^\/articles\/(\d+)$/', $bag['route'])) {
        $bag['handler'] = 'controllers/articles/show';
        $bag['articleId'] = $matches[1];
    }
    else {
        $bag['status_code'] = 404;
    } */

    return $bag;
}

//=============================================================================
// Return the URL for the given named route (the opposite of the dispatcher)
function route($name) {
    return '/'.$name;
}
