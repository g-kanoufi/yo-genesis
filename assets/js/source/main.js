// Avoid `console` errors in browsers that lack a console.
(function() {
    var method;
    var noop = function () {};
    var methods = [
        'assert', 'clear', 'count', 'debug', 'dir', 'dirxml', 'error',
        'exception', 'group', 'groupCollapsed', 'groupEnd', 'info', 'log',
        'markTimeline', 'profile', 'profileEnd', 'table', 'time', 'timeEnd',
        'timeStamp', 'trace', 'warn'
    ];
    var length = methods.length;
    var console = (window.console = window.console || {});

    while (length--) {
        method = methods[length];

        // Only stub undefined methods.
        if (!console[method]) {
            console[method] = noop;
        }
    }
}());

/* Delete the  "=" in front of the include for not adding those plugins
*/

//=include ../../../bower_components/jquery-prettyPhoto/js/jquery.prettyPhoto.js
//=include ../../../bower_components/svgeezy/svgeezy.js
//=include ../../../bower_components/superfish/dist/js/superfish.js
//=include ../../../bower_components/superfish/dist/js/supersubs.js



(function($) {

	// all Javascript code goes here
	$('body').removeClass('no-js');

})(jQuery);
