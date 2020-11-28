<?php
    include_once('config.php');
    if(isset($_SERVER["dbHost"]))
    {
        $_ENV["dbHost"] = $_SERVER["dbHost"];
    }
    if(isset($_SERVER["dbUser"]))
    {
        $_ENV["dbUser"] = $_SERVER["dbUser"];
    }
    if(isset($_SERVER["dbPass"]))
    {
        $_ENV["dbPass"] = $_SERVER["dbPass"];
    }
    if(isset($_SERVER["dbSchema"]))
    {
        $_ENV["dbSchema"] = $_SERVER["dbSchema"];
    }

    class DBConnection
    {
        public $handle;

        private $open = false;

        static $instance;
        public static function Instance()
        {
            if(is_null($instance))
            {
                $instance = new DBConnection();
            }
            return $instance;
        }

        function __construct()
        {
            if(!isset($_ENV["dbHost"]))
            {
                die("Error: Missing Environment variable dbHost");
            }
            if(!isset($_ENV["dbUser"]))
            {
                die("Error: Missing Environment variable dbUser");
            }
            if(!isset($_ENV["dbPass"]))
            {
                die("Error: Missing Environment variable dbPass");
            }
            if(!isset($_ENV["dbSchema"]))
            {
                die("Error: Missing Environment variable dbSchema");
            }

            $this->handle = new mysqli($_ENV["dbHost"], $_ENV["dbUser"], $_ENV["dbPass"], $_ENV["dbSchema"]);
            if($this->handle->connect_error)
            {
                die("Connection failed: " . $this->handle->connect_error);
            }
            else
            {
                $open = true;
            }
        }

        function __destruct()
        {
            $this->close();
        }

        function close()
        {
            if($this->open)
            {
                $this->handle->close();
                $open = false;
            }
        }

    }
?>