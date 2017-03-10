/**
 * Live-update changed settings in real time in the Customizer preview.
 */
( function( $ ) {
	var api = wp.customize;

	// Site title.
	api( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );

	// Site tagline.
	api( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

	// Add custom-background-image body class when background image is added.
	api( 'background_image', function( value ) {
		value.bind( function( to ) {
			$( 'body' ).toggleClass( 'custom-background-image', '' !== to );
		} );
	} );

	// header background color.
	api.bind( 'preview-ready', function() 
	{
		api.preview.bind( 'header_background_color', function(color) {
			$('#masthead').css('background-color',color);
		});
		api.preview.bind('wt_bg_color', function(color) {
			$('#secondary.sidebar .widget .widget-title').css('background-color',color);
		});
		api.preview.bind('footer_bg_color', function(color) {
			$('#colophon').css('background-color',color);
		});
		api.preview.bind( 'wt_color', function(color) {
			$('#secondary.sidebar .widget .widget-title').css('color',color);
		});
		api.preview.bind('bt_bg_color',function(color) {
			$('button,input[type="submit"], input[type="reset"], .button').css('background-color',color);
		});
		api.preview.bind( 'bt_color', function(color) {
			$('button,input[type="submit"], input[type="reset"], .button').css('color',color);
		});
		api.preview.bind( 'link_color', function(color) {
			$('a').css('color',color);
		});
		
		
	} );
} )( jQuery );