<?php
/**
 * Plugin Name: Twitterfontana Widget
 * Plugin URI: http://www.twitterfontana.com
 * Description: Beautiful, customizable tweet visualizations for your blog
 * Author: Eight Media / Salmon Tetelepta
 * Version: 1.0
 * Author URI: http://www.eight.nl
 * License: GPLv2 or later
 */

/**
 * = 1.0 beta =
 * First release
 */

/*

Copyright (C) 2012 Salmon Tetelepta, Eight Media

This program is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation; either version 3 of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with this program; if not, see <http://www.gnu.org/licenses>.

*/

define('TWITTERFONTANA_VERSION', '1.0');
define('TWITTERFONTANA_PLUGINBASENAME', dirname(plugin_basename(__FILE__)));
define('TWITTERFONTANA_PLUGINPATH', PLUGINDIR . '/' . TWITTERFONTANA_PLUGINBASENAME);

class Twitterfontana_Widget extends WP_Widget {

	function Twitterfontana_Widget() {
	
		if(function_exists('load_plugin_textdomain')) {
			load_plugin_textdomain('twitterfontana', TWITTERFONTANA_PLUGINPATH . '/languages', TWITTERFONTANA_PLUGINBASENAME . '/languages');
		}

		$widget_ops = array(
			'classname' => 'Twitterfontana_Widget',
			'description' => __('Clean customizable tweet visualizations for your blog', 'twitterfontana')
		);

		$control_ops = array();
		
		$this->WP_Widget('Twitterfontana_Widget', __('Twitter Fontana', 'twitterfontana'), $widget_ops, $control_ops);
	}

