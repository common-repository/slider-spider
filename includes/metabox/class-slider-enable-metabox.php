<?php 

//exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
* 	This class defines a metabox for enable/disable slider on a post/page
*  	enabled by default
*/
class Slider_Enable_Metabox
{
	
	function __construct()
	{
		add_action( 'add_meta_boxes', array( $this, 'add_metabox'  ) );
	}

	public function add_metabox()
	{
		add_meta_box(
			'slider-enable-metabox',
			__( 'Slider Spider Control', 'textdomain' ),
			array( $this, 'render_metabox' ),
			['post','page'],
			'advanced',
			'default'
			);
	}

	public function render_metabox()
	{
		global $post;
		$prefix = 'slider_spider_';
		
		$slider_spider_enable_slider = get_post_meta( $post->ID, $prefix.'enable_slider', true );
		$slider_spider_switch = get_post_meta( $post->ID, $prefix.'switch', true );

		?>

		<div class="checkbox" data-toggle="tooltip" data-placement="bottom" title="Check if you want to convert your gallery into Slider Spider">
			<label >
				<input type="checkbox" name="<?php echo $prefix; ?>enable_slider" value="true" <?php checked('true', $slider_spider_enable_slider)?>>Convert Gallery into slider
			</label>
		</div>
		<br>
		<div class="radio">
			<label><input type="radio" value="true" name="<?php echo $prefix; ?>switch" <?php checked('true', $slider_spider_switch)?>>Enable Slider Spider Shortcode</label>
		</div>
		<div class="radio">
			<label><input type="radio" value="false" name="<?php echo $prefix; ?>switch" <?php checked('false', $slider_spider_switch)?>>Disable Slider Spider Shortcode</label>
		</div>


		<?php	}
	}
	new Slider_Enable_Metabox();