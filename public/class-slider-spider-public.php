<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       blog.unreleasedme.com
 * @since      1.0.0
 *
 * @package    Slider_Spider
 * @subpackage Slider_Spider/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Slider_Spider
 * @subpackage Slider_Spider/public
 * @author     unreleased <shakil147258@gmail.com>
 */
if ( !defined( 'ABSPATH' ) ) exit;

class Slider_Spider_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Slider_Spider_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Slider_Spider_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		//wp_enqueue_style( 'bootstrap.min.css', plugin_dir_url( __FILE__ ) . '../admin/css/bootstrap.min.css' );
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/slider-spider-public.css', array(), $this->version, 'all' );
		wp_enqueue_style( 'swiper.min.css.file', plugin_dir_url( __FILE__ ) . 'css/swiper.min.css', array(), $this->version, 'all' );
		//wp_enqueue_style( 'custom.css', plugin_dir_url( __FILE__ ) . 'css/custom.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Slider_Spider_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Slider_Spider_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/slider-spider-public.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( 'swiper.min.js.file', plugin_dir_url( __FILE__ ) . 'js/swiper.min.js' );				
		wp_enqueue_script('jquery');
		//wp_enqueue_script( 'popper.min.js', plugin_dir_url( __FILE__ ) . '../admin/js/popper.min.js');
		//wp_enqueue_script( 'bootstrap.min.js', plugin_dir_url( __FILE__ ) . '../admin/js/bootstrap.min.js');
		
		//DO NOT USE CDN WHILE PLUGIN DEVELOPMENT
		//wp_enqueue_script( 'jquery_cdn', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js');
		//wp_enqueue_script( 'idangero_cdn', 'http://idangero.us/swiper/dist/js/swiper.min.js');

	}

}
