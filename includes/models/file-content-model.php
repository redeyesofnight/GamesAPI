<?php
    class FileContentModel
    {
        public $code;
        public $content;

        function __construct($code, $content)
        {
            $this->code = $code;
            $this->content = $content;
        }
    }

?>