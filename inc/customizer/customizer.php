<?php

/**
 *
 * Customizer
 *
 */

/**
 * Register settings and controls for customize
 *
 * @since  1.0.0
 */ 
function shop_isle_customize_register( $wp_customize ) {
	
	class ShopIsle_Contact_Page_Instructions extends WP_Customize_Control {
		public function render_content() {
			echo __( 'To customize the Contact Page you need to first select the template "Contact page" for the page you want to use for this purpose. Then open that page in the browser and press "Customize" in the top bar.','shop-isle' ).'<br><br>'. __( 'Need further assistance? Check out this','shop-isle' ).' <a href="http://docs.themeisle.com/article/211-shopisle-customizing-the-contact-and-about-us-page" target="_blank">'.__( 'doc','shop-isle' ).'</a>';
		}
	}
	class ShopIsle_Front_Page_Instructions extends WP_Customize_Control {
		public function render_content() {
			echo __( 'To customize the Frontpage sections please create a page and select the template "Frontpage" for that page. After that, go to Appearance -> Customize -> Static Front Page and under "Static Front Page" select "A static page". Finally, for "Front page" choose the page you previously created.','shop-isle' ).'<br><br>'.__( 'Need further informations? Check this','shop-isle' ).' <a href="http://docs.themeisle.com/article/236-how-to-set-up-the-home-page-for-llorix-one">'.__( 'doc','shop-isle').'</a>';
		}
	}

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';

	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	/******************************/
	/**********  Header ***********/
	/******************************/
	
	$wp_customize->add_section( 'shop_isle_header_section', array(
        'title'    => __( 'Header', 'shop-isle' ),
        'priority' => 40
    ) );
	
	/* Logo */
	$wp_customize->add_setting( 'shop_isle_logo', array(
		'transport' => 'postMessage',
		'sanitize_callback' => 'esc_url'
	));

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'shop_isle_logo', array(
		'label'    => __( 'Logo', 'shop-isle' ),
		'section'  => 'shop_isle_header_section',
		'priority'    => 1,
	)));

	$wp_customize->get_control( 'header_image' )->section = 'shop_isle_header_section' ;
	$wp_customize->get_control( 'header_image' )->priority = '2';

	/* Blog Header title */
	$wp_customize->add_setting( 'shop_isle_blog_header_title', array(
		'default' 			=> __( 'Blog','shop-isle' ),
		'sanitize_callback' => 'shop_isle_sanitize_text',
		'transport' 		=> 'postMessage'
	));
	$wp_customize->add_control( 'shop_isle_blog_header_title', array(
		'label'    			=> esc_html__( 'Blog header title', 'shop-isle' ),
		'section'  			=> 'shop_isle_header_section',
		'priority'    		=> 3
	));

	/* Blog Header subtitle */
	$wp_customize->add_setting( 'shop_isle_blog_header_subtitle', array(
		'default' 			=> __( 'This Theme Supports a Custom FrontPage','shop-isle' ),
		'sanitize_callback' => 'shop_isle_sanitize_text',
		'transport' 		=> 'postMessage'
	));
	$wp_customize->add_control( 'shop_isle_blog_header_subtitle', array(
		'label'    			=> esc_html__( 'Blog header subtitle', 'shop-isle' ),
		'section'  			=> 'shop_isle_header_section',
		'priority'    		=> 4
	));

	/***********************************************************************************/
	/******  Frontpage - instructions for users when not on Frontpage template *********/
	/***********************************************************************************/

	$wp_customize->add_section( 'shop_isle_front_page_instructions', array(
		'title'    => __( 'Frontpage settings', 'shop-isle' ),
		'priority' => 41
	) );

	$wp_customize->add_setting( 'shop_isle_front_page_instructions', array(
		'sanitize_callback' => 'shop_isle_sanitize_text'
	) );

	$wp_customize->add_control( new ShopIsle_Front_Page_Instructions( $wp_customize, 'shop_isle_front_page_instructions', array(
		'section' => 'shop_isle_front_page_instructions'
	)));

	/****************************************************************/
	/******************  	FRONTPAGE SECTIONS    *******************/
	/****************************************************************/

	$wp_customize->add_panel( 'shop_isle_front_page_sections', array(
		'title'    => __( 'Frontpage sections', 'shop-isle' ),
		'priority' => 42
	) );

	/*******************************/
	/******    Slider section ******/
	/*******************************/
	
	$wp_customize->add_section( 'shop_isle_slider_section' , array(
		'title'       => __( 'Slider section', 'shop-isle' ),
		'priority'    => 41,
		'panel' => 'shop_isle_front_page_sections'
	));
	
	/* Hide slider */
	$wp_customize->add_setting( 'shop_isle_slider_hide', array(
		'transport' => 'postMessage',
		'sanitize_callback' => 'shop_isle_sanitize_text'
	));

	$wp_customize->add_control(
		'shop_isle_slider_hide',
		array(
			'type' => 'checkbox',
			'label' => __('Hide slider section?','shop-isle'),
			'description' => __('If you check this box, the Slider section will disappear from homepage.','shop-isle'),
			'section' => 'shop_isle_slider_section',
			'priority'    => 1,
		)
	);
	
	/* Slider */
	$wp_customize->add_setting( 'shop_isle_slider', array(
		'sanitize_callback' => 'shop_isle_sanitize_repeater',
		'default' => json_encode(array( array('image_url' => get_template_directory_uri().'/assets/images/slide1.jpg' ,'link' => '#', 'text' => __('ShopIsle','shop-isle'), 'subtext' => __('WooCommerce Theme','shop-isle'), 'label' => __('FIND OUT MORE','shop-isle') ), array('image_url' => get_template_directory_uri().'/assets/images/slide2.jpg' ,'link' => '#', 'text' => __('ShopIsle','shop-isle'), 'subtext' => __('Hight quality store','shop-isle') , 'label' => __('FIND OUT MORE','shop-isle')), array('image_url' => get_template_directory_uri().'/assets/images/slide3.jpg' ,'link' => '#', 'text' => __('ShopIsle','shop-isle'), 'subtext' => __('Responsive Theme','shop-isle') , 'label' => __('FIND OUT MORE','shop-isle') ))))
	);
	
	$wp_customize->add_control( new Shop_Isle_Repeater_Controler( $wp_customize, 'shop_isle_slider', array(
		'label'   => __('Add new slide','shop-isle'),
		'section' => 'shop_isle_slider_section',
		'priority' => 2,
        'shop_isle_image_control' => true,
        'shop_isle_text_control' => true,
        'shop_isle_link_control' => true,
		'shop_isle_subtext_control' => true,
		'shop_isle_label_control' => true,
		'shop_isle_icon_control' => false,
		'shop_isle_box_label' => __('Slide','shop-isle'),
		'shop_isle_box_add_label' => __('Add new slide','shop-isle')
	) ) );
	
	/********************************/
    /*********	Banners section *****/
	/********************************/
	
	$wp_customize->add_section( 'shop_isle_banners_section' , array(
		'title'       => __( 'Banners section', 'shop-isle' ),
		'priority'    => 42,
		'panel' => 'shop_isle_front_page_sections'
	));
	
	/* Hide banner */
	$wp_customize->add_setting( 'shop_isle_banners_hide', array(
		'transport' => 'postMessage',
		'sanitize_callback' => 'shop_isle_sanitize_text'
	));

	$wp_customize->add_control(
		'shop_isle_banners_hide',
		array(
			'type' => 'checkbox',
			'label' => __('Hide banners section?','shop-isle'),
			'description' => __('If you check this box, the Banners section will disappear from homepage.','shop-isle'),
			'section' => 'shop_isle_banners_section',
			'priority'    => 1,
		)
	);
	
	/* Banner */
	$wp_customize->add_setting( 'shop_isle_banners', array(
		'transport' => 'postMessage',
		'sanitize_callback' => 'shop_isle_sanitize_repeater',
		'default' => json_encode(array( array('image_url' => get_template_directory_uri().'/assets/images/banner1.jpg' ,'link' => '#' ),array('image_url' => get_template_directory_uri().'/assets/images/banner2.jpg' ,'link' => '#'),array('image_url' => get_template_directory_uri().'/assets/images/banner3.jpg' ,'link' => '#') ))
	));
	$wp_customize->add_control( new Shop_Isle_Repeater_Controler( $wp_customize, 'shop_isle_banners', array(
		'label'   => __('Add new banner','shop-isle'),
		'section' => 'shop_isle_banners_section',
		'priority' => 2,
        'shop_isle_image_control' => true,
        'shop_isle_link_control' => true,
        'shop_isle_text_control' => false,
		'shop_isle_subtext_control' => false,
		'shop_isle_label_control' => false,
		'shop_isle_icon_control' => false,
		'shop_isle_description_control' => false,
		'shop_isle_box_label' => __('Banner','shop-isle'),
		'shop_isle_box_add_label' => __('Add new banner','shop-isle')
	) ) );
	
	
	/*********************************/
    /*******  Products section *******/
	/********************************/
	
	$wp_customize->add_section( 'shop_isle_products_section' , array(
		'title'       => __( 'Products section', 'shop-isle' ),
		'description' => __( 'If no shortcode or no category is selected , WooCommerce latest products are displaying.', 'shop-isle' ),
		'priority'    => 43,
		'panel' => 'shop_isle_front_page_sections'
	));
	
	/* Hide products */
	$wp_customize->add_setting( 'shop_isle_products_hide', array(
		'transport' => 'postMessage',
		'sanitize_callback' => 'shop_isle_sanitize_text'
	));

	$wp_customize->add_control( 'shop_isle_products_hide', array(
		'type' => 'checkbox',
		'label' => __('Hide products section?','shop-isle'),
		'description' => __('If you check this box, the Products section will disappear from homepage.','shop-isle'),
		'section' => 'shop_isle_products_section',
		'priority'    => 1,
	));
	
	/* Title */
	$wp_customize->add_setting( 'shop_isle_products_title', array(
		'transport' => 'postMessage',
		'sanitize_callback' => 'shop_isle_sanitize_text', 
		'default' => __( 'Latest products', 'shop-isle' )
	));

	$wp_customize->add_control( 'shop_isle_products_title', array(
		'label'    => __( 'Section title', 'shop-isle' ),
		'section'  => 'shop_isle_products_section',
		'priority'    => 2,
	));
	
	/* Shortcode */
	$wp_customize->add_setting( 'shop_isle_products_shortcode', array(
		'sanitize_callback' => 'shop_isle_sanitize_text'
	));

	$wp_customize->add_control( 'shop_isle_products_shortcode', array(
		'label'    => __( 'WooCommerce shortcode', 'shop-isle' ),
		'section'  => 'shop_isle_products_section',
		'description'  => __( 'Insert a WooCommerce shortcode', 'shop-isle' ),
		'priority'    => 3,
	));
	
	$shop_isle_prod_categories_array = array('-' => __('Select category','shop-isle'));

	$shop_isle_prod_categories = get_categories( array('taxonomy' => 'product_cat', 'hide_empty' => 0, 'title_li' => '') );

	if( !empty($shop_isle_prod_categories) ):
		foreach ($shop_isle_prod_categories as $shop_isle_prod_cat):
		
			if( !empty($shop_isle_prod_cat->term_id) && !empty($shop_isle_prod_cat->name) ):
				$shop_isle_prod_categories_array[$shop_isle_prod_cat->term_id] = $shop_isle_prod_cat->name;
			endif;	
				
		endforeach;
	endif;
	
	/* Category */	
	$wp_customize->add_setting( 'shop_isle_products_category', array(
		'transport' => 'postMessage',
		'sanitize_callback' => 'shop_isle_sanitize_text'
	));
	$wp_customize->add_control( 'shop_isle_products_category', array(
		'type' 		   => 'select',
		'label' 	   => __( 'Products category', 'shop-isle' ),
		'description'  => __( 'OR pick a product category', 'shop-isle' ),
		'section' 	   => 'shop_isle_products_section',
		'choices'      => $shop_isle_prod_categories_array,
		'priority' 	   => 4,
	));
	
	/****************************************/
	/*********** Video section **************/
	/****************************************/
	
	$wp_customize->add_section( 'shop_isle_video_section' , array(
		'title'       => __( 'Video section', 'shop-isle' ),
		'priority'    => 44,
		'panel' => 'shop_isle_front_page_sections'
	));
	
	/* Hide video */
	$wp_customize->add_setting( 'shop_isle_video_hide', array(
		'transport' => 'postMessage',
		'sanitize_callback' => 'shop_isle_sanitize_text'
	));

	$wp_customize->add_control( 'shop_isle_video_hide', array(
		'type' => 'checkbox',
		'label' => __('Hide video section?','shop-isle'),
		'description' => __('If you check this box, the Video section will disappear from homepage.','shop-isle'),
		'section' => 'shop_isle_video_section',
		'priority'    => 1,
	));
	
	/* Title */
	$wp_customize->add_setting( 'shop_isle_video_title', array(
		'sanitize_callback' => 'shop_isle_sanitize_text', 
		'transport' => 'postMessage'
	));

	$wp_customize->add_control( 'shop_isle_video_title', array(
		'label'    => __( 'Title', 'shop-isle' ),
		'section'  => 'shop_isle_video_section',
		'priority'    => 2,
	));
	
	/* Youtube link */
	$wp_customize->add_setting( 'shop_isle_yt_link', array(
		'sanitize_callback' => 'esc_url'
	));

	$wp_customize->add_control( 'shop_isle_yt_link', array(
		'label'    => __( 'Youtube link', 'shop-isle' ),
		'section'  => 'shop_isle_video_section',
		'priority'    => 3,
	));
	
	/****************************************/
    /*******  Products slider section *******/
	/****************************************/
	
	$wp_customize->add_section( 'shop_isle_products_slider_section' , array(
		'title'       => __( 'Products slider section', 'shop-isle' ),
		'description' => __( 'If no category is selected , WooCommerce products from the first category found are displaying.', 'shop-isle' ),
		'priority'    => 45,
		'panel' => 'shop_isle_front_page_sections'
	));
	
	/* Hide products slider on frontpage */
	$wp_customize->add_setting( 'shop_isle_products_slider_hide', array(
		'transport' => 'postMessage',
		'sanitize_callback' => 'shop_isle_sanitize_text'
	));

	$wp_customize->add_control(
		'shop_isle_products_slider_hide',
		array(
			'type' => 'checkbox',
			'label' => __('Hide products slider section on frontpage?','shop-isle'),
			'description' => __('If you check this box, the Products slider section will disappear from homepage.','shop-isle'),
			'section' => 'shop_isle_products_slider_section',
			'priority'    => 1,
		)
	);

	/* Hide products slider on single product page */
	$wp_customize->add_setting( 'shop_isle_products_slider_single_hide', array(
		'transport' => 'postMessage',
		'sanitize_callback' => 'shop_isle_sanitize_text'
	));

	$wp_customize->add_control(
		'shop_isle_products_slider_single_hide',
		array(
			'type' => 'checkbox',
			'label' => __('Hide products slider section on single product page?','shop-isle'),
			'description' => __('If you check this box, the Products slider section will disappear from each single product page.','shop-isle'),
			'section' => 'shop_isle_products_slider_section',
			'priority'    => 2,
		)
	);
	
	/* Title */
	$wp_customize->add_setting( 'shop_isle_products_slider_title', array(
		'transport' => 'postMessage',
		'sanitize_callback' => 'shop_isle_sanitize_text', 
		'default' => __( 'Exclusive products', 'shop-isle' )
		)
	);

	$wp_customize->add_control( 'shop_isle_products_slider_title', array(
		'label'    => __( 'Section title', 'shop-isle' ),
		'section'  => 'shop_isle_products_slider_section',
		'priority'    => 3,
	));
	
	/* Subtitle */
	$wp_customize->add_setting( 'shop_isle_products_slider_subtitle', array(
		'transport' => 'postMessage',
		'sanitize_callback' => 'shop_isle_sanitize_text', 
		'default' => __( 'Special category of products', 'shop-isle' )
	));

	$wp_customize->add_control( 'shop_isle_products_slider_subtitle', array(
		'label'    => __( 'Section subtitle', 'shop-isle' ),
		'section'  => 'shop_isle_products_slider_section',
		'priority'    => 4,
	));
	
	/* Category */
	$wp_customize->add_setting( 'shop_isle_products_slider_category', array(
		'transport' => 'postMessage',
		'sanitize_callback' => 'shop_isle_sanitize_text'
	));
	$wp_customize->add_control(
		'shop_isle_products_slider_category',
		array(
			'type' 		   => 'select',
			'label' 	   => __( 'Products category', 'shop-isle' ),
			'section' 	   => 'shop_isle_products_slider_section',
			'choices'      => $shop_isle_prod_categories_array,
			'priority' 	   => 5,
		)
	);
	
	/*******************************/
    /***********  Footer ***********/
	/*******************************/
	
	$wp_customize->add_section( 'shop_isle_footer_section', array(
        'title'    => __( 'Footer', 'shop-isle' ),
        'priority' => 50
    ) );
	
	/* Copyright */
	$wp_customize->add_setting( 'shop_isle_copyright', array(
		'sanitize_callback' => 'shop_isle_sanitize_text', 
		'default' => __( '&copy; Themeisle, All rights reserved', 'shop-isle'),
		'transport' => 'postMessage'
	));

	$wp_customize->add_control( 'shop_isle_copyright', array(
		'label'    => __( 'Copyright', 'shop-isle' ),
		'section'  => 'shop_isle_footer_section',
		'priority'    => 1,
	));

	/* Hide site info */
	$wp_customize->add_setting( 'shop_isle_site_info_hide', array(
		'transport' => 'postMessage',
		'sanitize_callback' => 'shop_isle_sanitize_text'
	));

	$wp_customize->add_control(
		'shop_isle_site_info_hide',
		array(
			'type' => 'checkbox',
			'label' => __('Hide site info?','shop-isle'),
			'description' => __('If you check this box, the Site info will disappear from footer.','shop-isle'),
			'section' => 'shop_isle_footer_section',
			'priority' => 2,
		)
	);
	
	/* socials */
	$wp_customize->add_setting( 'shop_isle_socials', array(
		'transport' => 'postMessage',
		'sanitize_callback' => 'shop_isle_sanitize_repeater',
		'default' => json_encode(array( array('icon_value' => 'social_facebook' ,'link' => '#' ),array('icon_value' => 'social_twitter' ,'link' => '#'), array('icon_value' => 'social_dribbble' ,'link' => '#'), array('icon_value' => 'social_skype' ,'link' => '#') )),
	));
	$wp_customize->add_control( new Shop_Isle_Repeater_Controler( $wp_customize, 'shop_isle_socials', array(
		'label'   => __('Add new social','shop-isle'),
		'section' => 'shop_isle_footer_section',
		'priority' => 3,
        'shop_isle_image_control' => false,
        'shop_isle_link_control' => true,
        'shop_isle_text_control' => false,
		'shop_isle_subtext_control' => false,
		'shop_isle_label_control' => false,
		'shop_isle_icon_control' => true,
		'shop_isle_description_control' => false,
		'shop_isle_box_label' => __('Social','shop-isle'),
		'shop_isle_box_add_label' => __('Add new social','shop-isle')
	) ) );
	
	/*********************************/
	/******  Contact page  ***********/
	/*********************************/
	
	$wp_customize->add_section( 'shop_isle_contact_page_section', array(
        'title'    => __( 'Contact page', 'shop-isle' ),
        'priority' => 51
    ) );
	
	/* Contact Form  */
	$wp_customize->add_setting( 'shop_isle_contact_page_form_shortcode', array( 
		'sanitize_callback' => 'shop_isle_sanitize_text', 
	));
	
	$wp_customize->add_control( 'shop_isle_contact_page_form_shortcode', array(
		'label'    => __( 'Contact form shortcode', 'shop-isle' ),
		'description' => __('Create a form, copy the shortcode generated and paste it here. We recommend <a href="https://wordpress.org/plugins/contact-form-7/">Contact Form 7</a> but you can use any plugin you like.','shop-isle'),
		'section'  => 'shop_isle_contact_page_section',
		'active_callback' => 'shop_isle_is_contact_page',
		'priority'    => 1
	));
	
	/* Map ShortCode  */
	$wp_customize->add_setting( 'shop_isle_contact_page_map_shortcode', array( 
		'sanitize_callback' => 'shop_isle_sanitize_text',
	));
	
	$wp_customize->add_control( 'shop_isle_contact_page_map_shortcode', array(
		'label'    => __( 'Map shortcode', 'shop-isle' ),
		'description' => __('To use this section please install <a href="https://wordpress.org/plugins/intergeo-maps/">Intergeo Maps</a> plugin then use it to create a map and paste here the shortcode generated','shop-isle'),
		'section'  => 'shop_isle_contact_page_section',
		'active_callback' => 'shop_isle_is_contact_page',
		'priority'    => 2
	));
	
	/***********************************************************************************/
	/******  Contact page - instructions for users when not on Contact page  ***********/
	/***********************************************************************************/
	
	$wp_customize->add_section( 'shop_isle_contact_page_instructions', array(
        'title'    => __( 'Contact page', 'shop-isle' ),
        'priority' => 51
    ) );
	
	$wp_customize->add_setting( 'shop_isle_contact_page_instructions', array(
		'sanitize_callback' => 'shop_isle_sanitize_text',
	));
	
	$wp_customize->add_control( new ShopIsle_Contact_Page_Instructions( $wp_customize, 'shop_isle_contact_page_instructions', array(
	    'section' => 'shop_isle_contact_page_instructions',
		'active_callback' => 'shop_isle_is_not_contact_page',
	)));
	
	/*********************************/
	/**********  404 page  ***********/
	/*********************************/
	
	$wp_customize->add_section( 'shop_isle_404_section', array(
        'title'    => __( '404 Not found page', 'shop-isle' ),
        'priority' => 54
    ) );
	
	/* Background */
	$wp_customize->add_setting( 'shop_isle_404_background', array(
		'default' => get_template_directory_uri().'/assets/images/404.jpg', 
		'transport' => 'postMessage',
		'sanitize_callback' => 'esc_url'
	));

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'shop_isle_404_background', array(
		'label'    => __( 'Background image', 'shop-isle' ),
		'section'  => 'shop_isle_404_section',
		'priority'    => 1,
	)));
	
	/* Title */
	$wp_customize->add_setting( 'shop_isle_404_title', array(
		'sanitize_callback' => 'shop_isle_sanitize_text', 
		'default' => __( 'Error 404', 'shop-isle'), 
		'transport' => 'postMessage',
	));

	$wp_customize->add_control( 'shop_isle_404_title', array(
		'label'    => __( 'Title', 'shop-isle' ),
		'section'  => 'shop_isle_404_section',
		'priority'    => 2,
	));
	
	/* Text */
	$wp_customize->add_setting( 'shop_isle_404_text', array(
		'sanitize_callback' => 'shop_isle_sanitize_text', 
		'default' => __( 'The requested URL was not found on this server.<br> That is all we know.', 'shop-isle'), 
		'transport' => 'postMessage'
	));

	$wp_customize->add_control( 'shop_isle_404_text', array(
		'type' 		   => 'textarea',
		'label'    => __( 'Text', 'shop-isle' ),
		'section'  => 'shop_isle_404_section',
		'priority'    => 3,
	));
	
	/* Button link */
	$wp_customize->add_setting( 'shop_isle_404_link', array(
		'sanitize_callback' => 'esc_url', 
		'default' => '#', 
		'transport' => 'postMessage'
	));

	$wp_customize->add_control( 'shop_isle_404_link', array(
		'label'    => __( 'Button link', 'shop-isle' ),
		'section'  => 'shop_isle_404_section',
		'priority'    => 4,
	));
	
	/* Button label */
	$wp_customize->add_setting( 'shop_isle_404_label', array(
		'sanitize_callback' => 'shop_isle_sanitize_text', 
		'default' => __( 'Back to home page', 'shop-isle'), 
		'transport' => 'postMessage'
	));

	$wp_customize->add_control( 'shop_isle_404_label', array(
		'label'    => __( 'Button label', 'shop-isle' ),
		'section'  => 'shop_isle_404_section',
		'priority'    => 5,
	));
	
	/********************************************************/
	/************** ADVANCED OPTIONS  ***********************/
	/********************************************************/
	
	$wp_customize->add_section( 'shop_isle_general_section' , array(
		'title'       => __( 'Advanced options', 'shop-isle' ),
      	'priority'    => 55
	));

	$show_on_front = $wp_customize->get_control('show_on_front');
	$page_on_front = $wp_customize->get_control('page_on_front');
	$page_for_posts = $wp_customize->get_control('page_for_posts');
	
	if(!empty($show_on_front)):
		$show_on_front->section = 'shop_isle_general_section';
		$show_on_front->priority = 3;
	endif;
	
	if(!empty($page_on_front)):
		$page_on_front->section = 'shop_isle_general_section';
		$page_on_front->priority = 4;
	endif;
	
	if(!empty($page_for_posts)):
		$page_for_posts->section = 'shop_isle_general_section';
		$page_for_posts->priority = 5;
	endif;

	$wp_customize->remove_control('display_header_text');
	
	$nav_menu_locations_primary = $wp_customize->get_control('nav_menu_locations[primary]');
	if(!empty($nav_menu_locations_primary)){
		$nav_menu_locations_primary->section = 'shop_isle_general_section';
		$nav_menu_locations_primary->priority = 6;
	}
	
	/* Disable preloader */
	$wp_customize->add_setting( 'shop_isle_disable_preloader', array( 
		'sanitize_callback' => 'shop_isle_sanitize_text',
		'transport' => 'postMessage'
	));
	
	$wp_customize->add_control( 'shop_isle_disable_preloader', array(
		'type' => 'checkbox',
		'label' => __('Disable preloader?','shop-isle'),
		'description' => __('If this box is checked, the preloader will be disabled from homepage.','shop-isle'),
		'section' => 'shop_isle_general_section',
		'priority'    => 7,
	));


	/* Body font size */
	$wp_customize->add_setting( 'shop_isle_font_size', array(
		'default' => '13px',
		'sanitize_callback' => 'shop_isle_sanitize_text'
	));

	$wp_customize->add_control(
		'shop_isle_font_size',
		array(
			'type' 		=> 'select',
			'label' 	=> 'Select font size:',
			'section' 	=> 'shop_isle_general_section',
			'choices' 	=> array(
				'12px' => '12px',
				'13px' => '13px',
				'14px' => '14px',
				'15px' => '15px',
				'16px' => '16px',
			),
		)
	);
 

}

function shop_isle_is_contact_page() { 
	return is_page_template('template-contact.php');
};
function shop_isle_is_not_contact_page() { 
	return !is_page_template('template-contact.php');
};

function shop_isle_sanitize_repeater($input){
	  
	$input_decoded = json_decode($input,true);
	$allowed_html = array(
								'br' => array(),
								'em' => array(),
								'strong' => array(),
								'a' => array(
									'href' => array(),
									'class' => array(),
									'id' => array(),
									'target' => array()
								),
								'button' => array(
									'class' => array(),
									'id' => array()
								)
							);
	
	
	if(!empty($input_decoded)) {
		foreach ($input_decoded as $boxk => $box ){
			foreach ($box as $key => $value){
				if ($key == 'text'){
					$value = html_entity_decode($value);
					$input_decoded[$boxk][$key] = wp_kses( $value, $allowed_html);
				} else {
					$input_decoded[$boxk][$key] = wp_kses_post( force_balance_tags( $value ) );
				}

			}
		}

		return json_encode($input_decoded);
	}
	
	return $input;
}

function wp_themeisle_customize_preview_js() {
	wp_enqueue_script( 'wp_themeisle_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'wp_themeisle_customize_preview_js' );