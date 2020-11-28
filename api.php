<?php
    require_once('includes/db.php');
    require_once('includes/api-methods.php');
    echo "PHP.api<br />";
    $request = explode("/", substr(@$_SERVER['PATH_INFO'], 1));
    

    if(count($request) <3)
    {
        echo "Error: Insufficient api vars";
        //http_response_code(404);
    }
    else
    {
        echo json_encode($request);
    }
        
}

?>