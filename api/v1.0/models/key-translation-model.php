<?php
    class KeyTranslation {
        public $id;
        public $key;
        public $value;
        function __construct($id, $key, $value){
            $this->id = $id;
            $this->key = $key;
            $this->value = $value;
        }
    }
?>