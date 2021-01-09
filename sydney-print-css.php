<?php

/**
 * Sydney Print CSS
 *
 * @package     Sydney Print CSS
 * @author      kharisblank
 * @copyright   2020 kharisblank
 * @license     GPL-2.0+
 *
 * @sy-print-css
 * Plugin Name: Sydney Print CSS
 * Plugin URI:  https://easyfixwp.com/
 * Description: This plugin fixes messed header links when printing Sydney pages. No settings required. Just activate the plugin.
 * Version:     0.0.6
 * Author:      kharisblank
 * Author URI:  https://easyfixwp.com
 * Text Domain: sy-print-css
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 *
 */

// Disallow direct access to file
defined( 'ABSPATH' ) or die( __('Not Authorized!', 'sy-print-css') );

define( 'SY_PRINT_CSS_FILE', __FILE__ );
define( 'SY_PRINT_CSS_URL', plugins_url( null, SY_PRINT_CSS_FILE ) );

if ( !class_exists('SY_Print_CSS') ) :
  class SY_Print_CSS {

    public function __construct() {

      add_action( 'wp_enqueue_scripts', array($this, 'enqueue_scripts'), 9999 );

    }

    /**
     * Check whether Sydney theme is active or not
     * @return boolean true if either Sydney or Sydney Pro is active
     */
    function is_sydney_active() {

      $theme  = wp_get_theme();
      $parent = wp_get_theme()->parent();

      if ( ($theme != 'Sydney' ) && ($theme != 'Sydney Pro' ) && ($parent != 'Sydney') && ($parent != 'Sydney Pro') ) {
        return false;
      }

      return true;

    }

    /**
     * Enqueue plugin scripts
     * @return void
     */
    function enqueue_scripts() {

      if( !$this->is_sydney_active() ) {
        return;
      }

      $css_file = apply_filters('sy_print_css_file_url', SY_PRINT_CSS_URL . "/print.css");

      wp_register_style( 'sy-print-style', $css_file, array(), null, 'print' );

      wp_enqueue_style( 'sy-print-style' );

    }

  }
  new SY_Print_CSS();
endif;
