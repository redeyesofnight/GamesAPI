<?php
    echo "PHP.api<br />";
    $request = explode("/", substr(@$_SERVER['PATH_INFO'], 1));
    if(isset($_ENV['dbUser']))
    {
        echo "DB USER SET: ".$_ENV['dbUser']."<br />";
    }
    echo json_encode($request);

?>