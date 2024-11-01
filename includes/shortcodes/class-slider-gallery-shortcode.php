<?php 

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
* Slider gallery shortcode
*/
class Slider_Gallery_Shortcode
{
	
	public function __construct()
	{
		add_shortcode( 'slider_spider', array( 'Slider_Gallery_Shortcode','slider_spider_gallery') );
	}

	public function slider_spider_gallery( $atts, $content )
	{
		extract(shortcode_atts(array(
			'id'				=> '',
			), $atts));

		// Taking some globals
		global $post;

		// Taking some variables
		$unique 		= 'xoxo';
		$gallery_id 	= !empty($id) ? $id	: $post->ID;
		// Metabox prefix
		$prefix ='slider_spider_'; 

		$arrow 				= get_post_meta( $gallery_id, $prefix.'arrow_slider', true );
		$arrow 				= ($arrow == 'false') ? 'false' : 'true';

		$pagination 		= get_post_meta( $gallery_id, $prefix.'pagination_slider', true );
		$pagination 		= ($pagination == 'false') ? 'false' : 'true';

		$pagination_type 	= get_post_meta( $gallery_id, $prefix.'pagination_type_slider', true );
		$pagination_type 	= get_metadata('post', $id, $prefix.'pagination_type_slider', true);
		//$pagination_type 	= ($pagination_type == 'fraction') ? 'fraction' : 'bullets';

		$autoplay 			= get_post_meta( $gallery_id, $prefix.'autoplay_slider', true );
		$autoplay 			= ($autoplay == 'false') ? 'false' : 'true';

		$autoplay_speed 	= get_post_meta( $gallery_id, $prefix.'autoplay_speed_slider', true );
		$autoplay_speed 	= (!empty($autoplay_speed)) ? $autoplay_speed : '3000';

		$auto_stop 			= get_post_meta( $gallery_id, $prefix.'auto_stop_slider', true );
		$auto_stop 			= ($auto_stop == 'true') ? 'true' : 'false';

		$loop 				= get_post_meta( $gallery_id, $prefix.'loop_slider', true );
		$loop 				= ($loop == 'false') ? 'false' : 'true';

		$speed 				= get_post_meta( $gallery_id, $prefix.'speed_slider', true );
		$speed 				= (!empty($speed)) ? $speed : '3000';

		$animation 			= get_post_meta( $gallery_id, $prefix.'animation_slider', true );
		$animation 			= get_metadata('post', $id, $prefix.'animation_slider', true);
		

		//$autoheight 		= get_post_meta( $gallery_id, $prefix.'autoheight_slider', true );
		//$autoheight 		= ($autoheight == 'true') ? 'true' : 'false';

		$height 			= get_post_meta( $gallery_id, $prefix.'height_slider', true );
		$height 			= (!empty($height) && $autoheight != 'true' ) ? $height : '';

		$direction 			= get_post_meta( $gallery_id, $prefix.'direction_slider', true );
		$direction 			= ($direction == 'vertical') ? 'vertical' : 'horizontal';

		$vertical_height 	= ($direction == 'vertical' && empty($height)) ? '300' : $height ;

		$space_between   	= get_post_meta( $gallery_id, $prefix.'space_between_slider', true );
		$space_between 		= (!empty($space_between)) ? $space_between : '0';

		$slider_height 		= (!empty($height)) ? 'style="height:'.$height.'px;"' : '300px';
		$slider_wrap_height = ($direction == 'vertical' && empty($height)) ? 'style="height:200px;"' : $slider_height;

		$mouse_wheel		= get_post_meta( $gallery_id, $prefix.'mouse_wheel', true );
		$mouse_wheel		= (!empty($mouse_wheel)) ? 'true' : 'false';

		$img_height			= get_post_meta($gallery_id, $prefix."img_height", true);
		$img_height			= get_metadata('post', $id, $prefix.'img_height', true);
		$img_height			= $img_height ? $img_height : "200";

		$img_width			= get_post_meta($gallery_id, $prefix."img_width", true);
		$img_width			= get_metadata('post', $id, $prefix.'img_width', true);
		$img_width			= $img_width ? $img_width : "300";

		$disableOnInteraction=get_metadata('post', $id, $prefix.'disableOnInteraction', true);
		$disableOnInteraction= $disableOnInteraction ? 'true':'false';

		
		$images=get_post_gallery_images( $id );
		ob_start(); ?>

		<?php if( $images ): ?>

			<!-- Thumbs gallery start -->
			<?php  if($animation=="thumbs_gallery"): 
			wp_enqueue_style( 'gallery-thumbs.css', plugin_dir_url( __FILE__ ) . '../../public/css/gallery-thumbs.css'); ?>
			
			<div class="swiper-container gallery-top">
				<div class="swiper-wrapper">
					<?php foreach($images as $image ): ?> 
						<div class="swiper-slide">            
							<img class="slider-image" src="<?php echo $image?>" alt="no img">
						</div>
					<?php endforeach; ?>
				</div>
				
				<!-- Add Arrows -->
				<?php if($arrow=='true'): ?>
					<div class="swiper-button-next swiper-button-blue"></div>
					<div class="swiper-button-prev swiper-button-blue"></div>
				<?php endif; ?>
			</div>
			
			<div class="swiper-container gallery-thumbs">
				<div class="swiper-wrapper">
					<?php foreach( $images as $image ): ?>  
						<div class="swiper-slide">            
							<img class="thumb-image" src="<?php echo $image;?>" alt="no img">
						</div>
					<?php endforeach; ?>
				</div>
			</div>
			
			<!-- Initialize Swiper for thumbs gallery-->
			<script>
				var galleryTop = new Swiper('.gallery-top', {

					spaceBetween: 10,
					navigation: {
						nextEl: '.swiper-button-next',
						prevEl: '.swiper-button-prev',
					},
					<?php if($autoplay=='true'):?>
					autoplay: {
						delay: <?php echo $autoplay_speed; ?>,
						disableOnInteraction: <?php echo $disableOnInteraction; ?>,
					},<?php endif;?>
				});
				var galleryThumbs = new Swiper('.gallery-thumbs', {
					spaceBetween: 10,
					centeredSlides: true,
					slidesPerView: 'auto',
					touchRatio: 0.2,
					slideToClickedSlide: true,
				});

				galleryTop.controller.control = galleryThumbs;
				galleryThumbs.controller.control = galleryTop;
				jQuery(".slider-image").css('height', '<?php echo $img_height;?>px');
				jQuery(".slider-image").css('width', '<?php echo $img_width;?>px');
				jQuery(".thumb-image").css('height', '100px');
				jQuery(".thumb-image").css('width', '100px');

			</script>
			<!-- Thumbs gallery end -->

			<!-- parallax start -->
		<?php  elseif($animation=="parallax"): 
		wp_enqueue_style( 'parallax.css', plugin_dir_url( __FILE__ ) . '../../public/css/parallax.css'); ?>

		<div class="swiper-container">
			<div class="parallax-bg" style="background-image:url(<?php echo plugin_dir_url(__FILE__).'../../admin/img/moder-dokandar.jpg'?>)" data-swiper-parallax="-23%"></div>
			
			<div class="swiper-wrapper">
				<div class="swiper-slide">
					<div class="title" data-swiper-parallax="-300">Slide 1</div>
					<div class="subtitle" data-swiper-parallax="-200">Subtitle</div>
					<div class="text" data-swiper-parallax="-100">
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam dictum mattis velit, sit amet faucibus felis iaculis nec. Nulla laoreet justo vitae porttitor porttitor. Suspendisse in sem justo. Integer laoreet magna nec elit suscipit, ac laoreet nibh euismod. Aliquam hendrerit lorem at elit facilisis rutrum. Ut at ullamcorper velit. Nulla ligula nisi, imperdiet ut lacinia nec, tincidunt ut libero. Aenean feugiat non eros quis feugiat.</p>
					</div>
				</div>
				<div class="swiper-slide">
					<div class="title" data-swiper-parallax="-300" data-swiper-parallax-opacity="0">Slide 2</div>
					<div class="subtitle" data-swiper-parallax="-200">Subtitle</div>
					<div class="text" data-swiper-parallax="-100">
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam dictum mattis velit, sit amet faucibus felis iaculis nec. Nulla laoreet justo vitae porttitor porttitor. Suspendisse in sem justo. Integer laoreet magna nec elit suscipit, ac laoreet nibh euismod. Aliquam hendrerit lorem at elit facilisis rutrum. Ut at ullamcorper velit. Nulla ligula nisi, imperdiet ut lacinia nec, tincidunt ut libero. Aenean feugiat non eros quis feugiat.</p>
					</div>
				</div>
				<div class="swiper-slide">
					<div class="title" data-swiper-parallax="-300">Slide 3</div>
					<div class="subtitle" data-swiper-parallax="-200">Subtitle</div>
					<div class="text" data-swiper-parallax="-100">
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam dictum mattis velit, sit amet faucibus felis iaculis nec. Nulla laoreet justo vitae porttitor porttitor. Suspendisse in sem justo. Integer laoreet magna nec elit suscipit, ac laoreet nibh euismod. Aliquam hendrerit lorem at elit facilisis rutrum. Ut at ullamcorper velit. Nulla ligula nisi, imperdiet ut lacinia nec, tincidunt ut libero. Aenean feugiat non eros quis feugiat.</p>
					</div>
				</div>
			</div>
			<!-- Add Pagination -->
			<div class="swiper-pagination swiper-pagination-white"></div>
			<!-- Add Navigation -->
			<div class="swiper-button-prev swiper-button-white"></div>
			<div class="swiper-button-next swiper-button-white"></div>
		</div>
		<?php wp_enqueue_script( 'parallax.js', plugin_dir_url( __FILE__ ) . '../../public/js/parallax.js'); ?>
		<!-- parallax end -->

		<!-- slide,fade,coverflow,cube,flip start -->
	<?php else: ?>
		<!-- 	swiper custom div -->
		<div class="swiper-container slider1">
			<div class="swiper-wrapper">

				<?php foreach( $images as $image ): ?>	
					<div class="swiper-slide">						
						<img class="slider-image" src="<?php echo $image?>" alt="no img">
					</div>
				<?php endforeach; ?>

			</div>

			<!-- Add Pagination -->
			<?php if($pagination=='true'): ?>
				<div class="swiper-pagination"></div>
			<?php endif; ?>

			<!-- Add Next Prev arrow -->
			<?php if($arrow=='true'): ?>
				<div class="swiper-button-next"></div>
				<div class="swiper-button-prev"></div>
			<?php endif; ?>

		</div>

		<!-- swiper script -->
		<script>
			var swiper = new Swiper('.swiper-container', {
				slidesPerView: 1,

				<?php if($animation != 'coverflow'):?>
				spaceBetween: <?php echo $space_between;?>,<?php endif;?>

				loop: "<?php echo $loop;?>",
				effect: "<?php echo $animation;?>",

				<?php if($autoplay=='true'):?>
				autoplay: {
					delay: <?php echo $autoplay_speed; ?>,
					disableOnInteraction: <?php echo $disableOnInteraction;?>,
				},<?php endif;?>

				pagination: {
					el: '.swiper-pagination',
					clickable: true,
					type: "<?php echo $pagination_type;?>",
				},

				navigation: {
					nextEl: '.swiper-button-next',
					prevEl: '.swiper-button-prev',
				},

				<?php if($animation=="cube"):?>
				cubeEffect: {
					shadow: true,
					slideShadows: true,
					shadowOffset: 20,
					shadowScale: 1.05,
				},<?php endif;?>

				<?php if($animation=="coverflow"):?>
				centeredSlides: true,
				grabCursor: true,
				slidesPerView: 'auto',
				coverflowEffect: {
					rotate: 30,
					stretch: 0,
					depth: 100,
					modifier: 1,
					slideShadows : true,
				}, <?php endif;?>

				mousewheel: '<?php echo $mouse_wheel;?>',
				direction: '<?php echo $direction;?>',


			});

			jQuery(".slider-image").css('height', '<?php echo $img_height;?>px');
			jQuery(".slider-image").css('width', '<?php echo $img_width;?>px');
			jQuery(".swiper-continer").css('height', '<?php echo $img_height;?>px');
			jQuery(".swiper-container").css('width', '<?php echo $img_width;?>px');

			/*style for coverflow and cube*/
			<?php if($animation=="cube" || $animation=="coverflow"):?>
			jQuery(".swiper-slide").css('background-position', 'center');
			jQuery(".swiper-slide").css('background-size', 'cover');<?php endif;?>

		</script>
		<!-- slide,fade,coverflow,cube,flip end-->

	<?php endif; ?>
<?php endif; ?>
<?php
$content .= ob_get_clean();
return $content;

}
}
new Slider_Gallery_Shortcode();
