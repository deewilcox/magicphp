/*
    File: magic.js

    This plugin file contains all of the core methods for MagicPHP utilizing the jQuery 2.x library.
    This library is dependent on the inclusion of the jQuery 2.x library in the web application. jQuery 2.x can
    be accessed by visiting http://jquery.com/download/.
 */

(function ( $ ) {

    $.fn.magic = function() {
        // Initialize the plugin
    };

    // Define alert function
    $.fn.magicAlert = function( text ) {
        return alert(text);
    };

    $.fn.magicAlertDialog = function ( title,text, button) {
        // Update to use jQuery UI and tell this function to accept title, text, and button parameters.
    };

    // Define assign function
    $.fn.magicAssign = function( elementId, data ) {
        var element = $('#' + elementId);
        if( typeof elementId == undefined) {
            debug('assign','Element is undefined');
        }
        else if (elementId == null) {
            debug('assign','Element is null');
        }
        else {
            $('#' + elementId).html(data);
        }
    };

    // Define callFunction function
    // @TODO: This method still needs work
    $.fn.magicCallFunction = function ( functionName, formValues ){
        console.log(functionName);
        console.log(formValues);
        $.ajax({
            url: "/",
            data: {
                requestFunction:functionName,
                requestParameters: formValues
            },
            type: "POST",
            dataType: "json",
            success: function(data) {
                // do something
            },
            error: function (data) {
                console.log(data);
            },
            complete: function(data){
                // do something
            }
        });
    };

    // Define getFormValues function
    $.fn.magicGetFormValues = function( formId ) {
        return $(formId).serializeArray();
    };

    // Private debugging function
    function debug( functionName, error) {
        console.log('MagicPHP Error: ' + functionName + error);
    }

})( jQuery); // Note: we use jQuery here to avoid conflicts with other plugins.