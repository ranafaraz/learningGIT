<?php
/**
 * This file contains the carousel variation of Single Property Gallery widget
 *
 * @version 2.3.0
 */
global $settings, $post_id, $properties_images, $widget_id;

$navigation_alignment_classes = '';
if ( ! empty( $settings['arrows_vertical_align'] ) ) {
	$navigation_alignment_classes .= 'rhea-image-carousel-arrows-vertical-' . $settings['arrows_vertical_align'];
}

if ( ! empty( $settings['arrows_align'] ) ) {
	$navigation_alignment_classes .= ' rhea-image-carousel-arrows-horizontal-' . $settings['arrows_align'];
}

if ( ! empty( $settings['arrows_navigation_wrapper_width'] ) ) {
	$navigation_alignment_classes .= ' rhea-image-carousel-arrows-wrapper-width-' . $settings['arrows_navigation_wrapper_width'];
}

$show_dots   = in_array( $settings['navigation'], [ 'dots', 'both' ] );
$show_arrows = in_array( $settings['navigation'], [ 'arrows', 'both' ] );
?>
    <div class="rhea-single-property-gallery-wrapper <?php echo esc_attr( $navigation_alignment_classes ); ?>" id="rhea-gallery-wrapper-<?php echo esc_attr( $widget_id ) ?>">
		<?php
		if ( $show_arrows ) {
			?>
            <div class="rhea-image-carousel-button-wrapper">
                <div class="rhea-image-carousel-button rhea-image-carousel-button-prev">
					<?php render_slick_button( 'previous' ); ?>
                    <span class="elementor-screen-only"><?php echo esc_html__( 'Previous', 'realhomes-elementor-addon' ); ?></span>
                </div>
                <div class="rhea-image-carousel-button rhea-image-carousel-button-next">
					<?php render_slick_button( 'next' ); ?>
                    <span class="elementor-screen-only"><?php echo esc_html__( 'Next', 'realhomes-elementor-addon' ); ?></span>
                </div>
            </div>
			<?php
		}
		?>
        <div class="rhea-single-property-gallery grid-carousel" id="rhea-gallery-carousel-<?php echo esc_attr( $widget_id ); ?>">
			<?php
			foreach ( $properties_images as $prop_image_id => $prop_image_meta ) {
				$lightbox_caption = 'data-caption="' . $prop_image_meta['title'] . '"';
				?>
                <div>
                    <a class="rhea-gallery-item" href="<?php echo esc_url( $prop_image_meta['full_url'] ) ?>" style='background-image: url("<?php echo esc_url( $prop_image_meta['full_url'] ) ?>")' data-fancybox="gallery-<?php echo esc_attr( $widget_id ) . '-' . esc_attr( $post_id ); ?>"
						<?php echo esc_attr( $lightbox_caption ) ?>>
                    </a>
                </div>
				<?php
			}
			?>
        </div>
    </div>
<?php
$slides_to_show = 1;
if ( ! empty( $settings['slides_to_show'] ) ) {
	$slides_to_show = $settings['slides_to_show'];
}

$slides_to_scroll = 1;
if ( ! empty( $settings['slides_to_scroll'] ) ) {
	$slides_to_scroll = $settings['slides_to_scroll'];
}

$slides_to_show_tablet = 1;
if ( ! empty( $settings['slides_to_show_tablet'] ) ) {
	$slides_to_show_tablet = $settings['slides_to_show_tablet'];
}

$slides_to_scroll_tablet = 1;
if ( ! empty( $settings['slides_to_scroll_tablet'] ) ) {
	$slides_to_scroll_tablet = $settings['slides_to_scroll_tablet'];
}

$slides_to_show_mobile = 1;
if ( ! empty( $settings['slides_to_show_mobile'] ) ) {
	$slides_to_show_mobile = $settings['slides_to_show_mobile'];
}

$slides_to_scroll_mobile = 1;
if ( ! empty( $settings['slides_to_scroll_mobile'] ) ) {
	$slides_to_scroll_mobile = $settings['slides_to_scroll_mobile'];
}

