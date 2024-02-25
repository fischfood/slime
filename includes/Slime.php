<?php
/**
 * Slime
 *
 * @author  Brian Fischer
 * @package Slime
 */

/**
 * Class Slime
 */
class Slime {

	/**
	 * Apple favicon sizes.
	 *
	 * @var array
	 */
	public $apple_favicon_sizes = array(
		57,
		60,
		72,
		76,
		114,
		120,
		144,
		152,
		180,
	);

	/**
	 * Generic favicon sizes.
	 *
	 * @var array
	 */
	public $favicon_sizes = array(
		16,
		32,
		96,
		192,
	);

	/**
	 * __construct function.
	 */
	public function __construct() {

		$slime      = new \Slime\Core();

		add_filter( 'upload_mimes', [ $this, 'upload_mimes' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'wp_enqueue_scripts' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'wp_enqueue_styles' ] );
		add_action( 'init', [ $this, 'init' ] );

		add_action( 'customize_register', [ $this, 'customize_register_logos' ] );
		add_action( 'customize_register', [ $this, 'customize_register_ctas' ] );

		add_action( 'after_setup_theme', [ $this, 'after_setup_theme' ] );
		add_action( 'after_setup_theme', [ $this, 'add_editor_styles' ] );
		add_action( 'init', [ $this, 'register_block_styles' ] );

		// Jetpack //
		add_action( 'loop_start', [ $this, 'remove_jp_social' ] );
		add_filter( 'wp', [ $this, 'remove_jp_related'], 20 );
		add_filter( 'jetpack_relatedposts_filter_options', [ $this, 'jetpackme_no_related_posts' ] );

		// Gravity Forms //
		add_filter( 'gform_submit_button', [ $this, 'gform_submit_button'], 10, 2 );
	}

	/**
	 * Registers the menu in the WordPress admin menu editor.
	 *
	 * @since 1.0
	 */
	public function init() {
		register_nav_menus(
			array(
				'main-nav'          => esc_html__( 'Naviation', 'slime' ),
				'footer'            => esc_html__( 'Footer', 'slime' ),
				'mobile-off-canvas' => esc_html__( 'Mobile Nav', 'slime' ),
				'social'            => esc_html__( 'Social Links', 'slime' ),
			)
		);
	}

	/**
	 * Hook into after_setup_theme
	 *
	 * @access public
	 * @return void
	 */
	public function after_setup_theme() {
		add_theme_support( 'menus' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'automatic-feed-links' );
		update_option( 'image_default_link_type', 'none' );
	}

	/**
	 * Add wp_enqueue_scripts.
	 *
	 * @access public
	 * @return void
	 */
	public function wp_enqueue_scripts() {
		if ( ! is_admin() ) {
			wp_enqueue_script( 'slime-js', get_stylesheet_directory_uri() . '/js/slime.js', array( 'jquery' ), SLIME_VERSION, true );

		}
	}

	/**
	 * Enqueue our theme styles.
	 *
	 * @access public
	 * @return void
	 */
	public function wp_enqueue_styles() {
		if ( ! is_admin() ) {

			wp_enqueue_style('slime-css', get_stylesheet_directory_uri() . '/css/slime.css', array(), SLIME_VERSION );
			
		}
	}

