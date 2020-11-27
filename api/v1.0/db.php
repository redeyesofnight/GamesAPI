<?php
    require_once('config.php');

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
            global $config;
            $this->handle = new mysqli($config["dbHost"], $config["dbUser"], $config["dbPass"], $config["dbSchema"]);
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