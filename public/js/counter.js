/*!
* jquery.countup.js 1.0.3
*
* Copyright 2016, Adrián Guerra Marrero http://agmstudio.io @AGMStudio_io
* Released under the MIT License
*
* Date: Oct 27, 2016
*/
(function ($) {
    "use strict";
    $.fn.countUp = function (options) {
        // Defaults
        var settings = $.extend({
            'time': 2000,
            'delay': 10
        }, options);
        return this.each(function () {
            // Store the object
            var $this = $(this);
            var $settings = settings;
            var counterUpper = function () {
                if (!$this.data('counterupTo')) {
                    $this.data('counterupTo', $this.text());
                }
                var time = parseInt($this.data("counter-time")) > 0 ? parseInt($this.data("counter-time")) : $settings.time;
                var delay = parseInt($this.data("counter-delay")) > 0 ? parseInt($this.data("counter-delay")) : $settings.delay;
                var divisions = time / delay;
                var num = $this.data('counterupTo');
                var nums = [num];
                var isComma = /[0-9]+,[0-9]+/.test(num);
                num = num.replace(/,/g, '');
                var isInt = /^[0-9]+$/.test(num);
                var isFloat = /^[0-9]+\.[0-9]+$/.test(num);
                var decimalPlaces = isFloat ? (num.split('.')[1] || []).length : 0;
                // Generate list of incremental numbers to display
                for (var i = divisions; i >= 1; i--) {
                    // Preserve as int if input was int
                    var newNum = parseInt(Math.round(num / divisions * i));
                    // Preserve float if input was float
                    if (isFloat) {
                        newNum = parseFloat(num / divisions * i).toFixed(decimalPlaces);
                    }
                    // Preserve commas if input had commas
                    if (isComma) {
                        while (/(\d+)(\d{3})/.test(newNum.toString())) {
                            newNum = newNum.toString().replace(/(\d+)(\d{3})/, '$1' + ',' + '$2');
                        }
                    }
                    nums.unshift(newNum);
                }
                $this.data('counterup-nums', nums);
                $this.text('0');
                $this.data('counterup-func', null);
                // Updates the number until we're done (guard against race conditions where data may be cleared)
                var f = function () {
                    var nums = $this.data('counterup-nums');
                    // If nums is not set (null) or not an array, stop safely
                    if (!nums || !nums.length) {
                        // cleanup any lingering references
                        $this.data('counterup-nums', null);
                        $this.data('counterup-func', null);
                        return;
                    }

                    // shift next value and display
                    var next = nums.shift();
                    $this.text(next);

                    if (nums.length) {
                        // write back the array (shift mutated it already)
                        $this.data('counterup-nums', nums);
                        // schedule next tick
                        var fn = $this.data('counterup-func');
                        if (typeof fn === 'function') {
                            setTimeout(fn, delay);
                        }
                    } else {
                        // finished – cleanup
                        $this.data('counterup-nums', null);
                        $this.data('counterup-func', null);
                    }
                };
                $this.data('counterup-func', f);
                // Start the count up
                setTimeout($this.data('counterup-func'), delay);
            };
            // Perform counts when the element gets into view
            $this.waypoint(counterUpper, { offset: '100%', triggerOnce: true });
        });
    };
})(jQuery);