	function form($instance) {
	
		$instance = wp_parse_args((array) $instance, array(
			'twitterfontana_title' => 'Twitter Fontana',
			'twitterfontana_twittersearch' => 'twitterfontana',
			'twitterfontana_message_animate_interval' => 6000,
			'twitterfontana_effect' => 'Slide',
			'twitterfontana_custom_css' => '',
			'twitterfontana_font_face' => 'Arial, sans-serif',
			'twitterfontana_text_color' => '#ffffff',
			'twitterfontana_special_color' => '#aaea71',
			'twitterfontana_bg_color' => '#482b73',
			'twitterfontana_bg_image' => '',
			'twitterfontana_box_bg' => '#80b43c'
		));
		
		$tf_animation_effects = array(
			'Slide' => 'Slide',
			'Fade' => 'Fade',
			'Zoom' => 'Zoom'
		);
		
		$tf_font_faces = array(
			'Arial, sans-serif' => 'Arial',
			'Verdana, sans-serif' => 'Verdana',
			'Helvetica, Arial, sans-serif' => 'Helvetica',
			'Open Sans, sans-serif' => 'Open Sans',
			'Exo, sans-serif' => 'Exo',
			'Imprima, sans-serif' => 'Imprima',
			'Handlee, cursive' => 'Handlee',
			'Crete Round, serif' => 'Crete Round',
			'Enriqueta, serif' => 'Enriqueta'
		);
		
		// Version of the plugin (hidden field)
		$tfoutput  = '<input id="' . $this->get_field_id('plugin-version') . '" name="' . $this->get_field_name('plugin-version') . '" type="hidden" value="' . TWITTERFONTANA_VERSION . '" />';

		// Title
		$tfoutput .= '
			<p style="border-bottom: 1px solid #DFDFDF;">
				<label for="' . $this->get_field_id('twitterfontana_title') . '"><strong>' . __('Title', 'twitterfontana') . '</strong></label>
			</p>
			<p>
				<input id="' . $this->get_field_id('twitterfontana_title') . '" name="' . $this->get_field_name('twitterfontana_title') . '" type="text" value="' . $instance['twitterfontana_title'] . '" />
			</p>
		';

		// Settings
		$tfoutput .= '
			<p style="border-bottom: 1px solid #DFDFDF;"><strong>' . __('Customize your stream', 'twitterfontana') . '</strong></p>

			<p>
				<label>' . __('Your Twitter search', 'twitterfontana') . '<br />
				<input id="' . $this->get_field_id('twitterfontana_twittersearch') . '" name="' . $this->get_field_name('twitterfontana_twittersearch') . '" type="text" value="' . $instance['twitterfontana_twittersearch'] . '" /> <abbr title="' . __('Enter your twitter search', 'twitterfontana') . '">(?)</abbr></label>
			</p>
			
			<p>
				<label>' . __('Show messages for # ms', 'twitterfontana') . '<br />
				<input id="' . $this->get_field_id('twitterfontana_message_animate_interval') . '" name="' . $this->get_field_name('twitterfontana_message_animate_interval') . '" type="text" value="' . $instance['twitterfontana_message_animate_interval'] . '" /> <abbr title="' . __('Show messages for # ms', 'twitterfontana') . '">(?)</abbr></label>
			</p>
		';
		
		// Animation effects
		$tfoutput .= '
			<p>
				<label>' . __('Transition effect', 'twitterfontana') . '<br />
				<select id="' . $this->get_field_id('twitterfontana_effect') . '" name="' . $this->get_field_name('twitterfontana_effect') . '">
		';
		foreach($tf_animation_effects as $key => $value) {
			if ( $instance['twitterfontana_effect'] == $key ) {
				$tf_effect_selected = ' selected';
			} else {
				$tf_effect_selected = '';
			}
			$tfoutput .= '<option value="'. $key. '"' . $tf_effect_selected . '>'. $value .'</option>';
		}
		$tfoutput .= '
				</select><abbr title="' . __('Transition effect', 'twitterfontana') . '">(?)</abbr></label>
			</p>
		';

		// Custom stylesheet
		$tfoutput .= '
			<p>
				<label>' . __('Custom stylesheet', 'twitterfontana') . '<br />
				<input id="' . $this->get_field_id('twitterfontana_custom_css') . '" name="' . $this->get_field_name('twitterfontana_custom_css') . '" type="text" value="' . $instance['twitterfontana_custom_css'] . '" /> <abbr title="' . __('Custom stylesheet', 'twitterfontana') . '">(?)</abbr></label>
			</p>
		';
		
		// Font face
		$tfoutput .= '
			<p>
				<label>' . __('Message font', 'twitterfontana') . '<br />
				<select id="' . $this->get_field_id('twitterfontana_font_face') . '" name="' . $this->get_field_name('twitterfontana_font_face') . '">
		';
		foreach($tf_font_faces as $key => $value) {
			if ( $instance['twitterfontana_font_face'] == $key ) {
				$tf_effect_selected = ' selected';
			} else {
				$tf_effect_selected = '';
			}
			$tfoutput .= '<option value="'. $key. '"' . $tf_effect_selected . '>'. $value .'</option>';
		}
		$tfoutput .= '
				</select><abbr title="' . __('Message font', 'twitterfontana') . '">(?)</abbr></label>
			</p>
		';
		
		
		// Message font color
		$tfoutput .= '
			<p>
				<label>' . __('Message font color', 'twitterfontana') . '<br />
				<input id="' . $this->get_field_id('twitterfontana_text_color') . '" name="' . $this->get_field_name('twitterfontana_text_color') . '" type="text" value="' . $instance['twitterfontana_text_color'] . '" /> <abbr title="' . __('Message font color', 'twitterfontana') . '">(?)</abbr></label>
			</p>
		';
		
		// #hashtag/@username color
		$tfoutput .= '
			<p>
				<label>' . __('#hashtag/@username color', 'twitterfontana') . '<br />
				<input id="' . $this->get_field_id('twitterfontana_special_color') . '" name="' . $this->get_field_name('twitterfontana_special_color') . '" type="text" value="' . $instance['twitterfontana_special_color'] . '" /> <abbr title="' . __('#hashtag/@username color', 'twitterfontana') . '">(?)</abbr></label>
			</p>
		';
		
		// Background color
		$tfoutput .= '
			<p>
				<label>' . __('Background color', 'twitterfontana') . '<br />
				<input id="' . $this->get_field_id('twitterfontana_bg_color') . '" name="' . $this->get_field_name('twitterfontana_bg_color') . '" type="text" value="' . $instance['twitterfontana_bg_color'] . '" /> <abbr title="' . __('Background color', 'twitterfontana') . '">(?)</abbr></label>
			</p>
		';
		
		// Background image url
		$tfoutput .= '
			<p>
				<label>' . __('Background image url', 'twitterfontana') . '<br />
				<input id="' . $this->get_field_id('twitterfontana_bg_image') . '" name="' . $this->get_field_name('twitterfontana_bg_image') . '" type="text" value="' . $instance['twitterfontana_bg_image'] . '" /> <abbr title="' . __('Background image url', 'twitterfontana') . '">(?)</abbr></label>
			</p>
		';

		// Message color
		$tfoutput .= '
			<p>
				<label>' . __('Message color', 'twitterfontana') . '<br />
				<input id="' . $this->get_field_id('twitterfontana_box_bg') . '" name="' . $this->get_field_name('twitterfontana_box_bg') . '" type="text" value="' . $instance['twitterfontana_box_bg'] . '" /> <abbr title="' . __('Message color', 'twitterfontana') . '">(?)</abbr></label>
			</p>
		';

		echo $tfoutput;
	}

