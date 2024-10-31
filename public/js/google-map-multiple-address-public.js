(function( $ ) {
	'use strict';

	/**
	 * All of the code for your public-facing JavaScript source
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

	/*
	 * Map Initializatioin
	 */
	jQuery(document).ready( function($) {

		var zoom_level  = parseInt( $( '#public-map' ).data( 'zoom' ) );
        var style       = $( '#public-map' ).data( 'style' );
        var scroll      = $( '#public-map' ).data('scroll');
        var counter     = parseInt( $( '.count-box' ).val() );
        var drag        = $( '#public-map' ).data( 'drag' );

        if( zoom_level ){
            var zoom = zoom_level;
        }else{
            var zoom = 12;
        }
        //making a data array 
        var data = [];

        var repeater_field = $( '.google-map-repeater-field' ).length;
        
        var count = parseInt( repeater_field -1 ); 

        for ( var i = 0; i <= count; i++ ) {
            //making a object
            var obj = {};
            obj[ 'longitude' ]    = $( '#longitude' + i ).val();
            obj[ 'latitude' ]     = $( '#latitude' + i ).val();
            obj[ 'info' ]         = $( '#info' + i ).val();
            obj[ 'marker' ]       = $( '#marker' + i ).val();

            //pushing object to the array
            data.push(obj);
        }

        if (typeof data[0] !== 'undefined' && data[0] !== null) {
            /*
             * For Google Map Initialization
             */
            var map;

            //google map options setting
            map = new google.maps.Map( document.getElementById('public-map' ), {
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
             * For Google Map ( Marker ) Initialization
             */
            for ( var i = 0; i <= count; i++ ) {
                var marker;
                marker = new google.maps.Marker({
                    position: {
                        lat: parseFloat( data[i].latitude ),
                        lng: parseFloat( data[i].longitude )
                    },
                    map: map,
                    icon: data[i].marker,

                });


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

	});

})( jQuery );
