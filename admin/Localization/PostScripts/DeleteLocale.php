<?php
    require_once('../LocalizationDatabase.inc.php');
    
    if(!isset($_REQUEST['locale']))
    {
        echo "1,No locale passed to DeleteLocale.";
        return;
    }
    
    $locale = $_REQUEST['locale'];

    DeleteLocale($locale);

    echo "0,Succesfully deleted locale '$locale'";
?>