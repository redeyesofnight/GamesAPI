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

    //TODO: Check for malformed data

    require_once('../db.php');
    require_once('../models/apierror.php');
    require_once('localization-methods.php');
    header('Content-type:application/json;charset=utf-8');

    $request = explode("/", substr(@$_SERVER['PATH_INFO'], 1));
    $method = $_SERVER['REQUEST_METHOD'];
    if(count($request) > 2)
    {
        http_response_code(404);
    }
    else if(count($request) == 2)
    {
        /*
            /api/v1/locales/en/keyCode
                -GET: Return keycode and value for given key and locale
                -DELETE: Delete key for keyCode
                -PUT: Creates a new key for the given locale. Require parameter value
        */

        $locale = $request[0];
        $keyCode = $request[1];

        switch($method)
        {
            case 'GET':
                //Return selected locale
                $singleLocale = GetSingleLocale($locale);
                if(!isset($singleLocale))
                {
                    http_response_code(404);
                }
                else
                {
                    //Ok, locale exists, does key exist?
                    $keyExist = DoesKeyExist($keyCode, $locale);
                    if($keyExist == 0)
                    {
                        //Key doesn't exist
                        http_response_code(404);
                    }
                    else
                    {
                        //Key exists
                        $keyTranslation = GetLocalizedKey($keyCode, $locale);
                        echo json_encode($keyTranslation);
                        http_response_code(200);
                    }
                }
            break;
            case 'DELETE':
                $singleLocale = GetSingleLocale($locale);
                if(!isset($singleLocale))
                {
                    http_response_code(404);
                }
                else
                {
                    $keyExist = DoesKeyExist($keyCode, $locale);
                    if($keyExist == 0)
                    {
                        http_response_code(404);
                    }
                    else
                    {
                        $result = DeleteKey($keyCode, $locale);
                        if($result == 1)
                        {
                            http_response_code(204);
                        }
                        else
                        {
                            http_response_code(500);
                        }
                    }
                }
            break;
            case 'PUT':
                if(!isset($_REQUEST['value']))
                {
                    http_response_code(400);
                    $err = new APIError("missingValue", "Request is missing required parameter 'value'");
                }
                $singleLocale = GetSingleLocale($locale);
                if(!isset($singleLocale))
                {
                    http_response_code(404);
                }
                else
                {
                    $result = AddKey($key, $_REQUEST['value'], $locale);
                    $keyTranslation = GetLocalizedKey($keyCode, $locale);
                    echo json_encode($keyTranslation);
                    http_response_code(200);
                }
            break;
            default:
                http_response_code(405);
            break;
        }
    }
    else if(count($request) == 1 && isset($request[0]) &&  $request[0] != "")
    {
        $locale = $request[0];
        /*
            /api/v1/locales/en
            -GET: Return locale and keycount in collection en
            -DELETE: Deletes all keys for locale en (TODO: Restrict with security eventually
            -PUT: Creates locale for en
        */
        switch($method)
        {
            case 'GET':
                //Return selected locale
                $singleLocale = GetSingleLocale($locale);
                if(!isset($singleLocale))
                {
                    $err = new APIError("LocaleDoesNotExist", "The given locale '$locale' doesn't exist.");
                    echo json_encode($err);
                    http_response_code(404);
                }
                else
                {
                    echo json_encode($singleLocale);
                    http_response_code(200);
                }
            break;
            case 'PUT':
                AddLocale($locale);
                $singleLocale = GetSingleLocale($locale);
                if(isset($singleLocale))
                {
                    http_response_code(201);
                    echo json_encode($singleLocale);
                }
                else
                {
                    http_response_code(500);
                    $err = new APIError("CouldNotCreateLocale", "Could not create the requested locale: '$locale'.");
                    echo json_encode($err);
                }
            break;
            case 'DELETE':
                $localeExists = DoesLocaleExist($locale);
                if($localeExists == 0)
                {
                    http_response_code(404);
                    $err = new APIError("LocaleDoesNotExist", "The given locale '$locale' doesn't exist.");
                    echo json_encode($err);
                }
                else
                {
                    DeleteLocale($locale);
                    http_response_code(204);
                }
            break;
        }
    }
    else
    {
        /*
            /api/v1/locales
            -GET: Returns list of locales and count of all keys associated with each
            -POST: Creates a new locale collection. Require Parameter value
        */
        switch($method)
        {
            case 'GET':
                //Return all locales
                $locales = GetLocales();
                echo json_encode($locales);
                http_response_code(200);
            break;
            case 'POST':
                if(isset($_REQUEST['value']))
                {
                    $newLocale = $_REQUEST['value'];
                    $localeExists = DoesLocaleExist($newLocale);
                    if($localeExists == 0)
                    {
                        //Locale does not yet exist, so we can create it.
                        $response = AddLocale($newLocale);
                        $addedLocale = GetSingleLocale($newLocale);
                        if($response == 1)
                        {
                            echo json_encode($addedLocale);
                            http_response_code(201);
                        }
                        else
                        {
                            $err = new APIError("CouldNotCreateLocale", "Could not create the requested locale: '$newLocale'.");
                            echo json_encode($err);
                            http_response_code(500);
                        }
                    }
                    else
                    {
                        //Locale Exists, cannot create locale
                        http_response_code(400);
                        $err = new APIError("LocaleExists", "Could not post new locale '$newLocale' as it already exists.");
                        echo json_encode($err);
                    }
                }
                else
                {
                    http_response_code(400);
                    $err = new APIError("MissingNewLocale", "Missing required parameter 'value'. Creation of anonymous locales is not supported.");
                    echo json_encode($err);
                }
            break;
            default:
                http_response_code(405);
            break;
        }
    }

?>