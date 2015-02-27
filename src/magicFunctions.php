<?php

namespace Magic;

class MagicFunctions extends Magic {

    private $objResponse;

    public function __construct() {
        parent::__construct();
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