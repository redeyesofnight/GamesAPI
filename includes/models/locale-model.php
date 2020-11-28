<?php
    class LocaleModel
    {
        public $code;
        public $keyCount;

        function __construct($code, $keyCount)
        {
            $this->code = $code;
            $this->keyCount = $keyCount;
        }
    }
?>