<?php
// -*- mode: php; indent-tabs-mode: nil; tab-width: 4 -*-=
    include_once("includes/api-methods.php");

    //On some systems, the proper variable will be set in $_SERVER
    if(isset($_SERVER["apiBaseURL"]))
    {
        $_ENV["apiBaseURL"] = $_SERVER["apiBaseURL"];
    }

    if(!isset($_ENV["apiBaseURL"]))
    {
        die("Error: Missing Environment variable apiBaseURL");
    }

    $apiURL = $_ENV["apiBaseURL"] . "/api/v1";
    $localeURL = $apiURL . "/localization/locales";

    function AssertEquals($message, $actual, $expected)
    {
        if($expected == $actual)
        {
            echo "<b style='color:green;'>Pass. $message: Actual $actual expected $expected</b><br />";
        }
        else
        {
            echo "<b style='color:red;'>Fail. $message: Actual $actual expected $expected</b><br />";
        }
    }


    //------------------
    //Localization Tests
    //------------------
    
    //Test 1: Get All Locales
    echo "<b>1. Locale GET All</b><br />";
    $context = stream_context_create([
        "http" => [
            "method" => "GET"
        ]
    ]);
    echo $localeURL."<br />";
    $response = FileGetContentResponse($localeURL);
    echo "Response Content: $response->content<br />";
    AssertEquals("Response Code", $response->code, 200);
    echo "<br />";

    //Test 2: Get One Locale
    echo "<b>2. Locale GET One</b><br />";
    $url = $localeURL."/en";
    echo $url."<br />";
    $response = FileGetContentResponse($url);
    echo "Response Content: $response->content<br />";
    AssertEquals("Response Code", $response->code, 200);
    echo "<br />";

    //Test 3: GET one missing
    echo "<b>3. Locale GET One Missing</b><br >";
    $url = $localeURL."/missing";
    //$url = $_ENV["apiBaseURL"]."/TRC.php";
    echo $url."<br />";
    $response = FileGetContentResponse($url);
    echo "Response Content: $response->content<br />";
    AssertEquals("Response Code", $response->code, 404);
    echo "<br />";

    //Test 4: POST Add One
    /*echo "<b>4. Locale Add one (POST)</b><br />";
    $context = stream_context_create([
        "http" => [
            "method" => "POST"
        ]
    ]);
    $url = $localeURL."?newLocaleCode=missing";;
    echo $url."<br />";
    $file = @file_get_contents($url, false, $context);
    echo "Response: ".$file."<br />";
    $parsedCode = http_response_code();
    echo "Response Code: $parsedCode<br />";
    echo "Expected Code: 201<br /><br />";

    //Test 5: Delete One Locale
    echo "<b>4. Locale Delete One (DELETE)</b><br />";
    $context = stream_context_create([
        "http" => [
            "method" => "DELETE"
        ]
    ]);

    $url = $localeURL."/missing";
    echo $url."<br />";
    $file = @file_get_contents($url, false, $context);
    echo "Response: ".$file."<br />";
    $parsedCode = http_response_code();
    echo "Response Code: $parsedCode<br />";
    echo "Expected Code: 204<br /><br />";

    */ 


?>