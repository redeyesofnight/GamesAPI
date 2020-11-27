<?php
    require_once("LocalizationModel.inc.php");
    require_once("LocalizationDatabase.inc.php");

    $locale = "en";
    if(isset($_REQUEST["locale"]))
    {
        $locale = $_REQUEST["locale"];
    }

    $localizeDB_en = GetTranslationDatabase($locale);
    echo json_encode($localizeDB_en);
?>