<?php

/*
 * The purpose of this class is to validate the requests that are received.
 * If requests can be processed, and the request is valid, send to the appropriate child class.
 * Otherwise, generate an error response.
*/

namespace Magic;

include_once('magicResponse.php');
include_once('magicFunctions.php');

class MagicRequestManager extends Magic {

    public $magicResponseObject;
    public $magicFunctionsObject;
    public $magicRequestsArray;

    public function __construct(){
        parent::__construct();

        $this->magicResponseObject = new MagicResponse();
        $this->$magicFunctionsObject = new MagicFunctions();

        // Create request object
        $this->magicRequestsArray = array();
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

    public function queueRequests($requestFunction) {
        if($requestFunction) {
            $this->magicRequestsArray[] = $requestFunction;
            return true;
        }
        else {
            return false;
        }
    }

    public function returnRequests() {
        return $this->magicRequestsArray;
    }

    public function clearRequest($requestFunction) {
        // Remove request from Array after its response has been received
    }
}

?>