	/*
	 * Customize_register function.
	 *
	 * Allows header logo to be set-up from
	 * the customize panel under Appearance within the WordPress Admin
	 *
	 * Also allow for the .svg extension within logo uploading
	 *
	 * @since 1.0
	 *
	 * @param $wp_customize
	 */
	public function customize_register_logos( $wp_customize ) {

		$wp_customize->add_section(
			'slime_logos', array(
				'title'    => esc_html__( 'Site Logos', 'slime' ),
				'priority' => 80,
			)
		);

		$wp_customize->add_setting(
			'slime_logos[logo_upload]', array(
				'capability' => 'edit_theme_options',
				'type'       => 'option',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Image_Control( $wp_customize, 'logo_upload', array(
				'label'      => esc_html__( 'Site Logo', 'slime' ),
				'section'    => 'slime_logos',
				'settings'   => 'slime_logos[logo_upload]',
				'extensions' => array( 'jpg', 'jpeg', 'png', 'gif', 'svg' ),
			) )
		);

		$wp_customize->add_setting(
			'slime_logos[alternate_logo_upload]', array(
				'capability' => 'edit_theme_options',
				'type'       => 'option',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Image_Control( $wp_customize, 'alternate_logo_upload', array(
				'label'      => esc_html__( 'Alternate Site Logo', 'slime' ),
				'section'    => 'slime_logos',
				'settings'   => 'slime_logos[alternate_logo_upload]',
				'extensions' => array( 'jpg', 'jpeg', 'png', 'gif', 'svg' ),
			) )
		);

		$wp_customize->add_setting(
			'slime_logos[hair_logo_upload]', array(
				'capability' => 'edit_theme_options',
				'type'       => 'option',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Image_Control( $wp_customize, 'hair_logo_upload', array(
				'label'      => esc_html__( 'Hair for Logo Fade', 'slime' ),
				'section'    => 'slime_logos',
				'settings'   => 'slime_logos[hair_logo_upload]',
				'extensions' => array( 'jpg', 'jpeg', 'png', 'gif', 'svg' ),
			) )
		);

		$wp_customize->add_setting(
			'slime_logos[footer_logo_upload]', array(
				'capability' => 'edit_theme_options',
				'type'       => 'option',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Image_Control( $wp_customize, 'footer_logo_upload', array(
				'label'      => esc_html__( 'Footer Site Logo', 'slime' ),
				'section'    => 'slime_logos',
				'settings'   => 'slime_logos[footer_logo_upload]',
				'extensions' => array( 'jpg', 'jpeg', 'png', 'gif', 'svg' ),
			) )
		);
	}

	public function customize_register_ctas( $wp_customize ) {

		$wp_customize->add_section(
			'slime_ctas', array(
				'title'    => esc_html__( 'Site CTAs', 'slime' ),
				'priority' => 80,
			)
		);

		// Contact Button - Header and Footer
		$wp_customize->add_setting(
			'slime_ctas[contact_label]', array(
				'default'		=> __('Contact', 'slime'),
				'capability' 	=> 'edit_theme_options',
				'type'			=> 'option',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control( $wp_customize, 'contact_label', array(
				'label'		=> __( 'Contact Button Label', 'slime' ),
				'section' 	=> 'slime_ctas',
				'settings' 	=> 'slime_ctas[contact_label]',
			) )
		);
		$wp_customize->add_setting(
			'slime_ctas[contact_url]', array(
				'default'		=> 'contact',
				'capability' 	=> 'edit_theme_options',
				'type'			=> 'option',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control( $wp_customize, 'contact_url', array(
				'label'		=> __( 'Contact Button URL', 'slime' ),
				'section' 	=> 'slime_ctas',
				'settings' 	=> 'slime_ctas[contact_url]',
			) )
		);

		// Header Banner
		$wp_customize->add_setting(
			'slime_ctas[banner_text]', array(
				'capability' 	=> 'edit_theme_options',
				'type'			=> 'option',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control( $wp_customize, 'banner_text', array(
				'label'		=> __( 'Banner Text', 'slime' ),
				'section' 	=> 'slime_ctas',
				'settings' 	=> 'slime_ctas[banner_text]',
				'type' 		=> 'textarea'
			) )
		);
		$wp_customize->add_setting(
			'slime_ctas[banner_link]', array(
				'default'		=> 'contact',
				'capability' 	=> 'edit_theme_options',
				'type'			=> 'option',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control( $wp_customize, 'banner_link', array(
				'label'		=> __( 'Banner Link', 'slime' ),
				'section' 	=> 'slime_ctas',
				'settings' 	=> 'slime_ctas[banner_link]',
			) )
		);
	}

	/**
	 * slime_upload_mimes function.
	 *
	 * @access public
	 *
	 * @param array $mimes (default: array())
	 *
	 * @return array
	 */
	public function upload_mimes( $mimes = array() ) {
		$mimes[ 'svg' ] = 'image/svg+xml';

		return $mimes;
	}

	/**
	 * Add customized styles to the WordPress admin to match frontend editing.
	 */
	public function add_editor_styles() {
		$admin_style = get_stylesheet_directory_uri() . '/css/admin-editor.css';

		add_editor_style( $admin_style );
	}

	public function register_block_styles() {

		$block_styles = array(
			'core/button'          => array(
				'fill-base'    => __( 'Fill Base', 'slime' ),
				'outline-base' => __( 'Outline Base', 'slime' ),
			),
			'core/group'           => array(
				'shadow'       => __( 'Shadow', 'slime' ),
				'shadow-solid' => __( 'Shadow Solid', 'slime' ),
				'full-height'  => __( 'Full-height', 'slime' ),
			),
			'core/image'           => array(
				'shadow' => __( 'Shadow', 'slime' ),
			),
			'core/list'            => array(
				'no-disc' => __( 'No Disc', 'slime' ),
			),
			'core/media-text'      => array(
				'shadow-media' => __( 'Shadow', 'slime' ),
			),
			'core/navigation-link' => array(
				'fill'         => __( 'Fill', 'slime' ),
				'fill-base'    => __( 'Fill Base', 'slime' ),
				'outline'      => __( 'Outline', 'slime' ),
				'outline-base' => __( 'Outline Base', 'slime' ),
			),
			'core/cover' => array(
				'full' => __( 'Full Width', 'slime' ),
			),
			'core/paragraph' => array(
				'text-align-justify' => __( 'Align Justify', 'slime' ),
				'links-blue' => __( 'Links Blue', 'slime' ),
			),
			'core/columns' => array(
				'tablet-swap-columns' => __( 'Tablet Swap Columns', 'slime' ),
				'text-ctas'           => __( 'Text CTAs', 'hari' ),
				'narrow-gutter'       => __( 'Narrow Gutter', 'hari' ),
			),
			'core/column' => array(
				'has-global-radius'   => __( 'Has Global Radius', 'hari' ),
			),
			'core/navigation' => array(
				'tablet-accordion-submenus' => __( 'Tablet Accordion Submenus', 'slime' ),
				'inline-links' => __( 'Inline Links', 'slime' ),
			),
		);
	
		foreach ( $block_styles as $block => $styles ) {
			foreach ( $styles as $style_name => $style_label ) {
				register_block_style(
					$block,
					array(
						'name'  => $style_name,
						'label' => $style_label,
					)
				);
			}
		}
	}

	// Jetpack //
	/**
	 * Remove Jetpack Sharing icons and Related Posts from displaying by default
	 */
	function remove_jp_social() {
		if ( function_exists( 'sharing_display' ) ) {
			remove_filter( 'the_content', 'sharing_display', 19 );
			remove_filter( 'the_excerpt', 'sharing_display', 19 );
		}
	}

	function remove_jp_related() {
		if ( class_exists( 'Jetpack_RelatedPosts' ) ) {
			$jprp = Jetpack_RelatedPosts::init();
			$callback = array( $jprp, 'filter_add_target_to_dom' );
			remove_filter( 'the_content', $callback, 40 );
		}
	}

	function jetpackme_no_related_posts( $options ) {
		if ( !is_admin() ) {
			$options['enabled'] = false;
		}
		return $options;
	}

	// Gravity Forms //
	function gform_submit_button( $button, $form ) {
		return "<div class='overflow-container'><span class='lines'><button class='button gform_button' id='gform_submit_button_{$form['id']}'><span>Submit</span></button></span></div>";
	}
}

function get_loop_block( $name, $small = '', $medium = '', $large = '', $classes = '') {

	if ( '' == $name )
		return false;

	$template = "partials/loop-{$name}.php";

	$grid_small = '';
	$grid_medium = '';
	$grid_large = '';
	$check = false;

	/**
	 * $grid_set gets passed through to locate_template
	 * Within loop-###.php, set defaults for if $grid_set is not set
	 */
	$grid_set = '';

	if (strpos($classes, 'cell') !== false) {
		$grid_set = ' ';
	} else {

		if ( '' !== $small ) {
			$grid_small = 'small-' . $small;
			$check      = true;
		}

		if ( '' !== $medium ) {
			$grid_medium = 'medium-' . $medium;
			$check       = true;
		}

		if ( '' !== $large ) {
			$grid_large = 'large-' . $large;
			$check      = true;
		}

		if ( $check ) {
			$grid_set = 'cell ' . $grid_small . ' ' . $grid_medium . ' ' . $grid_large;
		}
	}

	/**
	 * $loop_block_classes gets passed through to locate_template
	 * Within loop-###.php, $loop_block_classes are set on the outer most container (traditionally) to add extra classes (primarily for shortcode usage)
	 */
	$loop_block_classes = $classes;

	include( locate_template( $template, false, false) );

}

if ( ! function_exists( 'get_primary_taxonomy' ) ) {
	function get_primary_taxonomy( $post_id, $taxonomy = 'category', $info = false ) {
		$wpseo_primary_term = '';
		$prm_term = '';

		if (class_exists('WPSEO_Primary_Term')) {
			$wpseo_primary_term = new WPSEO_Primary_Term( $taxonomy, $post_id );
			$prm_term           = $wpseo_primary_term->get_primary_term();
		}

		if ( ! is_object( $wpseo_primary_term ) || empty( $prm_term ) ) {
			$term = wp_get_post_terms( $post_id, $taxonomy );
			if ( isset( $term ) && ! empty( $term ) ) {
				if ( $info != false ) {
					return $term[0]->$info;
				} else {
					return $term[0];
				}
			} else {
				return '';
			}
		}

		$term_id = $wpseo_primary_term->get_primary_term();

		if ( $info == 'term_id' ) {
			return $term_id;
		} else {
			$term = get_term( $term_id, $taxonomy );

			if ( $info != false ) {
				return $term->$info;
			} else {
				return $term;
			}
		}

	}
}

if ( ! function_exists( 'get_primary_taxonomy_link' ) ) {

	function get_primary_taxonomy_link( $post_id, $taxonomy = 'category', $link_classes = '' ) {
		$wpseo_primary_term = '';
		$prm_term = '';

		if (class_exists('WPSEO_Primary_Term')) {
			$wpseo_primary_term = new WPSEO_Primary_Term( $taxonomy, $post_id );
			$prm_term           = $wpseo_primary_term->get_primary_term();
		}
		if ( ! is_object( $wpseo_primary_term ) || empty( $prm_term ) ) {
			$term = wp_get_post_terms( $post_id, $taxonomy );
			if ( isset( $term ) && ! empty( $term ) ) {
				$link = '<a class="' . $link_classes . '" href="' . get_term_link( $term[0] ) . '">' . $term[0]->name . '</a>';
				return $link;
			} else {
				return '';
			}
		}

		$term_id = $wpseo_primary_term->get_primary_term();
		$term = get_term( $term_id, $taxonomy );

		$link = '<a class="' . $link_classes . '" href="' . get_term_link( $term ) . '">' . $term->name . '</a>';
		return $link;

	}
}

function legacy_get_average_color($filename, $as_hex_string = true) {
	try {
// Read image file with Image Magick
		$image = new Imagick($filename);
// Scale down to 1x1 pixel to make Imagick do the average
		$image->scaleimage(1, 1);
		/** @var ImagickPixel $pixel */
		if(!$pixels = $image->getimagehistogram()) {
			return null;
		}
	} catch(ImagickException $e) {
// Image Magick Error!
		return null;
	} catch(Exception $e) {
// Unknown Error!
		return null;
	}
	$pixel = reset($pixels);
	$rgb = $pixel->getcolor();
	if($as_hex_string) {
		return sprintf('%02X%02X%02X', $rgb['r'], $rgb['g'], $rgb['b']);
	}
	return $rgb;
}

function get_average_color($filename, $as_hex_string = true) {
	return 'CFE0DD';
}

function get_related_portfolio( $taxonomies = array(), $classes = '', $number = 4, $view_all = true ) {

	echo '<div class="grid-x grid-offset related-portfolio-items" data-equalizer>';

	global $post;

	$not_in = array( get_the_ID() );

	if ( $view_all ) {
		$number--;
	}

	foreach ( $taxonomies as $taxonomy ) {

		if ( $number > 0 ) {

			$tax_slug = get_primary_taxonomy( get_the_ID(), $taxonomy, 'slug' );

			$tax_args = array(
				'post_type'      => 'portfolio',
				'post__not_in'   => $not_in,
				'posts_per_page' => $number,
				'tax_query'      => array(
					array(
						'taxonomy' => $taxonomy,
						'field'    => 'slug',
						'terms'    => $tax_slug,
					),
				),
			);

			$tax_query = new WP_Query( $tax_args );

			if ( $tax_query->have_posts() ) {
				while ( $tax_query->have_posts() ) : $tax_query->the_post();

					get_loop_block( get_post_type(), '', '', '', $classes);

					$not_in[] = get_the_ID();
					$number--;

				endwhile;
				wp_reset_postdata();
			}
		}
	}

	if ( $number > 0 ) {
		$remainder_args = array(
			'post_type'      => 'portfolio',
			'post__not_in'   => $not_in,
			'posts_per_page' => $number,
		);

		$remainder_query = new WP_Query( $remainder_args );

		if ( $remainder_query->have_posts() ) {
			while ( $remainder_query->have_posts() ) : $remainder_query->the_post();

				get_loop_block( get_post_type(), '', '', '', $classes);

			endwhile;
			wp_reset_postdata();
		}
	}

	if ( $view_all == true ): ?>

		<article class="<?php echo $classes; ?> loop-portfolio view-all text-left">

			<div class="grid-x">
				<div class="small-12 cell clickable image-container cb-container background-light-gray" itemprop="image" data-equalizer-watch style="background-image: url(<?php // echo esc_url( $thumbnail ); ?>);">
					<img src="<?php //echo esc_url( $thumbnail ); ?>" />
					<div class="cb-bg" style="<?php //echo $thumb_style; ?>"></div>
					<div class="cb-overlay" style="<?php //echo $avg_bg; ?>"></div>
					<h2 class="entry-title"><a href="/portfolio/" itemprop="url"><?php esc_html_e( 'Full Portfolio', 'tmg'); ?></a></h2>
				</div>
			</div>

		</article>

	<?php endif;

	echo '</div>';
}

function wave_repeat() {
	ob_start();
	?>

	<div class="wave-top">
		<svg width="100%" height="100%">
			<defs>
				<pattern id="waves" x="0" y="0" width="100" height="100" patternUnits="userSpaceOnUse">
					<g transform="matrix(0.985222,0,0,1,602.956,15.94)">
			<path d="M-612,13.06L-612,-15.92C-602.35,-15.78 -595.77,-13.59 -590.44,-10.89C-587.86,-9.59 -585.57,-8.18 -583.38,-6.82C-577.26,-3.02 -572.43,-0.01 -561.81,-0.01C-551.18,-0.01 -546.35,-3.02 -540.23,-6.82C-538.04,-8.18 -535.76,-9.59 -533.17,-10.89C-527.64,-13.69 -520.76,-15.94 -510.51,-15.94C-510.507,-15.94 -510.503,-15.94 -510.5,-15.94L-510.5,13.06L-612,13.06Z" style="fill:rgb(104,92,86);"/>
		</g>
				</pattern>
			</defs>

			<rect x="0" y="0" width="50%" height="100%" style="transform: translateX(50%);" fill="url(#waves)" />
			<rect x="0" y="0" width="50%" height="100%" style="transform-origin: center center; transform: scaleX(-1) translateX(50%);" fill="url(#waves)" />
		</svg>
	</div>

	<?php $waves = ob_get_contents();
	ob_end_clean();

	echo $waves;
}