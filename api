<?php
    // -*- mode: php; indent-tabs-mode: nil; tab-width: 4 -*-
    require_once('includes/api-methods.php');
    require_once('config.php');
//require_once('../db.php');
//require_once('../models/apierror.php');
//require_once('localization-methods.php');
//header('Content-type:application/json;charset=utf-8');

global $config;

$request = explode("/", substr(@$_SERVER['PATH_INFO'], 1));
//TODO: Standardize things like version code
//Suggested major/minor codes to limit functionality
//i.e. some feature only released in version 2.1

//echo json_encode($request);

//Structure is as such:
/*
    $request[0] = serverVersion
    $request[1] = serverType (localization, etc)
    $request[2] = serverMethod ()
    $request[3-x] = Data for the given server to process
*/
if(count($request) == 0)
{
    http_response_code(404);
}
else if(count($request) < 3)
{
    http_response_code(404);
}
else
{
    switch($request[1])
    {
        case "localization":
            switch($request[2])
            {
                case "locales":
                    $url = $config["apiBaseUrl"]."/includes/localization/locales.php";
                    for($i = 3; $i < count($request); $i++)
                    {
                        $url.="/".$request[$i];
                    }
                    $file = @file_get_contents($url, false, $context);
                    echo $file;
                break;
                default:
                    http_response_code(404);
                break;
            }

            
            break;
        default:
            http_response_code(404);
        break;
    }
}


?>