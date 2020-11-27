<?php
    require_once("LocalizationDatabase.inc.php");

    $supported_locales = GetSupportedLocales();
    echo json_encode($supported_locales);
?>