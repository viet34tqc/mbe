<?php
/**
 * The Template for displaying listing content in the single-listing.php template
 *
 * This template can be overridden by copying it to yourtheme/listings/content-single-listing.php.
 *
 * @package CarListings
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<?php do_action( 'auto_listings_before_single_listing' ); ?>

<div id="listing-<?php the_ID(); ?>" class="auto-listings-single listing">

	<div class="has-sidebar">

		<div class="image-gallery">

			<?php
			/**
			 * Slider
			 *
			 * @hooked auto_listings_template_single_gallery
			 */
			do_action( 'auto_listings_single_gallery' );
			?>

		</div>

		<div class="full-width upper">

			<?php
			/**
			 * Title
			 *
			 * @hooked auto_listings_template_single_title
			 */
			do_action( 'auto_listings_single_upper_full_width' );
			?>
			<?php if ( function_exists( 'auto_listings_price' ) ) : ?>
				<h4><?php echo wp_kses_post( auto_listings_price() ); ?></h4>
			<?php endif; ?>

		</div>

		<?php auto_listings_print_social_share() ?>

		<div class="content">

			<?php
			/**
			 * Info single listing
			 *
			 * @hooked auto_listings_template_single_tagline
			 * @hooked auto_listings_template_single_description
			 * @hooked auto_listings_output_listing_tabs
			 */
			do_action( 'auto_listings_single_content' );
			?>

		</div>

	</div>

	<div class="sidebar">

		<?php
		/**
		 * @hooked auto_listings_template_single_at_a_glance
		 * @hooked auto_listings_template_single_map
		 * @hooked auto_listings_template_single_contact_form
		 */
		do_action( 'auto_listings_single_sidebar' );
		?>

	</div>

	<div class="full-width lower">

		<?php do_action( 'auto_listings_single_lower_full_width' ); ?>

	</div>

</div>

<?php do_action( 'auto_listings_after_single_listing' ); ?>
