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

    if ( $('.portfolio-filter-container').length ) {
        $body.on( 'change', '.portfolio-filter-container select', portfolioFilter );
    }


    if ($('.portfolio-slider').length) {
        portfolioSlider();

        $body.on( 'click', '.pm-trigger', portfolioModal );
    }

    if ($('.testimonial-slider').length) {
        testimonialSlider();
    }

    if ($('.company-slider').length) {
        companySlider();
    }

    if ( $('.gform_wrapper').length ) {

        gformLabels();

        $('.gform_wrapper input').blur( function() {
            if ( $(this).val() != '' ) {
                $(this).addClass('input-active');
            } else {
                $(this).removeClass('input-active')
            }
        })
    }

    // InView Progress Bars
    $('.progress-bar').on( 'inview', function() {
        if ( $(this).hasClass('not-in-view') ) {
            $(this).removeClass('not-in-view');
        }
    } );

    //////////////////////////
    //                      //
    // Functions Below Here //
    //                      //
    //////////////////////////

    function portfolioFilter( event ) {

        var url = $(this).val();

        if ( url != '' ) {
            window.location = url;
        }
    }

    function portfolioSlider() {

        $(window).bind( 'load', function() {
            $('.portfolio-slider').slick({
                dots: false,
                arrows: true,
                slidesToShow: 2,
                slidesToScroll: 1,
                draggable: false,
                responsive: [
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 1,
                        }
                    },
                ]
            });
        })

        $('.portfolio-slider').on('setPosition', function () {
            $(this).find('.slick-slide').height('auto');
            var slickTrack = $(this).find('.slick-track');
            var slickTrackHeight = $(slickTrack).height();
            $(this).find('.slick-slide').css('height', slickTrackHeight + 'px');
        });
    }

    function portfolioModal() {
        var trigger = $(this).data('open-trigger');

        if ( $window.width() > 639 ) {
            $('.pm-block.' + trigger).trigger('click');
        }
    }

    function testimonialSlider() {

        $(window).bind( 'load', function() {
            $('.testimonial-slider').slick({
                dots: false,
                arrows: true,
                fade: true,
            });
        })

        $('.testimonial-slider').on('setPosition', function () {
            $(this).find('.slick-slide').height('auto');
            var slickTrack = $(this).find('.slick-track');
            var slickTrackHeight = $(slickTrack).height();
            $(this).find('.slick-slide').css('height', slickTrackHeight + 'px');
        });
    }

    function companySlider() {

        $(window).bind( 'load', function() {
            $('.company-slider').slick({
                dots: false,
                arrows: true,
                slidesToShow: 3,
                slidesToScroll: 1,
                autoplay: true,
                responsive: [
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 2,
                        }
                    },
                    {
                        breakpoint: 540,
                        settings: {
                            slidesToShow: 1,
                        }
                    },
                ]
            });
        })

        $('.company-slider').on('setPosition', function () {
            $(this).find('.slick-slide').height('auto');
            var slickTrack = $(this).find('.slick-track');
            var slickTrackHeight = $(slickTrack).height();
            $(this).find('.slick-slide').css('height', slickTrackHeight + 'px');
        });
    }

    function gformLabels() {
        $('.move-label .ginput_container_text, .move-label .ginput_container_email').each( function() {
            var label = $(this).parents('li.gfield').children('label').html();

            $(this).append('<span class="inner-label"></span>');
            $('.inner-label', $(this)).html( label );
        })
    }
}
