<?php 
/**
* 	custom post type
*/

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class Slider_Spider_Post_Type
{
	
	public function __construct()
	{
		add_action('init', array($this,'slider_spider_post_type') );
	}

	public function slider_spider_post_type()
	{
		$labels = array(
			'name'                  => _x( 'Sliders', 'Post type general name', 'textdomain' ),
			'singular_name'         => _x( 'Slider', 'Post type singular name', 'textdomain' ),
			'menu_name'             => _x( 'Slider Spider', 'Admin Menu text', 'textdomain' ),
			'name_admin_bar'        => _x( 'Slider', 'Add New on Toolbar', 'textdomain' ),
			'add_new'               => __( 'Add New Slider', 'textdomain' ),
			'add_new_item'          => __( 'Add New Slider', 'textdomain' ),
			'new_item'              => __( 'New Slider', 'textdomain' ),
			'edit_item'             => __( 'Edit Slider', 'textdomain' ),
			'view_item'             => __( 'View Slider', 'textdomain' ),
			'all_items'             => __( 'All Sliders', 'textdomain' ),
			'search_items'          => __( 'Search Slider', 'textdomain' ),
			'parent_item_colon'     => __( 'Parent Books:', 'textdomain' ),
			'not_found'             => __( 'No books found.', 'textdomain' ),
			'not_found_in_trash'    => __( 'No books found in Trash.', 'textdomain' ),
			'featured_image'        => _x( 'Slider Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'textdomain' ),
			'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
			'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
			'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
			
			);

		$args = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'slider' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'menu_icon'			 => plugin_dir_url( __FILE__ ) . "../admin/img/slider-spider-icon.png",
			//'menu_icon'			 =>'http://icons.iconarchive.com/icons/icons8/windows-8/16/Holidays-Spider-icon.png',
			'supports'           => array( 'title', 'editor', 'thumbnail' ),
			);

		register_post_type( 'slider-spider', $args );
	}
}
new Slider_Spider_Post_Type();