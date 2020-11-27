<?php
    class APIError {
        //Mandatory
        public $code;
        public $message;
        //Optional
        public $target;
        public $details;
        public $innererror;
        
        function __construct($code, $message){
            $this->id = $code;
            $this->key = $message;
            $this->target = null;
            $this->details = null;
            $this->innererror = null;
        }
    }
?>