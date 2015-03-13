<?php

/*
 * The purpose of this class is to validate the requests that are received.
 * If requests can be processed, and the request is valid, send to the appropriate child class and clear the request.
 * Otherwise, generate an error response.
*/

namespace Magic;

include_once('magicResponse.php');

class MagicRequestManager extends Magic {

    private $magicRequestsArray;

    public function __construct(){
        parent::__construct();

        // Create request object
        $this->magicRequestsArray = array();
    }

    public function receiveRequest($requestType, $requestFunction) {
        $magicResponseObject = new MagicResponse();

        if($this->magicCanProcessRequest) {
            if($requestType == 'magicResponse') {
                if(method_exists($this->magicResponseObject,$requestFunction)) {
                    $this->magicResponseObject->$requestFunction;
                }
                else{
                    $magicResponseObject->alert('The requested function does not exist.');
                }
            }
            else if ($requestType == 'magicFunction') {
                if(method_exists($this->magicFunctionsObject,$requestFunction)) {
                    $this->magicFunctionsObject->$requestFunction;
                }
                else{
                    $magicResponseObject->alert('The requested function does not exist.');
                }
            }
            else {
                $magicResponseObject->alert('The requested function does not exist.');
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
