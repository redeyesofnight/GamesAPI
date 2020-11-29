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
            $this->code = $code;
            $this->message = $message;
            $this->target = null;
            $this->details = null;
            $this->innererror = null;
        }
    }
?>