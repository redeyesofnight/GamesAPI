<?php
	include_once("Model/Localization.inc.php");

    $keyTranslation = GetLocalizedKey("helloworld");
    echo "<br />Get Key Test<br />";
    echo "Key: helloworld Val_en ".$keyTranslation->value."<br />";

    echo "<br />Key Exists Test<br />";
    echo "Key helloworld exists? ".DoesKeyExist("helloworld")."<br />";
    echo "Key goodbyeworld exists? ".DoesKeyExist("goodbyeworld")."<br />";
    
    echo "<br />Serialize KeyTranslation Test<br />";
    echo json_encode($keyTranslation)."<br />";

    echo "<br />Dump English translation DB Test<br />";
    $localizeDB_en = GetAllKeysForTranslation("en");
    echo json_encode($localizeDB_en)."<br />";

    echo "<br />Add Test<br />";
    $result = AddKey("goodbyeworld", "Goodbye World");
    echo "AddKey(goodbyeworld,'Goodbye World') = ".$result."<br />";
    echo "Key goodbyeworld exists? ".DoesKeyExist("goodbyeworld")."<br />";
    $localizeDB_en = GetAllKeysForTranslation("en");
    echo json_encode($localizeDB_en)."<br />";

    echo "<br />Delete Test<br />";
    DeleteKey("goodbyeworld");
    echo "Key goodbyeworld exists? ".DoesKeyExist("goodbyeworld")."<br />";
    $localizeDB_en = GetAllKeysForTranslation("en");
    echo json_encode($localizeDB_en)."<br />";



?>