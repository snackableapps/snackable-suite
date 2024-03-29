<?php
/**
 * Blocks Initializer
 *
 * Enqueue CSS/JS of all the blocks.
 *
 * @since   1.0.0
 * @package snackable
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Enqueue Gutenberg block assets for both frontend + backend.
 *
 * @uses {wp-editor} for WP editor styles.
 * @since 1.0.0
 */
function snackable_block_assets() { // phpcs:ignore
	// Styles.
	wp_enqueue_style(
		'snackable-style-css', // Handle.
		plugins_url( 'dist/blocks.style.build.css', dirname( __FILE__ ) ), // Block style CSS.
		array( 'wp-editor' ) // Dependency to include the CSS after it.
		// filemtime( plugin_dir_path( __DIR__ ) . 'dist/blocks.style.build.css' ) // Version: File modification time.
	);
}

// Hook: Frontend assets.
add_action( 'enqueue_block_assets', 'snackable_block_assets' );

/**
 * Enqueue Gutenberg block assets for backend editor.
 *
 * @uses {wp-blocks} for block type registration & related functions.
 * @uses {wp-element} for WP Element abstraction — structure of blocks.
 * @uses {wp-i18n} to internationalize the block's text.
 * @uses {wp-editor} for WP editor styles.
 * @since 1.0.0
 */
function snackable_editor_assets() { // phpcs:ignore
	// Scripts.
	wp_enqueue_script(
		'snackable-block-js', // Handle.
		plugins_url( '/dist/blocks.build.js', dirname( __FILE__ ) ), // Block.build.js: We register the block here. Built with Webpack.
		array( 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor' ), // Dependencies, defined above.
		// filemtime( plugin_dir_path( __DIR__ ) . 'dist/blocks.build.js' ), // Version: File modification time.
		true // Enqueue the script in the footer.
	);

	// Styles.
	wp_enqueue_style(
		'snackable-block-editor-css', // Handle.
		plugins_url( 'dist/blocks.editor.build.css', dirname( __FILE__ ) ), // Block editor CSS.
		array( 'wp-edit-blocks' ) // Dependency to include the CSS after it.
		// filemtime( plugin_dir_path( __DIR__ ) . 'dist/blocks.editor.build.css' ) // Version: File modification time.
	);
}

// Hook: Editor assets.
add_action( 'enqueue_block_editor_assets', 'snackable_editor_assets' );



/*
Plugin Name: Sidebar plugin
*/

function sidebar_plugin_register() {
    wp_register_script(
        'snackable-sidebar-js',
		plugins_url( '/dist/sidebar.build.js', dirname( __FILE__ ) ), // Block.build.js: We register the block here. Built with Webpack.
        array( 'wp-plugins', 'wp-edit-post', 'wp-element' )
    );
}
add_action( 'init', 'sidebar_plugin_register' );

function sidebar_plugin_script_enqueue() {
    wp_enqueue_script('snackable-sidebar-js' );
}
add_action( 'enqueue_block_editor_assets', 'sidebar_plugin_script_enqueue' );

// Chop up Gutenberg blocks
add_action(
	'rest_api_init',
	function () {

		if ( ! function_exists( 'use_block_editor_for_post_type' ) ) {
			require ABSPATH . 'wp-admin/includes/post.php';
		}

		// Surface all Gutenberg blocks in the WordPress REST API
		$post_types = get_post_types_by_support( [ 'editor' ] );
		foreach ( $post_types as $post_type ) {
			if ( use_block_editor_for_post_type( $post_type ) ) {
				register_rest_field(
					$post_type,
					'blocks',
					[
						'get_callback' => function ( array $post ) {
							return parse_blocks( $post['content']['raw'] );
						},
					]
				);
			}
		}
	}
);

// Add quiz custom post type
add_action( 'init', function () {
 
	$labels = array(
		'name' => 'Snackable Quizes',
		'signular_name' => 'Snackable Quiz'
	);
 
	$args = array(
		'labels'             => $labels,
		'description'        => __( 'Snackable Quiz', 'A post type representing a personality quiz' ),
		'public'             => true,		
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments',  'custom-fields' ),
		'show_in_rest'       => true,
	);
 
	register_post_type( 'snackable_quiz', $args );

	register_meta( 'post', 'snackable_quiz_topics', array(
		'show_in_rest' => true,
		'single' => true,
		'type' => 'string',
	) );
	
} );
