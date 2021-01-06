<?php
/*
* Generated By Orbisius Child Theme Creator - your favorite plugin for Child Theme creation :)
* https://wordpress.org/plugins/orbisius-child-theme-creator/
*
* Unlike style.css, the functions.php of a child theme does not override its counterpart from the parent.
* Instead, it is loaded in addition to the parent’s functions.php. (Specifically, it is loaded right before the parent theme's functions.php).
* Source: https://codex.wordpress.org/Child_Themes#Using_functions.php
*
* Be sure not to define functions, that already exist in the parent theme!
* A common pattern is to prefix function names with the (child) theme name.
* Also if the parent theme supports pluggable functions you can use function_exists( 'put_the_function_name_here' ) checks.
*/

/**
 * Loads parent and child themes' style.css
 */
function orbisius_ct_storefront_child_theme_product_page_child_theme_enqueue_styles() {
    $parent_style = 'orbisius_ct_storefront_child_theme_product_page_parent_style';
    $parent_base_dir = 'storefront';

    wp_enqueue_style( $parent_style,
        get_template_directory_uri() . '/style.css',
        array(),
        wp_get_theme( $parent_base_dir ) ? wp_get_theme( $parent_base_dir )->get('Version') : ''
    );

    wp_enqueue_style( $parent_style . '_child_style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );
}

add_action( 'wp_enqueue_scripts', 'orbisius_ct_storefront_child_theme_product_page_child_theme_enqueue_styles' );


////    WOO COMMERCE THEME SUPPORT  ////

function mytheme_add_woocommerce_support() {
    add_theme_support( 'woocommerce' ); // <<<< here
}
add_action( 'after_setup_theme', 'mytheme_add_woocommerce_support' );

/* enqueue CSS custom */



add_action( 'wp_enqueue_scripts', 'load_custom_product_style' );
      function load_custom_product_style() {
        if ( is_product() ){
        wp_register_style( 'product_css', get_stylesheet_directory_uri() . '/single-product.css', false, '1.0.0', 'all' );
          wp_enqueue_style('product_css');
        }
	  }



/* <SCRIPT 1>  */

// remove notices
//remove_action('woocommerce_before_single_product','wc_print_notices',10);



// remove title
//remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
// remove  rating  stars
//remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
// remove product meta 
//remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
// remove  description
//remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
// remove images
////remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );
// remove related products
//remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
// remove additional information tabs
//remove_action('woocommerce_after_single_product_summary ','woocommerce_output_product_data_tabs',10);

/* END SCRIPT 1 */


/* <SCRIPT 2>*/

// change order of description
//remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
//add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 6 );


/* <SCRIPT 3> */

//add_action('woocommerce_before_single_product_summary',function(){printf('<h4><a href="?added-content">Congratulations, you\'ve just added a link!</a></h4>');});

/* <SCRIPT 4> */
//add_action('woocommerce_after_single_product_summary','QuadLayers_callback_function');

function QuadLayers_callback_function(){
    printf('
    <h1> Hey there !</h1>
    <div><h5>Welcome to my custom product page</h5>
    <h4><a href="?link-to-somewere">Link to somewere!</a></h4>
    <img src="https://img.freepik.com/free-vector/bird-silhouette-logo-vector-illustration_141216-100.jpg"/>
    </div>');
}


/* <SCRIPT 5> */

//add_action('woocommerce_before_single_product','QuadLayers_get_user');
function QuadLayers_get_user() {
    if( is_user_logged_in() ) {
    $user = wp_get_current_user(); 
    printf ('<h1>Howdy ' .$user->user_nicename.'!</h1>');
    $roles = ( array ) $user->roles;
        if($roles[0]=='administrator'){
            echo "<h4><b>You are $roles[0]</h4></b>";
        }     
    } 
    else {
    return array();
    }     
}

/* < SCRIPT 6> */
//add_action('woocommerce_before_single_product','QuadLayers_get_product_taxonomies');

function QuadLayers_get_product_taxonomies(){ 
    global $post; 
    $term_obj_list = get_the_terms( $post->ID, 'product_cat' );
    $terms_string = join(', ', wp_list_pluck($term_obj_list, 'name'));
    if($terms_string=='Posters'){
        echo "<h1>This is one of our best $terms_string</h1>";
        echo "<h2>Product ID: $post->ID";
    }
}


/* <SCRIPT 7 > */
//add_action('woocommerce_before_single_product','QuadLayers_get_multiple_taxonomies');
function QuadLayers_get_multiple_taxonomies(){
    global $post;
    $args = array( 'taxonomy' => 'product_tag',);
    $terms = wp_get_post_terms($post->ID,'product_tag', $args);
    $count = count($terms); 
    if ($count > 0) {
        echo '<div class="custom-content"><h4>Tag list:</h4><ul>';
        foreach ($terms as $term) {echo '<li>'.$term->name.'</li>';}
        echo "</ul></div>";
    }
}

/* <SCRIPT 8> */
//add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );

function woo_remove_product_tabs( $tabs ) {
    unset( $tabs['description'] );    	// Remove the description tab
    $tabs['reviews']['title'] = __( 'Ratings' );	// Rename the reviews tab
    $tabs['additional_information']['priority'] = 5;	// Additional information third
    return $tabs;
}


/* <script 9> */

//add_filter( 'woocommerce_product_tabs', 'woo_custom_description_tab', 98 );
function woo_custom_description_tab( $tabs ) {
	$tabs['description']['callback'] = 'woo_custom_description_tab_content';	// Custom description callback
	return $tabs;
}

function woo_custom_description_tab_content() {
	echo '<h2>Custom Description</h2>';
	echo '<p>Here\'s a custom description</p>';
}

/* <script 10> */

//add_filter( 'woocommerce_product_tabs', 'woo_new_product_tab' );
function woo_new_product_tab( $tabs ) {	
	// Adds the new tab	
	$tabs['test_tab'] = array(
		'title' 	=> __( 'New Product Tab', 'woocommerce' ),
		'priority' 	=> 50,
		'callback' 	=> 'woo_new_product_tab_content'
	);
	return $tabs;
}
function woo_new_product_tab_content() {
	echo '<h2>New Product Tab</h2>';
	echo '<p>Here\'s your new product tab.</p>';	
}