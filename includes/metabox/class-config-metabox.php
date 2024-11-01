<?php 

//exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
* This class defines metabox for slider config 
*/
class Config_Metabox
{
	
	function __construct()
	{
		add_action( 'add_meta_boxes', array( $this, 'add_metabox'  ) );
	}

	/**
	 * Register Slider Config Metabox
	 */
	public function add_metabox() {
		add_meta_box(
			'config-meta-box',
			__( 'Slider Config', 'textdomain' ),
			array( $this, 'render_metabox' ),
			'slider-spider',
			'advanced',
			'default'
			);

	}

	/**
	 * Metabox style and structure
	 * 
	 * render slider config metabox
	 */
	public function render_metabox()
	{
		global $post;

		$prefix = 'slider_spider_'; 
		// Metabox prefix

		$style 						= get_post_meta( $post->ID, $prefix.'design_style', true );

		// Slider Variables
		$arrow_slider 				= get_post_meta( $post->ID, $prefix.'arrow_slider', true );
		$pagination_slider 			= get_post_meta( $post->ID, $prefix.'pagination_slider', true );
		$autoplay_slider 			= get_post_meta( $post->ID, $prefix.'autoplay_slider', true );
		$autoplay_speed_slider 		= get_post_meta( $post->ID, $prefix.'autoplay_speed_slider', true );
		$auto_stop_slider 			= get_post_meta( $post->ID, $prefix.'auto_stop_slider', true );
		$speed_slider 				= get_post_meta( $post->ID, $prefix.'speed_slider', true );
		$animation_slider 			= get_post_meta( $post->ID, $prefix.'animation_slider', true );
		$height_slider 				= get_post_meta( $post->ID, $prefix.'height_slider', true );
		$autoheight_slider 			= get_post_meta( $post->ID, $prefix.'autoheight_slider', true );
		$direction_slider 			= get_post_meta( $post->ID, $prefix.'direction_slider', true );
		$pagination_type_slider 	= get_post_meta( $post->ID, $prefix.'pagination_type_slider', true );
		$space_between_slider 		= get_post_meta( $post->ID, $prefix.'space_between_slider', true );
		$loop_slider 				= get_post_meta( $post->ID, $prefix.'loop_slider', true );
		$mouse_wheel 				= get_post_meta( $post->ID, $prefix.'mouse_wheel', true );
		$img_height 				= get_post_meta( $post->ID, $prefix.'img_height', true );
		$img_width 					= get_post_meta( $post->ID, $prefix.'img_width', true );
		$disableOnInteraction 		= get_post_meta( $post->ID, $prefix.'disableOnInteraction', true );



		?>
		<div class="wp-tsasp-mb-tabs-wrp">
			
			
			<div id="wp-tsasp-mdetails" class="wp-tsasp-mdetails wpssc-slider" style="<?php if($style == 'carousel'){ echo 'display:none';  } ?>">
				<table class="form-table wp-tsasp-team-detail-tbl">
					<h3><?php _e('Choose your Settings for Slider') ?></h3>
					<hr>
					<tbody>
						
						<tr valign="top">
							
							<td scope="row">
								<label><?php _e('Arrow'); ?></label>
							</td>
							<td>
								<input type="radio" value="true" name="<?php echo $prefix; ?>arrow_slider" <?php checked( 'true', $arrow_slider ); ?>>True
								<input type="radio" value="false" name="<?php echo $prefix; ?>arrow_slider" <?php checked( 'false', $arrow_slider ); ?>>False<br>
								<em style="font-size:11px;"><?php _e('Enable Arrows for slider'); ?></em>
							</td>
						</tr>
						<tr valign="top">
							<td scope="row">
								<label><?php _e('Pagination', 'swiper-slider-and-carousel'); ?></label>
							</td>
							<td>
								<input type="radio" name="<?php echo $prefix; ?>pagination_slider" value="true" <?php checked( 'true', $pagination_slider ); ?> >True
								<input type="radio" name="<?php echo $prefix; ?>pagination_slider" value="false" <?php checked( 'false', $pagination_slider ); ?>>False<br>
								<em style="font-size:11px;"><?php _e('String with CSS selector or HTML element of the container with pagination'); ?></em>
							</td>
						</tr>

						<!-- mouse-wheel control -->
						<tr valign="top">
							<td scope="row">
								<label><?php _e('Mouse Wheel Control'); ?></label>
							</td>
							<td>
								<input type="radio" name="<?php echo $prefix; ?>mouse_wheel" value="true" <?php checked( 'true', $mouse_wheel ); ?> >True
								<input type="radio" name="<?php echo $prefix; ?>mouse_wheel" value="false" <?php checked( 'false', $mouse_wheel ); ?>>False<br>
								<em style="font-size:11px;"><?php _e('True to control slider using mouse wheel'); ?></em>
							</td>
						</tr>

						<tr valign="top">
							<td scope="row">
								<label><?php _e('Pagination Type', 'swiper-slider-and-carousel'); ?></label>
							</td>
							<td>
								<select name="<?php echo $prefix; ?>pagination_type_slider">
									<option value="bullets" <?php selected( $pagination_type_slider, 'bullets'); ?>>Bullets</option>
									<option value="fraction" <?php selected( $pagination_type_slider, 'fraction'); ?>>Fraction</option>
									<option value="progressbar" <?php selected( $pagination_type_slider, 'progressbar'); ?>>Progressbar</option>
								</select><br/>
								<em style="font-size:11px;"><?php _e('String with type of pagination. Can be "bullets", "fraction", "progressbar"'); ?></em>
							</td>
						</tr>
					</tbody>
				</table>
				<table class="form-table wp-tsasp-team-detail-tbl">
					<tbody>
						<tr valign="top">
							<h4><?php _e('General Settings', 'swiper-slider-and-carousel') ?></h4>
							<hr>
							<td scope="row">
								<label><?php _e('Autoplay', 'swiper-slider-and-carousel'); ?></label>
							</td>
							<td>
								<input type="radio" name="<?php echo $prefix; ?>autoplay_slider" value="true" <?php checked( 'true', $autoplay_slider ); ?>>True
								<input type="radio" name="<?php echo $prefix; ?>autoplay_slider"  value="false" <?php checked( 'false', $autoplay_slider ); ?>>False<br/>
								<em style="font-size:11px;"><?php _e('Enable Autoplay for Slider'); ?></em>
							</td>
						</tr>
						<tr valign="top">
							<td scope="row">
								<label><?php _e('Autoplay Speed'); ?></label>
							</td>
							<td>
								<input type="number"  name="<?php echo $prefix; ?>autoplay_speed_slider" value="<?php echo esc_attr($autoplay_speed_slider); ?>"><br/>
								<em style="font-size:11px;"><?php _e('Delay between transitions (in ms). If this parameter is not specified, auto play will be disabled'); ?></em>
							</td>
						</tr>
						<tr valign="top">
							<td scope="row">
								<label><?php _e('Space Between Slides'); ?></label>
							</td>
							<td>
								<input type="number"  name="<?php echo $prefix; ?>space_between_slider" value="<?php echo esc_attr($space_between_slider); ?>"><br/>
								<em style="font-size:11px;"><?php _e('Distance between slides in px.'); ?></em>
							</td>
						</tr>
						<tr valign="top">
							<td scope="row">
								<label><?php _e('Speed', 'swiper-slider-and-carousel'); ?></label>
							</td>
							<td>
								<input type="number" name="<?php echo $prefix; ?>speed_slider" value="<?php echo esc_attr($speed_slider); ?>"><br/>
								<em style="font-size:11px;"><?php _e('Duration of transition between slides (in ms)'); ?></em>
							</td>
						</tr>
						<tr valign="top">
							<td scope="row">
								<label><?php _e('Loop', 'swiper-slider-and-carousel'); ?></label>
							</td>
							<td>
								<input type="radio" name="<?php echo $prefix; ?>loop_slider" value="true" <?php checked( 'true', $loop_slider ); ?>>True
								<input type="radio" name="<?php echo $prefix; ?>loop_slider" value="false" <?php checked( 'false', $loop_slider ); ?>>False<br/>
								<em style="font-size:11px;"><?php _e('Set to true to enable continuous loop mode'); ?></em>
							</td>
						</tr>
						<tr valign="top">
							<td scope="row">
								<label><?php _e('Autoplay Stop On Last', 'swiper-slider-and-carousel'); ?></label>
							</td>
							<td>
								<input type="radio" name="<?php echo $prefix; ?>auto_stop_slider" value="true" <?php checked( 'true', $auto_stop_slider ); ?>>True
								<input type="radio" name="<?php echo $prefix; ?>auto_stop_slider" value="false" <?php checked( 'false', $auto_stop_slider ); ?>>False<br/>
								<em style="font-size:11px;"><?php _e('Enable this parameter and autoplay will be stopped when it reaches last slide'); ?></em><br/>
								<em style="font-size:11px;color:#ff0808;"><?php _e('This will work when loop is false.'); ?></em>
							</td>
						</tr>

						<tr valign="top">
							<td scope="row">
								<label><?php _e('Disable on interaction'); ?></label>
							</td>
							<td>
								<input type="checkbox" name="<?php echo $prefix; ?>disableOnInteraction" value="true" <?php checked( 'true', $disableOnInteraction ); ?>>
								<br/>
								<em style="font-size:11px;"><?php _e('On interaction slider will stop looping'); ?></em><br/>
								
							</td>
						</tr>
					</tbody>
				</table>
				<table class="form-table wp-tsasp-team-detail-tbl">
					<tbody>
						<tr valign="top">
							<h4><?php _e('Other Settings') ?></h4>
							<hr>
							<td scope="row">
								<label><?php _e('Effect'); ?></label>
							</td>
							<td>
								<select id="animation_slider" name="<?php echo $prefix; ?>animation_slider">
									<option value="slide" <?php if($animation_slider == 'slide'){echo 'selected'; } ?>>Slide</option>
									<option value="fade" <?php if($animation_slider == 'fade'){echo 'selected'; } ?>>Fade</option>
									<option value="cube" <?php if($animation_slider == 'cube'){echo 'selected'; } ?>>Cube</option>
									<option value="coverflow" <?php if($animation_slider == 'coverflow'){echo 'selected'; } ?>>Coverflow</option>
									<option value="flip" <?php if($animation_slider == 'flip'){echo 'selected'; } ?>>Flip</option>
									<option value="thumbs_gallery" <?php if($animation_slider == 'thumbs_gallery'){echo 'selected'; } ?>>Thumbs Gallery</option>
									<option value="parallax" <?php if($animation_slider == 'parallax'){echo 'selected'; } ?>>Parallax</option>
									
								</select><br/>
								<em style="font-size:11px;"><?php _e('Could be "slide", "fade", "cube", "coverflow","flip", "thumbs gallery", "parallax"'); ?>
								</em><br>

								<div id="extra_field">
									
								</div>
								<hr>
							</td>
						</tr>
						
						<tr valign="top">
							<td scope="row">
								<label><?php _e('Direction'); ?></label>
							</td>
							<td>
								<input type="radio" name="<?php echo $prefix; ?>direction_slider" value="horizontal" <?php checked( 'horizontal', $direction_slider ); ?>>Horizontal
								<input type="radio" name="<?php echo $prefix; ?>direction_slider" value="vertical" <?php checked( 'vertical', $direction_slider ); ?>>Vertical<br/>
								<em style="font-size:11px;"><?php _e('Could be "horizontal" or "vertical" (for vertical slider).'); ?></em>
							</td>
						</tr>
						
						<!-- image height -->
						<tr valign="top">
							<td scope="row">
								<label><?php _e('Image Height'); ?></label>
							</td>
							<td>
								<input type="number"  class="wp-igsp-slider" name="<?php echo $prefix; ?>img_height" value="<?php echo esc_attr($img_height); ?>">px<br/>
								<em style="font-size:11px;"><?php _e('Image height (in px). defaulf=200px'); ?></em>
							</td>
						</tr>

						<!-- image width -->
						<tr valign="top">
							<td scope="row">
								<label><?php _e('Image Width'); ?></label>
							</td>
							<td>
								<input type="number"  class="wp-igsp-slider" name="<?php echo $prefix; ?>img_width" value="<?php echo esc_attr($img_width); ?>">px<br/>
								<em style="font-size:11px;"><?php _e('Image width (in px). defaulf=300px'); ?></em>
							</td>
						</tr>
					</tbody>
				</table><!-- end .wtwp-tstmnl-table -->
			</div>

			<!--carousel data -->
			
		</div>

		<script type="text/javascript">
			console.log('hit');
			$(document).ready(function () {    
				$("#animation_slider").on('change', function () {
					var animaiton_type=$("#animation_slider").val();
					if(animaiton_type=="parallax"){
						$("#extra_field").append("<input type='button' value='add'>");
						$("#extra_field").append("<input type='text'>");

					}
					else{
						$("#extra_field").empty();
					}

				})
			});

		</script>



		<?php 
	} 
}
new Config_Metabox();

