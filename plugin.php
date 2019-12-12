<?php 
namespace uael_ibanner;

class Plugin {

	private static $_instance = null;
	
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	private function include_widget_files() {
		require_once( __DIR__ . '/widgets/ibanner.php' );	
	}

	public function register_ibanner() {
		$this->include_widget_files();
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\uael_ibanner_class() );
	}
	public function include_ibanner_style() {
		wp_register_style( 'ibanner_style',plugins_url('\assets\css\ibanner.css',__FILE__), NULL, true );
		wp_enqueue_style('ibanner_style');
	}

	public function __construct() {		
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'register_ibanner' ] );
		add_action( 'elementor/frontend/after_enqueue_styles', [ $this, 'include_ibanner_style' ] );
	}
}
Plugin::instance();