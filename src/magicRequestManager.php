<?php

namespace Magic;

include_once('magicResponse.php');
include_once('magicFunctions.php');

class MagicRequestManager extends Magic {

    public $magicResponseObject;
    public $magicFunctionsObject;

    public function __construct(){
        parent::__construct();

        $this->magicResponseObject = new MagicResponse();
        $this->$magicFunctionsObject = new MagicFunctions();
    }

    public function receiveRequest($requestType, $requestFunction) {
        if($this->magicCanProcessRequest) {
            if($requestType == 'magicResponse') {
                if(method_exists($this->magicResponseObject,$requestFunction)) {
                    $this->magicResponseObject->$requestFunction;
                }
                else{
                    $this->magicResponseObject->alert('The requested function does not exist.');
                }
            }
            else if ($requestType == 'magicFunction') {
                if(method_exists($this->magicFunctionsObject,$requestFunction)) {
                    $this->magicFunctionsObject->$requestFunction;
                }
                else{
                    $this->magicResponseObject->alert('The requested function does not exist.');
                }
            }
            else {
                $this->magicResponseObject->alert('The requested function does not exist.');
            }
        }
        else{
            echo "Sessions must be enabled to utilize magicPHP. Please enable sessions. \n";
        }
    }
}

?>