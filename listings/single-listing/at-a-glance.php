<?php
/**
 * Single listing at a glance
 *
 * This template can be overridden by copying it to yourtheme/listings/single-listing/at-a-glance.php.
 *
 * @package CarListings
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<div class="at-a-glance">
	<h3><?php esc_html_e( 'Features Highlight', 'carlistings' ); ?></h3>
	<div class="at-a-glance__table">

		<?php if ( function_exists( 'auto_listings_odometer' ) && auto_listings_odometer() ) : ?>
			<span class="odomoter"><i class="icofont icofont-speed-meter"></i> <?php echo esc_html( auto_listings_odometer() ); ?></span>
		<?php endif; ?>

		<?php if ( function_exists( 'auto_listings_transmission' ) && auto_listings_transmission() ) : ?>
			<span class="transmission"><i class="icofont icofont-ui-settings"></i> <?php echo esc_html( auto_listings_transmission() ); ?></span>
		<?php endif; ?>

		<?php if ( function_exists( 'auto_listings_body_type' ) && auto_listings_body_type() ) : ?>
			<span class="body"><i class="icofont icofont-car-alt-4"></i> <?php echo wp_kses_post( auto_listings_body_type() ); ?></span>
		<?php endif; ?>

		<?php if ( function_exists( 'auto_listings_engine' ) && auto_listings_engine() ) : ?>
			<span class="vehicle"><?php echo esc_html( auto_listings_engine() ); ?></span>
		<?php endif; ?>

	</div>
</div>