	function update($new_instance, $old_instance) {
		
		$instance = $old_instance;

		$new_instance = wp_parse_args((array) $new_instance, array(
			'twitterfontana_title' => '',
			'twitterfontana_twittersearch' => '',
			'twitterfontana_message_animate_interval' => 6000,
			'twitterfontana_effect' => 'Slide',
			'twitterfontana_custom_css' => '',
			'twitterfontana_font_face' => 'Arial, sans-serif',
			'twitterfontana_text_color' => '#ffffff',
			'twitterfontana_special_color' => '#aaea71',
			'twitterfontana_bg_color' => '#482b73',
			'twitterfontana_bg_image' => '',
			'twitterfontana_box_bg' => '#80b43c'
			
		));

		$instance['plugin-version'] = strip_tags($new_instance['twitterfontain-version']);
		$instance['twitterfontana_title'] = strip_tags($new_instance['twitterfontana_title']);
		$instance['twitterfontana_twittersearch'] = strip_tags($new_instance['twitterfontana_twittersearch']);
		$instance['twitterfontana_message_animate_interval'] = strip_tags($new_instance['twitterfontana_message_animate_interval']);
		$instance['twitterfontana_effect'] = strip_tags($new_instance['twitterfontana_effect']);
		$instance['twitterfontana_custom_css'] = strip_tags($new_instance['twitterfontana_custom_css']);
		$instance['twitterfontana_font_face'] = strip_tags($new_instance['twitterfontana_font_face']);
		$instance['twitterfontana_text_color'] = strip_tags($new_instance['twitterfontana_text_color']);
		$instance['twitterfontana_special_color'] = strip_tags($new_instance['twitterfontana_special_color']);
		$instance['twitterfontana_bg_color'] = strip_tags($new_instance['twitterfontana_bg_color']);
		$instance['twitterfontana_bg_image'] = strip_tags($new_instance['twitterfontana_bg_image']);
		$instance['twitterfontana_box_bg'] = strip_tags($new_instance['twitterfontana_box_bg']);
		
		return $instance;
	}

	function widget($args, $instance) {
		extract($args);

		echo $before_widget;

		$title = (empty($instance['twitterfontana_title'])) ? '' : apply_filters('widget_title', $instance['twitterfontana_title']);

		if(!empty($title)) {
			echo $before_title . $title . $after_title;
		}

		echo $this->twitterfontana_output($instance, 'widget');
		echo $after_widget;
	}

