<?php
    require_once('../LocalizationDatabase.inc.php');
    
    if(!isset($_REQUEST['locale']))
    {
        echo "1,No locale passed to AddLocale.";
        return;
    }
    
    $locale = $_REQUEST['locale'];

    AddLocale($locale);

    echo "0,Succesfully added locale '$locale'";
?>