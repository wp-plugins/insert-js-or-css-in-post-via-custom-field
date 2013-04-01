<?php

/*
  Plugin Name: Insert JS or CSS in post via Custom Field
  Description: This plugin will insert JS or CSS files added via Custom Fields into a particular posts or page
  Author: Fedmich
  Author URI: http://fedche.com
  Version: 0.1
 */

//define("INSERT_JS_CSS", "0.1");

function insert_js_css_fed() {
	if (is_single() or is_page()) {
		global $post;
		$post_id = $post->ID;
		$pcontent = $post->post_content;
		$use_img = 0;
		$file_js = get_post_meta($post_id, 'js', true);
		if ($file_js) {
			$header_items[] = '<script type="text/javascript" src="' . $file_js . '"></script>';
		}
		$file_css = get_post_meta($post_id, 'css', true);
		if ($file_css) {
			$header_items[] = '<link href="' . $file_css . '" rel="stylesheet" type="text/css" media="all" />';
		}

		if (!empty($header_items)) {
			array_unshift($header_items, '<!-- insert JS & CSS by Fedmich -->');
			$header_items[] = '<!-- /insert JS & CSS by Fedmich -->';

			$return_code = implode("\n", $header_items);
			echo $return_code . "\n";
		}
	}
}

add_action('wp_head', 'insert_js_css_fed');
