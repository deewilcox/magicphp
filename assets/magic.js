/*
    File: magic.js

    This plugin file contains all of the core methods for MagicPHP utilizing the jQuery 2.x library.
    This library is dependent on the inclusion of the jQuery 2.x library in the web application. jQuery 2.x can
    be accessed by visiting http://jquery.com/download/.
 */

(function ( $ ) {

    $.fn.magic = function() {
        // Check plugin availability
        if(this) {
            console.log(this);
        }
        else {
            console.log('Status: magic.js is initialized and running.');
        }
    };

    // Define alert function
    $.fn.magicAlert = function() {
        return alert(this);
    };

    // Define assign function
    $.fn.magicAssign = function( data ) {
        var elementId = $('#' + this);
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
    $.fn.magicCallFunction = function ( formValues ){
        var functionName = this;
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
    $.fn.magicGetFormValues = function() {
        return $(this).serializeArray();
    };

    // Private debugging function
    function debug( functionName, error) {
        console.log('MagicPHP Error: ' + functionName + error);
    }

})( jQuery); // Note: we use jQuery here to avoid conflicts with other plugins.