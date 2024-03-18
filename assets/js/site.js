import jQuery from 'jquery';
import whatInput from 'what-input';
import Foundation from 'foundation-sites';
import slick from 'slick-carousel';
import inview from 'jquery-inview';
// If you want to pick and choose which modules to include, comment out the above and uncomment
// the line below
//import './lib/foundation-explicit-pieces';

let $ = jQuery;

export default function site() {

    // Private Variables
    let $window  = $(window),
        $doc     = $(document),
        $body    = $('body'),
        $success = $('.gform_confirmation_message'),
        $error   = $('.gfield_description.validation_message');

    // Testing Grid and Buttons
    $body.on('click', '.grid-toggle', function(event) {
        $body.toggleClass('tld-grid');
    });

    // Clickable
    $body.on('click', '.clickable', function(event) {

        if ( event.target['href'] == null ) {
            event.preventDefault();
            event.stopPropagation();

            var $tgt = $(this),
                $a = $tgt.find('a:first'),
                $btn = $tgt.find('button:first'),
                uri = $a.attr('href'),
                new_window = $tgt.hasClass('external-link') || $a.hasClass('external-link') || $a.attr('target') == '_blank' || event.metaKey || event.ctrlKey;

            if ($btn.length > 0) {
                event.stopImmediatePropagation();
                $btn.trigger('click');
                return;
            }

            if ($btn.length < 1 && $a.length > 0) {
                if (new_window) {
                    window.open(uri);
                } else {
                    window.location = uri;
                }
            }

            return false;
        } else {
            return;
        }
    });

    // Global Toggles
    $body
        .on( 'click', 'button[aria-expanded]', buttonToggle );

    // Waves
    if ( $('.wave-divider').length ) {
        $(window).on('load resize', waveDividerEdges );
    }


    //////////////////////////
    //                      //
    // Functions Below Here //
    //                      //
    //////////////////////////

    function buttonToggle( event ) {
        let toToggle = $(this).attr('aria-controls');

        if ( $(this).attr('aria-expanded') === 'false' ) {
            $(this).attr('aria-expanded', 'true' );
            $('#' + toToggle).removeAttr('hidden')
        } else {
            $(this).attr('aria-expanded', 'false' );
            $('#' + toToggle).attr('hidden', true );
        }
    }

    function waveDividerEdges() {
        // Image size is 60 x 20, real height is 15px;
        let waveHeight = 13,
            waveLength = 52,
            waveStroke = 4;

        // Amplitude of the wave - Variation from center ( (height - stroke) / 2)
        let amplitude = ( ( waveHeight - waveStroke ) / 2 );

        // Phase shift to start at highest point when x = 0
        var phaseShift = Math.PI / 2;

        $('.wave-divider').each( function() {

            let width = $(this).width(),
                fromCenter = width / 2;
        
            // Calculate y-coordinate using the sine wave equation
            let y = amplitude * Math.sin((2 * Math.PI / waveLength) * fromCenter - phaseShift);

            $('.wave-divider-dots', $(this) ).css('top', y).addClass('visible');

        });
    }
}
