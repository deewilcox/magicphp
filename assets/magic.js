/*
    File: magic.js

    This plugin file contains all of the core methods for MagicPHP utilizing the jQuery 2.x library.
    This library is dependent on the inclusion of the jQuery 2.x library in the web application. jQuery 2.x can
    be accessed by visiting http://jquery.com/download/.

    There core function is defined as magic with options set for default values.
    Individual methods are defined in addition as functions assigned .

 */

(function ( $ ) {

    $.fn.magic = function( options ) {
        // Extend the default options
        var opts = $.extend( {}, $.fn.magic.defaults, options );
    };

    // Defaults are a property of the magic plugin
    $.fn.magic.defaults = {
        // Define defaults
    };

    // Define alert function
    $.fn.magic.alert = function( text ) {
        return alert(text);
    };

    $.fun.magic.alertDialog = function ( title,text, button) {
        // Update to use jQuery UI and tell this function to accept title, text, and button parameters.
    };

    // Define assign function
    $.fn.magic.assign = function( elementId, htmlProperty, data ) {
        var element = jQuery("#" + elementId + "");
        if( typeof elementId == undefined) {
            debug('assign','Element is undefined');
        }
        else if (elementId == null) {
            debug('assign','Element is null');
        }
        else {
            //htmlProperty will most commonly be innerHTML or outerHTML
            elementId.htmlProperty = data;
        }

        return this;
    };

    // Define getFormValues function
    $.fn.magic.getFormValues = function( formId ) {
        return jQuery(formId).serializeArray();
    };

    // Define private functions here
    function debug( functionName, error) {
        console.log('MagicPHP Error: ' + functionName + error);
    }

})( jQuery);