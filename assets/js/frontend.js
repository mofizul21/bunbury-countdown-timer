jQuery( document ).ready( function( $ ) {
    function bctCountdown() {
        var timerWrappers = $( '.bct-countdown-timer-wrapper' );

        if ( ! timerWrappers.length ) {
            return;
        }

        timerWrappers.each(function() {
            var timerWrapper = $(this);
            var endTime = parseInt( timerWrapper.attr( 'data-end-time' ) );
            var serverTime = parseInt( timerWrapper.attr( 'data-current-time' ) );

            if ( isNaN(endTime) || isNaN(serverTime) ) {
                return;
            }

            var clientTime = Math.floor( new Date().getTime() / 1000 );
            var timeOffset = serverTime - clientTime;

            var hoursSpan = timerWrapper.find( '.bct-hours' );
            var minutesSpan = timerWrapper.find( '.bct-minutes' );
            var secondsSpan = timerWrapper.find( '.bct-seconds' );

            var interval = setInterval( function() {
                var now = Math.floor( new Date().getTime() / 1000 ) + timeOffset;
                var remainingSeconds = endTime - now;

                if ( remainingSeconds < 0 ) {
                    // Restart the timer for the next day
                    endTime = endTime + (24 * 60 * 60);
                    remainingSeconds = endTime - now;
                }

                var hours = Math.floor( remainingSeconds / 3600 );
                var minutes = Math.floor( ( remainingSeconds % 3600 ) / 60 );
                var seconds = remainingSeconds % 60;

                hoursSpan.text( hours );
                minutesSpan.text( minutes );
                secondsSpan.text( seconds );

            }, 1000 );
        });
    }

    bctCountdown();
} );