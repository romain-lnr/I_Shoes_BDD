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
    else if (preg_match('/^\/users\/login\/$/', $bag['route'])) {
        $bag['view'] = 'views/site/users/login';
        $bag['layout'] = 'views/layout_form';
    }
    else if (preg_match('/^\/articles\/home\/$/', $bag['route'])) {
        $bag['handler'] = 'controllers/site/articles/showArticles';
    }
    else if (preg_match('/^\/users\/logged\/$/', $bag['route'])) {
        $bag['handler'] = 'controllers/site/users/login_check';
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
