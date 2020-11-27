<?php
    // -*- mode: php; indent-tabs-mode: nil; tab-width: 4 -*-
    require_once('../../db.php');
    require_once('../models/apierror.php');
    require_once('localization-methods.php');
    header('Content-type:application/json;charset=utf-8');

    /*
    Example Usage:
    /api/locales
        -GET: Returns list of locales and count of all keys associated with each
        -POST: Creates a new locale collection. Require Parameter value
    /api/locales/en
        -GET: Return locale and keycount in collection en
        -DELETE: Deletes all keys for locale en (TODO: Restrict with security eventually
        -PUT: Creates locale for en
    */

    $request = explode("/", substr(@$_SERVER['PATH_INFO'], 1));
    if(count($request) > 0)
    {
        $selectedLocale = $request[0];
    }
    if(count($request) > 1)
    {
        $keyInLocale = $request[1];
    }

    switch($_SERVER['REQUEST_METHOD'])
    {
        case 'GET':
            if(!isset($selectedLocale) || $selectedLocale == "")
            {
                //Return all locales
                $locales = GetLocales();
                echo json_encode($locales);
                http_response_code(200);
            }
            else
            {
                //Return selected locale
                $singleLocale = GetSingleLocale($selectedLocale);
                if(!isset($singleLocale))
                {
                    $err = new APIError("LocaleDoesNotExist", "The given locale '$selectedLocale' doesn't exist.");
                    echo json_encode($err);
                    http_response_code(404);
                }
                else
                {
                    echo json_encode($singleLocale);
                    http_response_code(200);
                }
            }
        break;
        case 'PUT':
            //Don't put to a collection
            if(!isset($singleLocale))
            {
                http_response_code(400);
                $err = new APIError("NoLocaleGiven", "Tried to post new locale record, but none was given.");
                echo json_encode($err);
            }
            else
            {
                AddLocale($singleLocale);
                $locale = GetSingleLocale($singleLocale);
                if(isset($locale))
                {
                    http_response_code(201);
                    echo json_encode($locale);
                }
                else
                {
                    http_response_code(500);
                    $err = new APIError("CouldNotCreateLocale", "Could not create the requested locale: '$singleLocale'.");
                    echo json_encode($err);
                }
            }
        break;
        case 'POST':
            if(isset($_REQUEST['newLocaleCode']))
            {
                $localeExists = DoesLocaleExist($_REQUEST['newLocaleCode']);
                if($localeExists == 0)
                {
                    //Locale does not yet exist, so we can create it.
                    $response = AddLocale($_REQUEST['newLocaleCode']);
                    $locale = GetSingleLocale($_REQUEST['newLocaleCode']);
                    if($response == 1)
                    {
                        echo json_encode($locale);
                        http_response_code(201);
                    }
                    else
                    {
                        $err = new APIError("CouldNotCreateLocale", "Could not create the requested locale: '$selectedLocale'.");
                        echo json_encode($err);
                        http_response_code(500);
                    }
                }
                else
                {
                    //Locale Exists, cannot create locale
                    http_response_code(400);
                    $err = new APIError("LocaleExists", "Could not post new locale '$selectedLocale' as it already exists.");
                    echo json_encode($err);
                }
            }
            else
            {
                http_response_code(400);
                $err = new APIError("MissingNewLocale", "Missing required parameter 'newLocaleCode'. Creation of anonymous locales is not supported.");
                echo json_encode($err);
            }
        break;
        case 'DELETE':
            if(!isset($selectedLocale))
            {
                //Error
                http_response_code(405);
                $err = new APIError("CannotDeleteCollection", "Please don't try to delete all locales.");
                echo json_encode($err);
            }
            else
            {
                $localeExists = DoesLocaleExist($selectedLocale);
                if($localeExists == 0)
                {
                    http_response_code(404);
                    $err = new APIError("LocaleDoesNotExist", "The given locale '$selectedLocale' doesn't exist.");
                    echo json_encode($err);
                }
                else
                {
                    DeleteLocale($selectedLocale);
                    http_response_code(204);
                }
            }
        break;
    }

?>