<?php

namespace Magic;

class MagicResponse{

    private $objResponse;
    private $sCharacterEncoding;
    private $bOutputEntities;
    private $aDebugMessages;


    public function __construct() {
        //$this->objResponse = NULL;
//        $this->aDebugMessages = array();
    }

    public static function &getInstance() {
        static $obj;
        if (!$obj) {
            $obj = new MagicResponse();
        }
        return $obj;
    }

    public function debug() {

    }

    public function confirmCommands() {

    }

    public function assign() {

    }

    public function append() {

    }

    public function script() {

    }

    public function alert() {

    }

    public function call() {

    }

    public function clear() {

    }

    public function send() {

    }
}

?>