<?php
    function ParseResponseCode($codeString)
    {
        if(strlen($codeString) > strlen("HTTP/1.1 "))
        {
            return substr($codeString, strlen("HTTP/1.1 "), 3);
        }
        return 0;
    }

    function LastResponseCode()
    {
        global $http_response_header;
        $responseCodeString = $http_response_header[0];
        $parsedCode = ParseResponseCode($responseCodeString);
        return $parsedCode;
    }
?>