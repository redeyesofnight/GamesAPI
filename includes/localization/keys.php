<?php
    /*
        Example Usage:
        /api/v1/keys
            -GET: Return all keys from whole db (maybe not allowed? Maybe eventually allowed with security level?)
            -POST: Creates a new locale collection. Require parameter value
        /api/v1/keys/en
            -GET: Return all keys from locale en
            -PUT: Create locale collection for locale en
        /api/v1/keys/en/keyCode
            -GET: Dumps Key/Value pair info for the given keycode in collection en
            -PUT: Creates or updates keyCode. Require Parameter value
            -DELETE: Deletes keyCode
    */

    //TODO: Add /api/vx/keys with security level
    //TODO: Check for malformed data

    $request = explode("/", substr(@$_SERVER['PATH_INFO'], 1));

    if(count($request) > 2)
    {
        http_response_code(404);
    }
    else if(count($request) == 2)
    {
        /*
            /api/v1/keys/en/keyCode
            -GET: Dumps Key/Value pair info for the given keycode in collection en
            -PUT: Creates or updates keyCode. Require Parameter value
            -DELETE: Deletes keyCode
        */
    }
    else if(count($request) == 1)
    {
        /*
            /api/v1/keys/en
                -GET: Return all keys from locale en
        */
    }
    else
    {
        /*
            Disabled for now, as we don't want to allow exporting whole database until security is in place
        */
        http_response_code(404);
    }



    if(count($request) > 0)
    {
        $locale = $request[0];
    }

    if(count($request) > 1)
    {
        $keyCode = $request[1];
    }

?>