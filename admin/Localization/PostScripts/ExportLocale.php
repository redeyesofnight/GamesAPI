<?php
    require_once('../LocalizationDatabase.inc.php');
    
    if(!isset($_REQUEST['locale']))
    {
        die("No Locale");
    }

    $locale = $_REQUEST['locale'];
    $db = GetTranslationDatabase($locale);
    header('Content-Disposition: attachment; filename="localization_'.$locale.'.json"');
    echo json_encode($db);
?>