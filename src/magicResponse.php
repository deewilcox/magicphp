<?php

/*
 * The purpose of this file is to format and return the appropriate methods from magic.js
 */

namespace Magic;

class MagicResponse extends Magic {

    // @TODO: We don't need this constructor unless we need to define the response object as a container/array
    public function __construct() {
        parent::__construct();

    }

    public function assign($elementId,$property,$data) {
        if($elementId !== '') {
            $formattedElementId = '"#' . $elementId . '"';
            $formattedProperty = '"' . $property . '"';
            $formattedData = '"' . $data . '"';

            $javascript = <<<JS
            magic.assign($formattedElementId, $formattedProperty, $formattedData);
JS;

            return $javascript;
        }
        else {
            return false;
        }
    }

    public function script($script) {
        // This could be any and everything, so $script must be formatted correctly when it is passed in
        if($script) {
            $javascript = <<<JS
            $script
JS;

            return $javascript;
        }
        else {
            return false;
        }
    }

    public function alert($string) {
        if($string) {
            $formattedString = '"' . $string . '"';
            $javascript = <<<JS
            magic.alert($formattedString);
JS;

            return $javascript;
        }
        else {
            return false;
        }
    }


    public function getFormValues($formId) {
        if($formId) {
            $formattedFormId = '"#' . $formId . '"';
            $javascript = <<<JS
            magic.getFormValues($formattedFormId);
JS;
            return $javascript;
        }
        else {
            return false;
        }
    }
}
