<?php
/*
Plugin Name: Resize RSS Images
Plugin URI: http://wpalchemists.com
Description: Adds HTML to make images smaller in RSS feeds  
Version: 1.1
Author: Jonathan Kay and Morgan Kay
Author URI: http://wpalchemists.com
License:           GPL-2.0+
License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
*/


add_action('admin_menu', 'wpa_resize_admin_menu');
function wpa_resize_admin_menu()
{
    add_options_page('RSS Image Resize', 'RSS Image Resize', 'manage_options', 'rss-image-resize/options.php');
}



function wpa_resize_image($matches){

	$options = get_option('rss-image-resize');

	if($options['width']) {
		$width = $options['width'];
	} else {
		$width = '500';
	}

	if (preg_match('/width=(["\'])(.+?)\1/i', $matches[0], $classdata)){
		if ($classdata[2] > $width){
			$result = str_replace($classdata[0], 'width="'.$width.'"', $matches[0]);
			if (preg_match('/height=(["\'])(.+?)\1/i', $result, $classdata)){
				$result = str_replace($classdata[0], "", $result);
			}
		}
		else {
			$result = $matches[0];
		}
	}

	return $result;
}

function wpa_resize_feed_images($content){
	if ( is_feed() ) {
		$content = preg_replace_callback('/<(img).*?>/i', 'wpa_resize_image', $content);
	}
	return $content;
}
add_filter('the_content','wpa_resize_feed_images');

?>