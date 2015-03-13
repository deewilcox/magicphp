<?php

/*
 * The purpose of this file is to format and return the appropriate methods from magic.js
 */

namespace Magic;

class MagicResponse extends Magic {

    public function assign($elementId,$data) {
        if($elementId !== '') {
            $formattedData = '"' . $data . '"';

            $javascript = <<<JS
            $($elementId).magicAssign($formattedData);
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
            $($formattedString).magicAlert();
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
            $($formattedFormId).magicGetFormValues();
JS;
            return $javascript;
        }
        else {
            return false;
        }
    }
}
