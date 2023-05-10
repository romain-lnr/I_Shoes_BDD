<?php
//=============================================================================
// Handler script for ooless web apps.
// Author:  Pascal Hurni
// Date:    2022-08-27, 03-05-2014
//=============================================================================

require SOURCE_DIR.'/auth.php';

function handle($bag)
{
    // Short circuit if status_code already defined
    if (array_key_exists('status_code', $bag)) return $bag;

    // Pass the request to the auth layer
    $bag = authorize($bag);

    // Once again, short circuit if status_code defined by the auth layer
    if (array_key_exists('status_code', $bag)) return $bag;

    // Handle only if desired
    if (array_key_exists('handler', $bag)) {
        error_log("ooless:handle: ".$bag['handler']);

        // Process the handler
        $new_bag = include SOURCE_DIR.'/'.$bag['handler'].'.php';

        // Be gentle with handlers, if they forget to return the bag, return the original bag
        if (is_array($new_bag)) {
            $bag = $new_bag;
        }
    }

    return $bag;
}
