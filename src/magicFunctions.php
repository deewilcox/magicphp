<?php

namespace Magic;

class MagicFunctions extends Magic {

    public function __construct() {
        parent::__construct();
    }

    public static function &getInstance() {
        static $obj;
        if (!$obj) {
            $obj = new MagicFunctions();
        }
        return $obj;
    }

    
}