$carousel_options                         = array();
$carousel_options['wrapper']              = '#rhea-gallery-wrapper-' . esc_attr( $widget_id );
$carousel_options['id']                   = '#rhea-gallery-carousel-' . esc_attr( $widget_id );
$carousel_options['slidesToShow']         = (int)$slides_to_show;
$carousel_options['slidesToScroll']       = (int)$slides_to_scroll;
$carousel_options['slidesToShowTablet']   = (int)$slides_to_show_tablet;
$carousel_options['slidesToScrollTablet'] = (int)$slides_to_scroll_tablet;
$carousel_options['slidesToShowMobile']   = (int)$slides_to_show_mobile;
$carousel_options['slidesToScrollMobile'] = (int)$slides_to_scroll_mobile;
$carousel_options['speed']                = (int)$settings['speed'];
$carousel_options['autoplaySpeed']        = (int)$settings['autoplay_speed'];
$carousel_options['dots']                 = $show_dots;
$carousel_options['arrows']               = $show_arrows;
$carousel_options['autoplay']             = ( 'yes' == $settings['autoplay'] );
$carousel_options['pauseOnHover']         = ( 'yes' == $settings['pause_on_hover'] );
$carousel_options['pauseOnInteraction']   = ( 'yes' == $settings['pause_on_interaction'] );
$carousel_options['infinite']             = ( 'yes' == $settings['infinite'] );
$carousel_options['fade']                 = ( 'fade' == $settings['effect'] );
?>
    <script type="application/javascript">
        ( function ( $ ) {
            'use strict';
            $( document ).ready( function () {
                rheaImageCarousel(<?php echo wp_json_encode( $carousel_options ); ?>);
            } );
        } )( jQuery );
    </script>
<?php

function render_slick_button( $type ) {
	/**
	 * Display nav arrows button for slick slider
	 *
	 * @since 2.3.0
	 *
	 * @param string $type option to display key icon
	 */
	global $settings;
	$icon_settings = $settings[ 'navigation_' . $type . '_icon' ];

	if ( empty( $icon_settings['value'] ) ) {
		if ( 'previous' === $type ) {
			?>
            <svg width="24" height="16" viewBox="0 0 24 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M23 9H1C0.734784 9 0.48043 8.89464 0.292893 8.70711C0.105357 8.51957 0 8.26522 0 8C0 7.73478 0.105357 7.48043 0.292893 7.29289C0.48043 7.10536 0.734784 7 1 7H23C23.2652 7 23.5196 7.10536 23.7071 7.29289C23.8946 7.48043 24 7.73478 24 8C24 8.26522 23.8946 8.51957 23.7071 8.70711C23.5196 8.89464 23.2652 9 23 9Z" fill="#0A1510" />
                <path d="M2.41394 7.99992L8.70694 1.70692C8.8891 1.51832 8.98989 1.26571 8.98761 1.00352C8.98533 0.741321 8.88017 0.490508 8.69476 0.3051C8.50935 0.119692 8.25854 0.0145233 7.99634 0.0122448C7.73414 0.00996641 7.48154 0.110761 7.29294 0.292919L0.292939 7.29292C0.105468 7.48045 0.000152588 7.73475 0.000152588 7.99992C0.000152588 8.26508 0.105468 8.51939 0.292939 8.70692L7.29294 15.7069C7.48154 15.8891 7.73414 15.9899 7.99634 15.9876C8.25854 15.9853 8.50935 15.8801 8.69476 15.6947C8.88017 15.5093 8.98533 15.2585 8.98761 14.9963C8.98989 14.7341 8.8891 14.4815 8.70694 14.2929L2.41394 7.99992Z" fill="#0A1510" />
            </svg>
			<?php
		} else if ( 'next' === $type ) {
			?>
            <svg width="24" height="16" viewBox="0 0 24 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M1 9H23C23.2652 9 23.5196 8.89464 23.7071 8.70711C23.8946 8.51957 24 8.26522 24 8C24 7.73478 23.8946 7.48043 23.7071 7.29289C23.5196 7.10536 23.2652 7 23 7H1C0.734784 7 0.480429 7.10536 0.292892 7.29289C0.105356 7.48043 0 7.73478 0 8C0 8.26522 0.105356 8.51957 0.292892 8.70711C0.480429 8.89464 0.734784 9 1 9Z" fill="#0A1510" />
                <path d="M21.586 7.99992L15.293 1.70692C15.1109 1.51832 15.0101 1.26571 15.0124 1.00352C15.0146 0.741321 15.1198 0.490508 15.3052 0.3051C15.4906 0.119692 15.7414 0.0145233 16.0036 0.0122448C16.2658 0.00996641 16.5184 0.110761 16.707 0.292919L23.707 7.29292C23.8945 7.48045 23.9998 7.73475 23.9998 7.99992C23.9998 8.26508 23.8945 8.51939 23.707 8.70692L16.707 15.7069C16.5184 15.8891 16.2658 15.9899 16.0036 15.9876C15.7414 15.9853 15.4906 15.8801 15.3052 15.6947C15.1198 15.5093 15.0146 15.2585 15.0124 14.9963C15.0101 14.7341 15.1109 14.4815 15.293 14.2929L21.586 7.99992Z" fill="#0A1510" />
            </svg>
			<?php
		}
	} else {
		\Elementor\Icons_Manager::render_icon( $icon_settings, [ 'aria-hidden' => 'true' ] );
	}
}