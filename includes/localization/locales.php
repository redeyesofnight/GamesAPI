<?php
    /*
        Example Usage:
        /api/v1/locales
            -GET: Returns list of locales and count of all keys associated with each
            -POST: Creates a new locale collection. Require Parameter value
        /api/v1/locales/en
            -GET: Return locale and keycount in collection en
            -DELETE: Deletes all keys for locale en (TODO: Restrict with security eventually
            -PUT: Creates locale for en
        TODO:
        /api/v1/locales/en/keyCode
            -GET: Return keycode and value for given key and locale
            -DELETE: Delete key for keyCode
            -PUT: Creates a new key for the given locale. Require parameter value
    */

    $request = explode("/", substr(@$_SERVER['PATH_INFO'], 1));
    $method = $_SERVER['REQUEST_METHOD'];

    echo "locales.php";

    //TODO: Check for malformed data

    require_once('../db.php');
    require_once('../models/apierror.php');
    require_once('localization-methods.php');
    header('Content-type:application/json;charset=utf-8');

    $request = explode("/", substr(@$_SERVER['PATH_INFO'], 1));
    $method = $_SERVER['REQUEST_METHOD'];


    
    echo "<br />HERE<br />";
    echo json_encode($request)."<br />";
    echo $method."<br />";
?>