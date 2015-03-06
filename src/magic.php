<?php

namespace Magic;

/**
 * Motto:
    "Any sufficiently advanced technology is indistinguishable from magic." - Arthur C. Clarke
 *
 * Purpose:
    The purpose of this class is to make utilizing Ajax within a PHP application much easier for the developer.
    Rather than write and re-write multiple functions within methods and views, we are able to populate views directly
    from the method associated with that view, without additional javascript, jQuery, or HTML. In this way,
    we are able to create an "over the wall" MVC application.
 *
 * Settings:
    Application specific settings are contained in config/magicSettings.json. JSON was chosen as the file type because
    json_decode is well supported in PHP, and we don't want to require applications to use or install other parsing tools.
 *
 * Objects:
    @magicSettings - contains application specific settings
    @magicErrorHandler
    @magicProcesingEventHandlers
    @magicFunctions - used to call functions and get form values
    @magicResponse -- used to populate views
 *
 * Methods:

**/

include_once('config/magicSettings.json');
include_once('magicResponse.php');
include_once('magicFunctions.php');
include_once('magicRequestManager.php');

class Magic {

    private $magicSettings;
    private $magicUserSessionKey;
    private $magicErrorHandler;
    private $magicLogFile;
    public $magicCanProcessRequest;

    public $magicRequestObject;
    public $magicResponseObject;
    public $magicFunctionsObject;

    public function __construct(){
        /* Default values for settings */
        $this->magicCanProcessRequest = false;
        $this->magicErrorHandler = false;
        $this->magicLogFile = false;

        $this->magicRequestObject = new MagicRequestManager();
        $this->magicResponseObject = new MagicResponse();
        $this->magicFunctionsObject = new MagicFunctions();

        /* Get settings from json file */
        $jsonSettings = file_get_contents('config/magicSettings.json');
        $settingsArray = json_decode($jsonSettings);
        $this->magicSettings = $settingsArray['settings'];

        /* If the request URL has not been set in the config file, get the server URI */
        if($this->magicSettings->requestURI == '') {
            $this->magicSettings->requestURI = $_SERVER['SERVER_NAME'];
        }

        $this->magicErrorHandler = $this->magicSettings->errorHandler;
        $this->magicCleanBuffer = $this->magicSettings->errorHandler;
        $this->magicLogFile = $this->magicSettings->errorHandler;
        $this->magicExitAllowed = $this->magicSettings->exitAllowed;

    }

    /* Verify sessions are enabled and create a secure session */
    public function verifySession() {
        $sessionId = session_id();
        if($sessionId === '') {
            $this->magicResponseObject->alert('Must enable sessions to use magicPHP.');
            return false;
        }
        else{
            return true;
        }
    }

    private function getMagicSession($sessionKey) {
        $magicSessionKey = '';

        if (isset($_SESSION[$sessionKey])){
            $magicSessionKey = $_SESSION[$sessionKey];
        }

        return $magicSessionKey;
    }

    private function makeMagicSession() {
        return hash('md5', session_id());
    }

    /*
     * Function: processRequest
     *
     * Checks for and sets the unique magicPHP session key pair. This is to ensure we have a valid session.
     * Creates a valid, open instance of magicPHP, in which various request types are received and processed.
     * Checks for and instantiates the magicErrorHandler for handing back PHP errors.
     *
     */
    public function processRequest() {
        // Check to see if headers have already been set
        if (headers_sent($fileName, $lineNumber)) {
            echo "Output has already been sent to the browser at {$fileName}:{$lineNumber}.\n";
            echo 'Please make sure the command $magic->processRequest() is placed before this.';
            exit();
        }

        // Check for valid session
        if (false === $this->verifySession()){
            echo "Sessions must be enabled to utilize magicPHP. Please enable sessions. \n";
            exit();
        }

        // Set session key and value if they have not been set
        $sessionKey = $this->magicSettings->sessionKey;
        $sessionValue = $this->getMagicSession($sessionKey);

        if(!isset($_SESSION[$sessionKey])) {
            $_SESSION[] = $sessionKey;
        }

        if($sessionValue == '') {
            if(empty($this->magicUserSessionKey)) {
                $this->magicUserSessionKey = $this->makeMagicSession();
            }
            $sessionKey = $this->magicUserSessionKey;
            $_SESSION[$sessionKey] = $this->magicUserSessionKey;
        }

        // Session keys are set. Set $magicCanProcessRequest equal to true.
        if (isset($_SESSION[$sessionKey]) && !empty($_SESSION[$sessionKey])) {
            $this->magicCanProcessRequest = true;
            // @TODO: Build magicErrorHandler for handing back PHP errors
            // @TODO: Build magicLog for magicPHP logging
        }
        else{
            $this->magicCanProcessRequest = false;
        }
    }

    public function getJavascript(){
        $javascript = '';

        // Iterate over the requests object and echo out each request
        $requests = $this->magicRequestObject->returnRequests();

        foreach($requests as $request){
            $javascript .= $request;
        }

        return '<script>' . $javascript . '</script>';
    }
}