	function twitterfontana_output($args = array(), $position) {
		echo '<iframe src="http://twitterfontana.com/fountain.html?embed=true&twitter_search=' . $args['twitterfontana_twittersearch'] . '&effect=' . $args['twitterfontana_effect'] . '&message_animate_interval=' . $args['twitterfontana_message_animate_interval'] . '&custom_css=' . $args['twitterfontana_custom_css'] . '&font_face=' . $args['twitterfontana_font_face']. '&text_color=' . urlencode($args['twitterfontana_text_color']) . '&special_color=' . urlencode($args['twitterfontana_special_color']) . '&bg_color=' . urlencode($args['twitterfontana_bg_color']) . '&bg_image=' . $args['twitterfontana_bg_image']. '&box_bg=' . urlencode($args['twitterfontana_box_bg']) . '" frameborder="0" width="100%" height="300" scrolling="no"></iframe>';

	} // end of output
	
} // end of Widget extend

add_action('widgets_init', create_function('', 'return register_widget("Twitterfontana_Widget");'));

/**
 * Custom footer and scripts
 */
 if(!is_admin()) {
	if ( !function_exists('twitterfontana_scripts')) {
		function twitterfontana_scripts() {
			
			$array_widgetOptions = get_option('widget_Twitterfontana_Widget');
			
			if(is_array($array_widgetOptions)) {
				wp_enqueue_script(
					array('jquery'),
					TWITTERFONTANA_VERSION
				);
			}
		}
	}
 
	// custom footer
	add_action('wp_enqueue_scripts', 'twitterfontana_scripts');

	/*
	 * Add shortcode
	 */
	if ( !function_exists('twitterfontana_shortcode')) {
		function twitterfontana_shortcode($atts) {

			global $wp_widget_factory;
			
			extract(shortcode_atts(array(
				'twittersearch' => 'twitterfontana',
				'message_animate_interval' => 6000,
				'effect' => 'Slide',
				'custom_css' => '',
				'font_face' => 'Arial, sans-serif',
				'text_color' => '#ffffff',
				'special_color' => '#aaea71',
				'bg_color' => '#482b73',
				'bg_image' => '',
				'box_bg' => '#80b43c'
			), $atts));
			
			$instance['twitterfontana_twittersearch'] = wp_specialchars($twittersearch);
			$instance['twitterfontana_message_animate_interval'] = wp_specialchars($message_animate_interval);
			$instance['twitterfontana_effect'] = wp_specialchars($effect);
			$instance['twitterfontana_custom_css'] = wp_specialchars($custom_css);
			$instance['twitterfontana_font_face'] = wp_specialchars($font_face);
			$instance['twitterfontana_text_color'] = wp_specialchars($text_color);
			$instance['twitterfontana_special_color'] = wp_specialchars($special_color);
			$instance['twitterfontana_bg_color'] = wp_specialchars($bg_color);
			$instance['twitterfontana_bg_image'] = wp_specialchars($bg_image);
			$instance['twitterfontana_box_bg'] = wp_specialchars($box_bg);
			
			$widget_name = "Twitterfontana_Widget";

			if (!is_a($wp_widget_factory->widgets[$widget_name], 'WP_Widget')):
				$wp_class = 'WP_Widget_'.ucwords(strtolower($class));

				if (!is_a($wp_widget_factory->widgets[$wp_class], 'WP_Widget')):
					return '<p>'.sprintf(__("%s: Widget class not found.", "twitterfontana"),'<strong>'.$class.'</strong>').'</p>';
				else:
					$class = $wp_class;
				endif;
			endif;

			ob_start();
			the_widget($widget_name, $instance, array('widget_id'=>'arbitrary-instance-'.$id,
				'before_widget' => '',
				'after_widget' => '',
				'before_title' => '',
				'after_title' => ''
			));
			$output = ob_get_contents();
			ob_end_clean();
			return $output;
		}
	}
	add_shortcode('twitterfontana','twitterfontana_shortcode');
}
?>