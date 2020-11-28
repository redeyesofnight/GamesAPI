<?php
echo "here";
// -*- mode: php; indent-tabs-mode: nil; tab-width: 4 -*-
    include_once('config.php');
    include_once('api-methods.php');
    global $config;

    $apiURL = $config["apiBaseUrl"] . "/v1.0";
    $localeURL = $apiURL . "/localization/locales";
    return;

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
    $file = @file_get_contents($localeURL, false, $context);
    echo "Response: ".$file."<br />";
    $parsedCode = LastResponseCode();
    echo "Response Code: $parsedCode<br />";
    echo "Expected Code: 200<br /><br />";

    //Test 2: Get One Locale
    echo "<b>2. Locale GET One</b><br />";
    $url = $localeURL."/en";
    echo $url."<br />";
    $file = @file_get_contents($url, false, $context);
    echo "Response: ".$file."<br />";
    $parsedCode = LastResponseCode();
    echo "Response Code: $parsedCode<br />";
    echo "Expected Code: 200<br /><br />";

    //Test 3: GET one missing
    echo "<b>3. Locale GET One Missing</b><br >";
    $url = $localeURL."/missing";
    echo $url."<br />";
    $file = @file_get_contents($url, false, $context);
    echo "Response: ".$file."<br />";
    $parsedCode = LastResponseCode();
    echo "Response Code: $parsedCode<br />";
    echo "Expected Code: 404<br /><br />";

    //Test 4: POST Add One
    echo "<b>4. Locale Add one (POST)</b><br />";
    $context = stream_context_create([
        "http" => [
            "method" => "POST"
        ]
    ]);
    $url = $localeURL."?newLocaleCode=missing";;
    echo $url."<br />";
    $file = @file_get_contents($url, false, $context);
    echo "Response: ".$file."<br />";
    $parsedCode = LastResponseCode();
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
    $parsedCode = LastResponseCode();
    echo "Response Code: $parsedCode<br />";
    echo "Expected Code: 204<br /><br />";

    


?>