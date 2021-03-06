<?php
    include_once('includes/db.php');
    include_once('includes/api-methods.php');

    //On some systems, the proper variable will be set in $_SERVER
    if(isset($_SERVER["apiBaseURL"]))
    {
        $_ENV["apiBaseURL"] = $_SERVER["apiBaseURL"];
    }

    if(!isset($_ENV["apiBaseURL"]))
    {
        die("Error: Missing Environment variable apiBaseURL");
    }

    $request = explode("/", substr(@$_SERVER['PATH_INFO'], 1));
    //echo json_encode($request)."<br />";

    if(count($request) <3)
    {
        //echo "Error: Insufficient api vars";
        http_response_code(404);
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
                        $response = FileGetContentResponse($url, $_SERVER['REQUEST_METHOD']);
                        http_response_code($response->code);
                        echo json_encode($response->content);
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