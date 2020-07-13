<?php
/**
 * Plugin Name:	quoll_img_lazy_loading_plus
 * Plugin URI:	https://github.com/eniocarboni/quoll_img_lazy_loading_plus
 * Description:	Make image loading lazy using javascript so that it will be loaded when they have to be visible for the first time.
 * Version:	0.1.0
 * Author:	Enio Carboni
 * Author URI:	https://quoll.it
 * Licenze:	GPL v3 or later
 * License URI:	https://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain:	quoll_img_lazy_loading_plus
 * Domain Path:	/languages

quoll_img_lazy_loading_plus is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.
 
quoll_img_lazy_loading_plus is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
 
You should have received a copy of the GNU General Public License
along with quoll_img_lazy_loading_plus. If not, see https://www.gnu.org/licenses/gpl-3.0.html.
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// Currently plugin version.
define( 'QUOLL_IMG_LAZY_LOADING_VERSION', '0.1.0' );

function quoll_img_lazy_loading_plus_filter_the_content( $content ) {
    // Check if we're inside the main loop in a post or page.
    if ( ( is_single() || is_page() ) && in_the_loop() && is_main_query() ) {
	$gif1x1='data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==';
	// remove loading tag in img if exist
	$content=preg_replace('/<img\s+([^>]*?)loading="[^"]*"\s*/',"<img $1",$content);
	// add loading="lazy" in img elements
	return preg_replace('/<img\s+([^>]*?)src="([^"]*)"\s*/',"<img $1 src=\"$gif1x1\" data-quoll-src=\"$2\" ",$content);
    }
    return $content;
}
add_filter( 'the_content', 'quoll_img_lazy_loading_plus_filter_the_content', 101 );
wp_enqueue_script('quoll_img_lazy_loading_plus',plugin_dir_url( __FILE__ ) . 'js/quoll_img_lazy_loading_plus.js',array( 'jquery' ),QUOLL_IMG_LAZY_LOADING_VERSION, false);
