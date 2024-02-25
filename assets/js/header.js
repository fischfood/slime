let $ = jQuery;

export default function site() {

    // Private Variables
    let $window  = $(window),
        $doc     = $(document),
        $body    = $('body');

    // Scrolled Header
    $window.on( 'load resize scroll', function() {
        fixedHeader();
    });

    //////////////////////////
    //                      //
    // Functions Below Here //
    //                      //
    //////////////////////////

    function fixedHeader() {

        var admin_bar = 0,
            header_banner_height = 0;

        if ( $('.header-banner').length ) {
            header_banner_height = $('.header-banner').outerHeight();
        }

        if ( $body.hasClass('admin-bar') ) {
            admin_bar = 32;
        }

        console.log( admin_bar );

        if ( header_banner_height <= $doc.scrollTop() && $window.width() > 767  ) {
            $body.addClass( 'header-scrolled' );
        } else {
            $body.removeClass( 'header-scrolled' );
        }

        if ( header_banner_height <= $doc.scrollTop() - 150 && $window.width() > 767  ) {
            $body.addClass( 'header-shrunk' );
        } else {
            $body.removeClass( 'header-shrunk' );
        }

    }
}
