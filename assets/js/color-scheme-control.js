/**
 * Add a listener to the Color Scheme control to update other color controls to new values/defaults.
 * Also trigger an update of the Color Scheme CSS when a color is changed.
 */
( function( api ) {
	var colorSettings = ['header_background_color','footer_bg_color', 'wt_bg_color','wt_color','bt_bg_color','bt_color' ,'link_color'];

	// Update the CSS whenever a color setting is changed.
	_.each( colorSettings, function( setting ) {
		api( setting, function( setting ) {
			setting.bind( updateCSS );
		} );
	} );
	
	// Generate the CSS for the current Color Scheme.
	function updateCSS() 
	{
		if( header_background_color = api( 'header_background_color' )()){
			api.previewer.send( 'header_background_color', header_background_color );
		}
		if( footer_bg_color = api( 'footer_bg_color' )()){
			api.previewer.send( 'footer_bg_color', footer_bg_color );
		}
		if( wt_bg_color = api( 'wt_bg_color' )()){
			api.previewer.send( 'wt_bg_color', wt_bg_color );
		}
		if( wt_color = api( 'wt_color' )()){
			api.previewer.send( 'wt_color', wt_color );
		}
		if( bt_bg_color = api( 'bt_bg_color' )()){
			api.previewer.send( 'bt_bg_color', bt_bg_color );
		}
		if( bt_color = api( 'bt_color' )()){
			api.previewer.send( 'bt_color', bt_color );
		}
		if( link_color = api( 'link_color' )()){
			api.previewer.send( 'link_color', link_color );
		}
	}
} )( wp.customize );