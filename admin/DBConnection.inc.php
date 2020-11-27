<?php
    require_once('config.inc.php');
    class DBConnection
    {
        /*private $host = "us-cdbr-east-02.cleardb.com";
        private $user = "b357feb9edcd5f";
        private $pass = "8f24eef9";
        private $schema = "heroku_b195ab6ce502998";*/
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
            //$this->handle = new mysqli($this->host, $this->user, $this->pass, $this->schema);
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