<?php

// throw this in wp-config.php.  Added here for portability
/*
	define( 'WP_DEBUG', true ); 			// turn on debug mode
	define( 'WP_DEBUG_LOG', true );			// log to wp-content/debug.log
	define( 'WP_DEBUG_DISPLAY', false );	// don't force display_errors to on
	ini_set( 'display_errors', 0 ); 		// hide errors


	($_SERVER["REMOTE_ADDR"] == '127.0.0.1') ? define('LOCAL', TRUE) : define('LOCAL', FALSE);
	if ( LOCAL )
		define( 'ML_DEBUG', true );
	else
		define( 'ML_DEBUG', false );

*/

// require_once( STYLESHEETPATH . '/library/FirePHPCore/test.php' );
// require_once( STYLESHEETPATH . '/library/FirePHPCore/FirePHP.class.php' );
// require_once( STYLESHEETPATH . '/library/FirePHPCore/fb.php' );
// ob_start();

/**
 * Define current template file
 *
 * Create a global variable with the name of the current
 * theme template file being used.
 *
 * http://www.kevinleary.net/get-current-theme-template-filename-wordpress/
 *
 * @param $template The full path to the current template
 */
function define_current_template( $template ) {
    $GLOBALS['current_theme_template'] = basename($template);

    return $template;
}
add_action('template_include', 'define_current_template', 1000);

/**
 * Get Current Theme Template Filename
 *
 * Get's the name of the current theme template file being used
 *
 * http://www.kevinleary.net/get-current-theme-template-filename-wordpress/
 *
 * @global $current_theme_template Defined using define_current_template()
 * @param $echo Defines whether to return or print the template filename
 * @return The name of the template filename, including .php
 */
function get_current_template( $echo = false ) {
    if ( !isset( $GLOBALS['current_theme_template'] ) ) {
        trigger_error( '$current_theme_template has not been defined yet', E_USER_WARNING );
        return false;
    }
    if ( $echo ) {
        echo $GLOBALS['current_theme_template'];
    }
    else {
        return $GLOBALS['current_theme_template'];
    }
}

function ml_filename_comment() {

	$filename = get_current_template();
	echo "\n<!-- $filename -->\n\n";
	FB::log( $filename );

}
// add_action('genesis_title', 'ml_filename_comment', 1);
add_action('ml_debug', 'ml_filename_comment', 1);

// throw this in header.php under <title>
// do_action( 'ml_debug' );

function ml_query_debug() {

	if( !is_admin() ) {


		global $wp_query;
		// any output here is killing the page before wp_footer can fire
		// print "<!-- $wp_query -->";
		FB::log( $wp_query, 'Debug $wp_query' );

		// global $ml_filters;
		// FB::log( $ml_filters, 'Debug filters' );
	}
}
function ml_debug_hooks() {
	global $ml_filters;
	$ml_filters[] = 'another';//current_filter();
}
// $ml_filters = array();

/*
 * 	http://nacin.com/2010/04/23/5-ways-to-debug-wordpress/
 * 	Despite it being an information overload, I do use it from time to time. I usually write it to avoid printing filters with ‘gettext’ in the name, though.
*/
// if( WP_DEBUG ) add_action( 'all', ml_debug_hooks() );
if( WP_DEBUG ) add_action('wp_footer', 'ml_query_debug', 100 );


// Toggle display of genesis hooks
// http://www.wpsmith.net/genesis-hooks
function ml_show_hooks() {

	if( is_admin() ) return;

	if( !function_exists( 'gh_activation_check' ) ) return;

	print (
		"<script>
		(function(){
			jQuery( 'span.genesis_hook').css( 'display', 'none' );
			jQuery( '.boxfloat p' ).click( function(e) {

				// toggle visibilty
				jQuery( 'span.genesis_hook').toggle();

				// don't follow this link
				e.preventDefault();
			});
		})();
		</script>
		"
	);
}
add_action( 'wp_footer', 'ml_show_hooks', 15 );





// http://digwp.com/2009/08/awesome-image-attachment-recipes-for-wordpress/#dynamic-post-id
function attachment_toolbox( $size = thumbnail ) {

	if($images = get_children(array(
		'post_parent'    => get_the_ID(),
		'post_type'      => 'attachment',
		'numberposts'    => -1, // show all
		'post_status'    => null,
		'post_mime_type' => 'image',
	))) {
		foreach($images as $image) {
			$attimg   = wp_get_attachment_image($image->ID,$size);
			$atturl   = wp_get_attachment_url($image->ID);
			$attlink  = get_attachment_link($image->ID);
			$postlink = get_permalink($image->post_parent);
			$atttitle = apply_filters('the_title',$image->post_title);

			echo '<p><strong>wp_get_attachment_image()</strong><br />'.$attimg.'</p>';
			echo '<p><strong>wp_get_attachment_url()</strong><br />'.$atturl.'</p>';
			echo '<p><strong>get_attachment_link()</strong><br />'.$attlink.'</p>';
			echo '<p><strong>get_permalink()</strong><br />'.$postlink.'</p>';
			echo '<p><strong>Title of attachment</strong><br />'.$atttitle.'</p>';
			echo '<p><strong>Image link to attachment page</strong><br /><a href="'.$attlink.'">'.$attimg.'</a></p>';
			echo '<p><strong>Image link to attachment post</strong><br /><a href="'.$postlink.'">'.$attimg.'</a></p>';
			echo '<p><strong>Image link to attachment file</strong><br /><a href="'.$atturl.'">'.$attimg.'</a></p>';
		}
	}
}

// add_action( 'wp_footer', 'ml_show_image_sizes' );
function ml_show_image_sizes() {
	global $_wp_additional_image_sizes;
	FB::log( $_wp_additional_image_sizes, "_wp_additional_image_sizes" );

}

// http://www.rarst.net/script/debug-wordpress-hooks/
// https://gist.github.com/1739714
// include( STYLESHEETPATH . '/library/rarst-debug.php' );
// FB::log( R_Debug::list_constants(), 'R_Debug::list_constants()' );
// FB::log( R_Debug::list_plugins(), 'R_Debug::list_plugins()' );
// FB::log( R_Debug::list_queries(), 'R_Debug::list_queries()' );



