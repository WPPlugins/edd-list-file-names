<?php
/*
Plugin Name: Easy Digital Downloads - List File Names
Plugin URI: http://sumobi.com/shop/edd-list-file-names/
Description: Show a download's file names in a simple list
Version: 1.0.1
Author: Andrew Munro, Sumobi
Author URI: http://sumobi.com/
License: GPL-2.0+
License URI: http://www.opensource.org/licenses/gpl-license.php
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'EDD_List_File_Names' ) ) :

	final class EDD_List_File_Names {

		/**
		 * Holds the instance
		 *
		 * Ensures that only one instance exists in memory at any one
		 * time and it also prevents needing to define globals all over the place.
		 *
		 * TL;DR This is a static property property that holds the singleton instance.
		 *
		 * @var object
		 * @static
		 * @since 1.0
		 */
		private static $instance;

		/**
		 * Main Instance
		 *
		 * Ensures that only one instance exists in memory at any one
		 * time. Also prevents needing to define globals all over the place.
		 *
		 * @since 1.0
		 *
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) && ! ( self::$instance instanceof EDD_List_File_Names ) ) {
				self::$instance = new EDD_List_File_Names;
				self::$instance->hooks();
			}

			return self::$instance;
		}

		/**
		 * Constructor Function
		 *
		 * @since 1.0
		 * @access private
		 */
		private function __construct() {
			self::$instance = $this;
		}

		/**
		 * Setup the default hooks and actions
		 *
		 * @since 1.0
		 *
		 * @return void
		 */
		private function hooks() {
			add_shortcode( 'edd_file_names', array( $this, 'shortcode' ) );
		}

		/**
		 * Get file names
		 *
		 * @since 1.0
		*/
		public function get_file_names( $id, $title = '' ) {

			if ( $id ) {
				$id = $id;
			}
			elseif ( is_singular( 'download' ) ) {
				$id = get_the_ID();
			}
			else {
				$id = '';
			}

			if ( ! $id )
				return;

			$download_files = edd_get_download_files( $id );

			ob_start(); ?>

			<?php if ( $download_files && is_array( $download_files ) ) : ?>

				<?php if ( $title ) : ?>
					<h2><?php echo $title; ?></h2>
				<?php endif; ?>

				<ol class="edd-file-names">
				<?php foreach ( $download_files as $file ) : ?>
					<li><?php echo $file['name']; ?></li>
				<?php endforeach; ?>
				</ol>
			
			<?php endif; ?>

			<?php
			$html = ob_get_clean();
			return apply_filters( 'edd_list_file_names', $html, $title, $download_files );
		}

		/**
		 * Shortcode
		*/
		public function shortcode( $atts, $content = null ) {
			extract( shortcode_atts( array(
					'id' => '',
					'title' => '',
				), $atts, 'edd_file_names' )
			);

			$content = $this->get_file_names( $id, $title );

			return $content;
		}
		
	}

/**
 * Loads a single instance of EDD_List_File_Names
 * 
 * @since 1.0
 * @return object Returns an instance of the class
 */
function edd_lfn_load() {
	return EDD_List_File_Names::get_instance();
}

/**
 * Loads plugin after all the others have loaded and have registered their hooks and filters
 *
 * @since 1.0
*/
add_action( 'plugins_loaded', 'edd_lfn_load', apply_filters( 'edd_lfn_action_priority', 10 ) );

endif;