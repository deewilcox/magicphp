<?php

namespace Magic;

class MagicResponse extends Magic {

    private $objResponse;
    private $sCharacterEncoding;
    private $bOutputEntities;
    private $aDebugMessages;


    public function __construct() {
        parent::__construct();
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