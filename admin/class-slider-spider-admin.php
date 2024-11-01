<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       blog.unreleasedme.com
 * @since      1.0.0
 *
 * @package    Slider_Spider
 * @subpackage Slider_Spider/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Slider_Spider
 * @subpackage Slider_Spider/admin
 * @author     unreleased <shakil147258@gmail.com>
 */
if ( !defined( 'ABSPATH' ) ) exit;

class Slider_Spider_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		
		// Action to save config metabox value
		add_action( 'save_post', array($this, 'slider_spider_save_metabox_value') );

		// Action to save slider control metabox value
		add_action( 'save_post', array($this, 'slider_control_metabox_value') );

		//Add columns to all post (Admin Page)
		add_filter( 'manage_slider-spider_posts_columns', array($this, 'slider_spider_posts_columns') );
		
		//Add data to custom columns
		add_action('manage_slider-spider_posts_custom_column', array($this, 'slider_spider_post_column_data'), 10, 2);

		//Add menu for guide page
		add_action('admin_menu',array($this, 'slider_spider_guide') );

		//remove shortcode from post content
		add_filter( 'the_content', array($this, 'slider_spider_remove_shortcode_from_post') );
		
		//convert post image gallery to slider-spider
		add_filter( 'the_content', array($this, 'slider_spider_convert_image_gallery') );

	}

	/**
	 * Register the stylesheets for the admin area.
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
		//wp_enqueue_style( 'bootstrap.min.css', plugin_dir_url( __FILE__ ) . 'css/bootstrap.min.css' );


		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/slider-spider-admin.css', array(), $this->version, 'all' );

		wp_enqueue_style( "swiper.min.css", plugin_dir_url( __FILE__ ) . 'css/swiper.min.css', array(), $this->version, 'all' );

		wp_enqueue_style( "custom.css", plugin_dir_url( __FILE__ ) . 'css/custom.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
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

		//wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/slider-spider-admin.js', array( 'jquery' ), $this->version, false );

		/*swiper minified*/
		wp_enqueue_script( "swiper.min.js", plugin_dir_url( __FILE__ ) . 'js/swiper.min.js');

		wp_enqueue_script('jquery');
		//wp_enqueue_script('bootstrap');

		/*bootstrap popper minified*/
		//wp_enqueue_script( 'popper.min.js',  plugin_dir_url( __FILE__ ) . 'js/popper.min.js', array( 'jquery' ));
		
		/*bootstrap minified*/
		//wp_enqueue_script( 'bootstrap.min.js',  plugin_dir_url( __FILE__ ) . 'js/bootstrap.min.js', array( 'jquery' ));


	}

	public function slider_control_metabox_value( $post_id )
	{
		global $post_type;
		$registered_posts = array('post', 'page'); // Getting registered post types

		if ( ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )                	// Check Autosave
		|| ( ! isset( $_POST['post_ID'] ) || $post_id != $_POST['post_ID'] )  	// Check Revision
		|| ( !current_user_can('edit_post', $post_id) )              			// Check if user can edit the post.
		|| ( !in_array($post_type, $registered_posts) ) )             			// Check if user can edit the post.
		{
			return $post_id;
		}
		// Metabox prefix
		$prefix = 'slider_spider_'; 

		$slider_spider_enable_slider = isset($_POST[$prefix.'enable_slider']) ? esc_attr($_POST[$prefix.'enable_slider']): 'false';
		$slider_spider_switch = isset($_POST[$prefix.'switch']) ? esc_attr($_POST[$prefix.'switch']): 'true';

		update_post_meta($post_id, $prefix.'enable_slider', $slider_spider_enable_slider);
		update_post_meta($post_id, $prefix.'switch', $slider_spider_switch);

	}

	public function slider_spider_save_metabox_value( $post_id )
	{
		global $post_type;

		$registered_posts = array('slider-spider'); // Getting registered post types

		if ( ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )                	// Check Autosave
		|| ( ! isset( $_POST['post_ID'] ) || $post_id != $_POST['post_ID'] )  	// Check Revision
		|| ( !current_user_can('edit_post', $post_id) )              			// Check if user can edit the post.
		|| ( !in_array($post_type, $registered_posts) ) )             			// Check if user can edit the post.
		{
			return $post_id;
		}
		// Metabox prefix
		$prefix = 'slider_spider_'; 
		
		// Choosing Style
		$style = isset($_POST[$prefix.'design_style']) ? esc_attr($_POST[$prefix.'design_style']) : '';
		// Taking variables
		$gallery_imgs 	= isset($_POST['wp_igsp_img']) ? esc_attr($_POST['wp_igsp_img']) : '';		
		// Getting Slider Variables
		$arrow_slider 		  		= isset($_POST[$prefix.'arrow_slider']) 				? esc_attr($_POST[$prefix.'arrow_slider']) 				: '';
		$pagination_slider 			= isset($_POST[$prefix.'pagination_slider']) 			? esc_attr($_POST[$prefix.'pagination_slider']) 			: '';
		$autoplay_slider 			= isset($_POST[$prefix.'autoplay_slider']) 				? esc_attr($_POST[$prefix.'autoplay_slider']) 			: '';
		$autoplay_speed_slider 		= isset($_POST[$prefix.'autoplay_speed_slider']) 		? esc_attr($_POST[$prefix.'autoplay_speed_slider']) 		: '';
		$auto_stop_slider			= isset($_POST[$prefix.'auto_stop_slider']) 			? esc_attr($_POST[$prefix.'auto_stop_slider']) 			: '';
		$speed_slider 				= isset($_POST[$prefix.'speed_slider']) 				? esc_attr($_POST[$prefix.'speed_slider']) 				: '';
		$animation_slider 	  		= isset($_POST[$prefix.'animation_slider']) 			? esc_attr($_POST[$prefix.'animation_slider']) 			: '';
		$height_slider 	  			= isset($_POST[$prefix.'height_slider']) 				? esc_attr($_POST[$prefix.'height_slider']) 				: '';
		$autoheight_slider   		= isset($_POST[$prefix.'autoheight_slider']) 			? esc_attr($_POST[$prefix.'autoheight_slider']) 			: '';
		$direction_slider   		= isset($_POST[$prefix.'direction_slider']) 			? esc_attr($_POST[$prefix.'direction_slider']) 			: '';
		$pagination_type_slider 	= isset($_POST[$prefix.'pagination_type_slider']) 		? esc_attr($_POST[$prefix.'pagination_type_slider']) 	: '';
		$space_between_slider 		= isset($_POST[$prefix.'space_between_slider']) 		? esc_attr($_POST[$prefix.'space_between_slider']) 		: '';
		$loop_slider 				= isset($_POST[$prefix.'loop_slider']) 					? esc_attr($_POST[$prefix.'loop_slider']) 				: '';
		$mouse_wheel 				= isset($_POST[$prefix.'mouse_wheel']) 					? esc_attr($_POST[$prefix.'mouse_wheel']) 				: '';
		$img_height 				= isset($_POST[$prefix.'img_height']) 					? esc_attr($_POST[$prefix.'img_height']) 				: '';
		$img_width 				= isset($_POST[$prefix.'img_width']) 					? esc_attr($_POST[$prefix.'img_width']) 				: '';
		$disableOnInteraction   =  isset($_POST[$prefix.'disableOnInteraction']) 					? esc_attr($_POST[$prefix.'disableOnInteraction']) 				: 'false';

		// Style option update
		update_post_meta($post_id, $prefix.'design_style', $style);
		update_post_meta($post_id, $prefix.'gallery_id', $gallery_imgs);
		
		// Updating Slider settings
		update_post_meta($post_id, $prefix.'arrow_slider', $arrow_slider);
		update_post_meta($post_id, $prefix.'pagination_slider', $pagination_slider);
		update_post_meta($post_id, $prefix.'autoplay_slider', $autoplay_slider);
		update_post_meta($post_id, $prefix.'autoplay_speed_slider', $autoplay_speed_slider);
		update_post_meta($post_id, $prefix.'auto_stop_slider', $auto_stop_slider);
		update_post_meta($post_id, $prefix.'speed_slider', $speed_slider);
		update_post_meta($post_id, $prefix.'animation_slider', $animation_slider);
		update_post_meta($post_id, $prefix.'height_slider', $height_slider);
		update_post_meta($post_id, $prefix.'autoheight_slider', $autoheight_slider);
		update_post_meta($post_id, $prefix.'direction_slider', $direction_slider);
		update_post_meta($post_id, $prefix.'pagination_type_slider', $pagination_type_slider);
		update_post_meta($post_id, $prefix.'space_between_slider', $space_between_slider);
		update_post_meta($post_id, $prefix.'loop_slider', $loop_slider);
		update_post_meta($post_id, $prefix.'mouse_wheel', $mouse_wheel);
		update_post_meta($post_id, $prefix.'img_height', $img_height);
		update_post_meta($post_id, $prefix.'img_width', $img_width);
		update_post_meta($post_id, $prefix.'disableOnInteraction', $disableOnInteraction);

	}

	/**
	 * Add Short code, Image Count column to all post
	 * @param  array $columns store custom columns name
	 * @return array          custom column name
	 */
	public function slider_spider_posts_columns( $columns )
	{
		$columns['shortcode']= "Short code";
		$columns['num_of_img']= "Image Count";
		return $columns;
	}

	/**
	 * set custom column data (Slider Spider page)
	 * @param  array $column  column names
	 * @param  int $post_id custom post id
	 * @return [type]          custom column view style
	 */
	public function slider_spider_post_column_data( $column, $post_id )
	{
		global $post;

		// meta key prefix
		$prefix = 'slider_spider_';
		
		//design style
		$slider_style 	= get_post_meta( $post->ID, $prefix.'design_style', true );
		
		switch ($column) {
			case 'shortcode':
			if ($slider_style == 'slider') {	
				echo '<div class="wp-igsp-shortcode-preview">[slider_spider id="'.$post_id.'"]</div>';
			} else {
				echo '<div class="wp-igsp-shortcode-preview">[slider_spider id="'.$post_id.'"]</div>';
			}
			break;

			case 'num_of_img':
			$total_photos = count(get_post_gallery_images($post->id));//
			echo !empty($total_photos) ? ($total_photos) : '--';
			break;
		}
	}

	public function slider_spider_guide ()
	{
		add_submenu_page( "edit.php?post_type=slider-spider", __("Guide"), __("Guide"), 'manage_options', 'guide', array($this, 'render_slider_spider_guide') );
	}


	public function render_slider_spider_guide ()
	{ 
		?>

		<h4>Create:</h4>
		<ol>
			<li>Click add new slider</li>
			<li>Add a slider title</li>
			<li>Click Add Media above text editor</li>
			<li>Create a gallery</li>
			<li>Set size to Full size from gallery settings</li>
			<li>Insert Gallery</li>
			<li>Set settings for your slider</li>
			<li>Publish</li>
		</ol>
		<h4>Use:</h4>
		<ol>
			<li>Click on All Slider to get shortcode for your slider</li>
			<li>Copy and paste the shortcode to any of your page/post</li>
			<li>Thanks</li>
		</ol>

		<?php 
	}

	/**
	 * This class checks if slider-spider shortcode enables/disables for the post or not
	 * if disabled and slider_spider short code there then remove short code
	 * @param  string $content content of the post
	 * @return string          filtered post content
	 */
	public function slider_spider_remove_shortcode_from_post( $content )
	{
		GLOBAL $post;
		//if slider-spider shortcode exists, and required to disable then disable all :(
		if ( has_shortcode( $content, 'slider_spider' ) ) {
			$slider_spider_switch=get_metadata('post', $post->ID, 'slider_spider_switch', true);
			if($slider_spider_switch=='false'){
				$content = strip_shortcodes( $content );
			}
		}
		return $content;
	}

	public function slider_spider_convert_image_gallery( $content )
	{
		GLOBAL $post;
		$prefix ='slider_spider_';
		
 		// Only do this on singular items
		if( ! is_singular() )
			return $content;

 		// Make sure the post has a gallery in it
		if( ! has_shortcode( $post->post_content, 'gallery' ) )
			return $content;

		//if meta value slider_spider_enable_slider==true then do ops
		if( get_metadata('post', $post->ID, 'slider_spider_enable_slider', true) != 'true')
			return $content;

 		// Retrieve all galleries of this post
		$galleries = get_post_galleries_images( $post );
		wp_enqueue_style( 'default-slider.cssx', plugin_dir_url( __FILE__ ) . '../public/css/default-slider.css'); 
		
		ob_start();?>		
		<?php foreach($galleries as $gallery):?>
			<div class="swiper-container default">
				<div class="swiper-wrapper default">
					<?php foreach($gallery as $images=>$url):?>

						<div class="swiper-slide default">
							<img class="default-slider-image" src="<?php echo $url?>" alt="no image">
						</div>

					<?php endforeach;?>
				</div>
				<!-- Add Pagination -->
				<div class="swiper-pagination"></div>
				<!-- Add navigation -->
				<div class="swiper-button-next swiper-button-blue"></div>
				<div class="swiper-button-prev swiper-button-blue"></div>
			</div>
			
		<?php endforeach;?>
		<script> /*enqueue public/js/default-slider.js either */
			var swiper = new Swiper('.swiper-container.default', {
				pagination: {
					el: '.swiper-pagination',
					dynamicBullets: true,
				},
				navigation: {
					nextEl: '.swiper-button-next',
					prevEl: '.swiper-button-prev',
				},
				loop: true,
			});

		</script>

		<?php 
		$content .= ob_get_clean();
		return $content;
	}
}