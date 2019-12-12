<?php
/**
 * Plugin Name: Interactive Banner  
 * Description: Elementor interactive banner widget.
 * Plugin URI:  https://elementor.com/
 * Version:     2.7.0
 * Author:      Pratiksha S
 * Author URI:  https://elementor.com/
 * Text Domain: uael_interactive_banner
 */

if ( ! defined( 'ABSPATH' ) ) exit; 

final class uael_ibanner_class {

	const VERSION = '2.5.0';
	const MINIMUM_ELEMENTOR_VERSION = '2.7.0';
	const MINIMUM_PHP_VERSION = '7.0';

	public function __construct() {
		add_action( 'init', array( $this, 'i18n' ) );
		add_action( 'plugins_loaded', array( $this, 'init' ) );
	}

	public function i18n() {
		load_plugin_textdomain( 'uael_interactive_banner' );
	}

	public function init() {
		if ( ! did_action( 'elementor/loaded' ) ) { //elementor installed & activated
			add_action( 'admin_notices', array( $this, 'admin_notice_missing_main_plugin' ) );
			
			return;
		}

		//elementor version
		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', array( $this, 'admin_notice_minimum_elementor_version' ) );
			return;
		}

		//php version
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', array( $this, 'admin_notice_minimum_php_version' ) );
			return;
		}
		require_once( 'plugin.php' );
	}

	public function admin_notice_missing_main_plugin() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'uael_interactive_banner' ),
			'<strong>' . esc_html__( 'Elementor Hello World', 'uael_interactive_banner' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'uael_interactive_banner' ) . '</strong>'
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}

	public function admin_notice_minimum_elementor_version() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'uael_interactive_banner' ),
			'<strong>' . esc_html__( 'Elementor Hello World', 'uael_interactive_banner' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'uael_interactive_banner' ) . '</strong>',
			self::MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}

	public function admin_notice_minimum_php_version() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'uael_interactive_banner' ),
			'<strong>' . esc_html__( 'Elementor Hello World', 'uael_interactive_banner' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'uael_interactive_banner' ) . '</strong>',
			self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}
}
new uael_ibanner_class();