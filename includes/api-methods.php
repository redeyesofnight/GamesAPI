<?php
    include_once("models/apierror.php");
    include_once("models/file-content-model.php");

    function FileGetContentResponse($url, $method = "GET")
    {
        if(!($method == "GET" || $method == "POST" || $method == "PUT" || $method == "DELETE"))
        {
            return new FileContentModel(405, '{error:"Invalid http method \''.$method.'\'}');
        }

        $context = stream_context_create([
            "http" => [
                "method" => $method
            ]
        ]);

        $file = @file_get_contents($url,false, $context);
        if(FALSE === $file)
        {
            $error = error_get_last();
            $msg = $error['message'];

            //TODO: Parse the error code here
            $pos = strpos($error['message'], "HTTP/1.1 ");
            $pos += strlen("HTTP/1.1 ");
            $errCode = substr($error['message'], $pos, 3);
            $errMsg = substr($error['message'], $pos+3);
            $apiError = new APIError($errCode, $errMsg);
            return new FileContentModel($errCode, json_encode($apiError));

        }
        else
        {
            return new FileContentModel(http_response_code(), $file);
        }
    }
?>