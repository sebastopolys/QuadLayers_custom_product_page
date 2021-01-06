<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
global $product;

do_action( 'woocommerce_before_single_product' );

?>

<div id="product-<?php the_ID(); ?>" <?php wc_product_class( '', $product ); ?>>

	<?php
	/**
	 * Hook: woocommerce_before_single_product_summary.
	 *
	 * @hooked woocommerce_show_product_sale_flash - 10
	 * @hooked woocommerce_show_product_images - 20
	 */
	
	//do_action( 'woocommerce_before_single_product_summary' );
	
	?>

	<div class="summary entry-summary my-custom-product-template">
		<?php
		/**
		 * Hook: woocommerce_single_product_summary.
		 *
		 * @hooked woocommerce_template_single_title - 5
		 * @hooked woocommerce_template_single_rating - 10
		 * @hooked woocommerce_template_single_price - 10
		 * @hooked woocommerce_template_single_excerpt - 20
		 * @hooked woocommerce_template_single_add_to_cart - 30
		 * @hooked woocommerce_template_single_meta - 40
		 * @hooked woocommerce_template_single_sharing - 50
		 * @hooked WC_Structured_Data::generate_product_data() - 60
		 */
		
// remove product summary elements
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );


		
		// Custom content
		printf('<h1>This is the <b>'.$post->post_name.' </b>poster</h1>');
		printf('<h4>A full customized product page for the "posters" category products</h4>');
		// Description
		printf('<h5>'.$post->post_excerpt.'</h5>');
		//thumbnail
		do_action( 'woocommerce_before_single_product_summary' );
				
		//add meta
		do_action( 'woocommerce_single_product_summary');
		// shortcodes
		echo do_shortcode('[add_to_cart id="'.$post->ID.'" show_price="false" style="border:none;" class="my-addtocart"]');
		echo "<h3>Contact:</h3>".do_shortcode('[wpforms id="1082"]');
		echo "<h3>More posters:</h3>".do_shortcode('[product_category category="posters" orderby="desc" limit="4"]');

		
		
		
		?>	
	</div>

	<?php
	/**
	 * Hook: woocommerce_after_single_product_summary.
	 *
	 * @hooked woocommerce_output_product_data_tabs - 10
	 * @hooked woocommerce_upsell_display - 15
	 * @hooked woocommerce_output_related_products - 20
	 */
	//do_action( 'woocommerce_after_single_product_summary' );
	?>
</div>
