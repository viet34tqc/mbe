<?php
/**
 * Child theme functions
 *
 * @package Divi
 */

/**
 * Load the parent style.css file
 *
 * @link http://codex.wordpress.org/Child_Themes
 */
function divi_child_scripts() {
	// Dynamically get version number of the parent stylesheet (lets browsers re-cache your stylesheet when you update your theme).
	$theme   = wp_get_theme( 'divi' );
	$version = $theme->get( 'Version' );
	// Load the stylesheet.
	wp_enqueue_style( 'divi-style', get_template_directory_uri() . '/style.css', array(), $version );
	wp_enqueue_style( 'divi-icofont', get_stylesheet_directory_uri() . '/fonts/icofont.css', array(), $version );
	wp_enqueue_style( 'divi-child-style', get_stylesheet_directory_uri() . '/style.css', array(), wp_get_theme()->get( 'Version' ) );
}
add_action( 'wp_enqueue_scripts', 'divi_child_scripts' );

add_action( 'widgets_init', function() {
	require get_stylesheet_directory(  ) . '/widgets/class-contact-info.php';
	register_widget( 'AlContactInfo' );
} );


/**
 * Add at a glance to left section
 */
add_action( 'auto_listings_before_listings_loop_item_summary', 'auto_listings_template_loop_at_a_glance', 20 );

/**
 * Add description
 */
remove_action( 'auto_listings_listings_loop_item', 'auto_listings_template_loop_description', 50 );

add_filter( 'auto_listings_listings_shortcode_output', function( $output, $query, $view, $cols ) {
	if ( $cols !== '1' ) {
		return $output;
	}

	if ( ! $query->have_posts() ) {
		ob_start();
		$this->loop_no_results( $atts );
		return ob_get_clean();
	}

	$view = ! empty( $atts['view'] ) ? $atts['view'] : 'list';
	$view .= '-view';

	ob_start();
	?>
	<?php do_action( "auto_listings_shortcode_before_listings_loop" ); ?>

	<?php
	$cols  = ! empty( $atts['columns'] ) ? $atts['columns'] : auto_listings_columns();
	$count = 1;
	echo '<ul class="auto-listings-items mbe-listings ' . esc_attr( $view ) . '">';

	while ( $query->have_posts() ) :
		$query->the_post();
		auto_listings_get_part( 'content-listing.php' );
		$count++;
	endwhile;

	echo '</ul>';

	do_action( 'auto_listings_after_listings_loop' );
	do_action( "auto_listings_shortcode_after_listings_loop" );

	wp_reset_postdata();
	return ob_get_clean();
}, 10, 4 );

add_action( 'wp_footer', function() {
	if ( ! is_singular( 'auto-listing' ) ) {
		return;
	}
	?>
	<script>
	jQuery(document).ready(function($) {
		setTimeout(function() {
		$(".single-auto-listing .auto-listings-tabs ul.tabs #tab-title-specifications, .single-auto-listing .auto-listings-tabs ul.tabs #tab-title-details").addClass("et_smooth_scroll_disabled");
		}, 300);
	});
	</script>
	<?php
} );

function auto_listings_get_social_share() {
	return apply_filters(
		'corify_social_share',
		array(
			'facebook'  => array(
				'label' => esc_html__( 'Facebook', 'corify-addons' ),
				'url'   => 'https://facebook.com/sharer/sharer.php?u=%s',
			),
			'twitter'   => array(
				'label' => esc_html__( 'Twitter', 'corify-addons' ),
				'url'   => 'https://twitter.com/intent/tweet?url=%s',
			),
			'linkedin'  => array(
				'label' => esc_html__( 'LinkedIn', 'corify-addons' ),
				'url'   => 'https://www.linkedin.com/shareArticle?mini=true&url=%s',
			),
			'pinterest' => array(
				'label' => esc_html__( 'Pinterest', 'corify-addons' ),
				'url'   => 'https://pinterest.com/pin/create/button/?url=%s',
			),
			'pocket'    => array(
				'label' => esc_html__( 'Pocket', 'corify-addons' ),
				'url'   => 'https://getpocket.com/save?url=%s',
			),
			'reddit'    => array(
				'label' => esc_html__( 'Reddit', 'corify-addons' ),
				'url'   => 'https://www.reddit.com/submit?url=%s',
			),
			'tumblr'    => array(
				'label' => esc_html__( 'Reddit', 'corify-addons' ),
				'url'   => 'https://www.tumblr.com/share/link?url=%s',
			),
			'mail'      => array(
				'label' => esc_html__( 'Mail', 'corify-addons' ),
				'url'   => 'mailto:?body=%s',
			),
		)
	);
}

/**
 * Social share.
 *
 * @param boolean $is_blog_article check if it's single post.
 */
function auto_listings_print_social_share() {
	$selected_social_share = [ 'facebook','twitter','linkedin','tumblr','pinterest' ];
	?>
	<span class="corify-social-share">
		<?php
		$post_url          = get_the_permalink();
		$social_share_list = auto_listings_get_social_share();
		ob_start();
		foreach ( $selected_social_share as $service ) :
			$social_share_link = sprintf( $social_share_list[ $service ]['url'], $post_url );
			?>
			<a target="_blank"
				class="social-share__item social-share--<?php echo esc_attr( $service ); ?>"
				href="<?php echo esc_url( $social_share_link ); ?>"
			>
				<i class="icofont-<?php echo esc_attr( $service ); ?>"></i>
			</a>
			<?php
		endforeach;
		?>
	</span>
	<?php
}
