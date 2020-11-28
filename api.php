<?php
    require_once('includes/db.php');
    require_once('includes/api-methods.php');

    if(!isset($_ENV["apiBaseURL"]))
    {
        die("Error: Missing Environment variable apiBaseURL");
    }

    $request = explode("/", substr(@$_SERVER['PATH_INFO'], 1));
    //echo json_encode($request)."<br />";

    if(count($request) <3)
    {
        echo "Error: Insufficient api vars";
        //http_response_code(404);
    }
    else
    {
        switch($request[1])
        {
            case "localization":
                switch($request[2])
                {
                    case "locales":
                        $url = $_ENV["apiBaseURL"]."/includes/localization/locales.php";
                        for($i = 3; $i < count($request); $i++)
                        {
                            $url.="/".$request[$i];
                        }
                        //echo "URL: ".$url."<br />";
                        $file = @file_get_contents($url, false, $context);
                        echo $file;
                    break;
                    default:
                        http_response_code(404);
                    break;
                }

                
                break;
            default:
                http_response_code(404);
            break;
        }
    }

?>