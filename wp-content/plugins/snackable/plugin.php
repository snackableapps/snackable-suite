<?php
/**
 * Plugin Name: Snackable Suite
 * Plugin URI: https://github.com/snackableapps
 * Description:  Snackable Suite
 * Author: mrahmadawais, maedahbatool
 * Author URI: https://snackable.app
 * Version: 1.0.0
 * License: GPL2+
 * License URI: https://www.gnu.org/licenses/gpl-2.0.txt
 *
 * @package snackable
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Block Initializer.
 */
require_once plugin_dir_path( __FILE__ ) . 'src/init.php';
