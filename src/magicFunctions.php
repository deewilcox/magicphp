<?php

namespace Magic;

class MagicFunctions{

    private $objResponse;

    public function __construct() {
        //$this->objResponse = NULL;
//        $this->aDebugMessages = array();
    }

    public static function &getInstance() {
        static $obj;
        if (!$obj) {
            $obj = new MagicFunction();
        }
        return $obj;
    }


    public function call() {

    }
}

?>