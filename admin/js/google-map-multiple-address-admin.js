(function ($) {
    'use strict';

    /**
     * All of the code for your admin-facing JavaScript source
     * should reside in this file.
     *
     * Note: It has been assumed you will write jQuery code here, so the
     * $ function reference has been prepared for usage within the scope
     * of this function.
     *
     * This enables you to define handlers, for when the DOM is ready:
     *
     * $(function() {
	 *
	 * });
     *
     * When the window is loaded:
     *
     * $( window ).load(function() {
	 *
	 * });
     *
     * ...and/or other possibilities.
     *
     * Ideally, it is not considered best practise to attach more than a
     * single DOM-ready or window-load handler for a particular page.
     * Although scripts in the WordPress core, Plugins and Themes may be
     * practising this, we should strive to set a better example in our own work.
     */
    jQuery(document).ready(function ($) {

        var zoom_level  = parseInt( $( '#admin-map' ).data( 'zoom' ) );
        var style       = $( '#admin-map' ).data( 'style' );
        var scroll      = $( '#admin-map' ).data('scroll');
        var counter     = parseInt( $( '.count-box' ).val() );
        var drag        = $( '#admin-map' ).data( 'drag' );

        if( zoom_level ){
            var zoom = zoom_level;
        }else{
            var zoom = 12;
        }
        // Making a data array 
        var data = [];

        var repeater_field = $( '.google-map-repeater-field' ).length;
        
        var count = parseInt( repeater_field -1 ); 

        for ( var i = 0; i <= count; i++ ) {
            // Making a object
            var obj = {};
            obj[ 'longitude' ]    = $( '#longitude' + i ).val();
            obj[ 'latitude' ]     = $( '#latitude' + i ).val();
            obj[ 'info' ]         = $( '#info' + i ).val();
            obj[ 'marker' ]       = $( '#marker' + i ).val();

            // Pushing object to the array
            data.push(obj);
        }

        if (typeof data[0] !== 'undefined' && data[0] !== null) {
            /*
             * For Google Map Initialization
             * Accepting various options for the map
             * Map, Marker and InfoBox 
             */
            var map;

            // Google map options setting
            map = new google.maps.Map( document.getElementById('admin-map' ), {
                center: {
                    lat: parseFloat( data[0].latitude ),
                    lng: parseFloat( data[0].longitude )
                }, 
                zoom: zoom,
                scrollwheel: scroll,
                navigationControl: false,
                styles: style,
                draggable: drag,
                mapTypeId: google.maps.MapTypeId.ROADMAP,
            });

            /*
             * For Google Map ( Marker and InfoBox ) Initialization
             * Multiple marker and infobox with different locations and information respectively
             */
            for ( var i = 0; i <= count; i++ ) {
                // Marker
                var marker;
                marker = new google.maps.Marker({
                    position: {
                        lat: parseFloat( data[i].latitude ),
                        lng: parseFloat( data[i].longitude )
                    },
                    map: map,
                    icon: data[i].marker,

                });

                // InfoBox
                ( function ( marker, i){
                    google.maps.event.addListener( marker, 'click', function (){
                        var contentString = data[i].info;
                        var infowindow = new google.maps.InfoWindow({
                            content: contentString
                        });
                        infowindow.open( map, marker );
                    });
                })( marker, i );
            }
        }


        $(document).on('click', '.upload-btn', function (e) {
            // Aassigning the particular section to new variable
            var $this = $(this);

            e.preventDefault();

            var image = wp.media({
                title: 'Upload Image',
                // mutiple: true if you want to upload multiple files at once
                multiple: false
            }).open()
                .on('select', function (e) {

                    // This will return the selected image from the Media Uploader, the result is an object 
                    var uploaded_image = image.state().get( 'selection' ).first();
                    // We convert uploaded_image to a JSON object to make accessing it easier
                    // Output to the console uploaded_image
                    var image_url = uploaded_image.toJSON().url;

                    // Let's assign the url value to the input field
                    $this.prev().val( image_url );

                    //$this.parent().html('<img src="'+ image_url+'"/>');
                    var $img = '<img src="' + image_url + '"/>';
                    $this.parent().find( '.marker-holder' ).html( $img );

                }); 
        });


        $( '.google-map-repeater-button' ).click( function (e) {
           
             var repeater_length = $( '.google-map-repeater-field' ).length;

             count = parseInt( repeater_length );

            e.preventDefault();

            var $html = '<ul class="google-map-repeater-field"><li>' +
                '<input type="text" id="longitude" name="google-map-multiple-address[latitude' + count + ']" value="" class="regular-text" />' +
                '</li>' +
                '<li>' +
                '<input type="text" id="latitude" name="google-map-multiple-address[longitude' + count + ']" value="" class="regular-text" />' +
                '</li>' +
                '<li>' +
                '<input type="text" id="info" name="google-map-multiple-address[info' + count + ']" value="" class="regular-text" />' +
                '</li>' +
                '<li>' +
                '<span class="marker-holder">'+
                '</span>'+
                '<input type="text" name="google-map-multiple-address[image_url' + count + ']" class="image_url hidden regular-text">' +
                '<input type="button" name="google-map-multiple-address[upload-btn' + count + ']" class="button-secondary upload-btn" value="Upload Image">' + '<span class="remove-row"><a href="javascript:void(0)">X</a></span>'+
                '</li>' +
                '</ul>';

            $($html).insertBefore( '.google-map-repeater-button-wrapper' );

            $('.count-box').val(count);

            $( '.remove-row' ).removeClass( 'hidden' );
            //count += 1;
        });

        $(document).on( 'click', '.google-map-repeater .remove-row', function(){
            //confirmation for deleting the row
            var count = $( '.google-map-repeater-field' ).length;

            if( parseInt( count ) == 1 ){

                alert( 'The last row cannot be deleted' );

            } else {
                if ( confirm( 'Are you sure ?' ) ) {

                    $(this).parent().parent().remove();

                }
            }
        });

    }); //document.ready

})(jQuery);
