<?php
/**
 * This file contains the carousel variation of Ultra properties widget.
 *
 * @version 2.2.0
 */

global $settings, $widget_id, $properties_query;

$show_arrows = ( 'yes' === $settings['show_arrows'] );
$show_dots   = ( 'yes' === $settings['show_dots'] );
?>
<section class="rhea-ultra-properties-one-section rhea-ultra-tooltip rhea-toolip-light rhea-card-style-<?php echo $settings['card']?>">
    <div class="rhea-ultra-properties-one-wrapper owl-carousel" id="rhea-carousel-<?php echo esc_attr( $widget_id ); ?>">
		<?php
		while ( $properties_query->have_posts() ) {
			$properties_query->the_post();
			rhea_get_template_part( 'elementor/widgets/properties-widget/card-' . esc_html( $settings['card'] ) );
		}
		wp_reset_postdata();
		?>
    </div>
	<?php
	$dot_nav = sprintf( '<div id="rhea-dots-%s" class="rhea-ultra-owl-dots owl-dots"></div>', esc_attr( $widget_id ) );
	if ( $show_arrows ) {
		?>
        <div id="rhea-nav-<?php echo esc_attr( $widget_id ); ?>" class="rhea-ultra-carousel-nav-center rhea-ultra-nav-box rhea-ultra-owl-nav owl-nav">
			<?php
			if ( $show_dots ) {
				echo $dot_nav;
			}
			?>
        </div>
		<?php
	} else if ( $show_dots ) {
		?>
        <div class="rhea-ultra-carousel-nav-center rhea-ultra-nav-box rhea-ultra-owl-nav owl-nav">
			<?php echo $dot_nav; ?>
        </div>
		<?php
	}
	?>

</section>
<?php
$slides_to_show   = ! empty( $settings['slides_to_show'] ) ? $settings['slides_to_show'] : 3;
$slides_to_scroll = ! empty( $settings['slides_to_scroll'] ) ? $settings['slides_to_scroll'] : 1;

$slides_to_show_widescreen   = ! empty( $settings['slides_to_show_widescreen'] ) ? $settings['slides_to_show_widescreen'] : 3;
$slides_to_scroll_widescreen = ! empty( $settings['slides_to_scroll_widescreen'] ) ? $settings['slides_to_scroll_widescreen'] : 1;

$slides_to_show_tablet   = ! empty( $settings['slides_to_show_tablet'] ) ? $settings['slides_to_show_tablet'] : 2;
$slides_to_scroll_tablet = ! empty( $settings['slides_to_scroll_tablet'] ) ? $settings['slides_to_scroll_tablet'] : 1;

$slides_to_show_mobile   = ! empty( $settings['slides_to_show_mobile'] ) ? $settings['slides_to_show_mobile'] : 1;
$slides_to_scroll_mobile = ! empty( $settings['slides_to_scroll_mobile'] ) ? $settings['slides_to_scroll_mobile'] : 1;

$slide_margin            = ! empty( $settings['slide_margin'] ) ? $settings['slide_margin'] : 40;
$slide_margin_widescreen = ! empty( $settings['slide_margin_widescreen'] ) ? $settings['slide_margin_widescreen'] : 40;
$slide_margin_tablet     = ! empty( $settings['slide_margin_tablet'] ) ? $settings['slide_margin_tablet'] : 30;
$slide_margin_mobile     = ! empty( $settings['slide_margin_mobile'] ) ? $settings['slide_margin_mobile'] : 0;

$carousel_options                       = array();
$carousel_options['items']              = (int)$slides_to_show;
$carousel_options['slideBy']            = (int)$slides_to_scroll;
$carousel_options['smartSpeed']         = (int)$settings['speed'];
$carousel_options['autoplay']           = ( 'yes' == $settings['autoplay'] );
$carousel_options['autoplaySpeed']      = (int)$settings['autoplay_speed'];
$carousel_options['autoplayHoverPause'] = ( 'yes' == $settings['pause_on_hover'] );
$carousel_options['loop']               = ( 'yes' == $settings['infinite'] );
$carousel_options['rewind']             = ( 'yes' == $settings['infinite'] );
$carousel_options['rtl']                = is_rtl();
$carousel_options['nav']                = $show_arrows;
$carousel_options['navContainer']       = '#rhea-nav-' . esc_html( $widget_id );
if ( 'arrow' === $settings['nav_icon_style'] ) {
	$carousel_options['navText'] = [
		'<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M9.57 18.8201C9.38 18.8201 9.19 18.7501 9.04 18.6001L2.97 12.5301C2.68 12.2401 2.68 11.7601 2.97 11.4701L9.04 5.40012C9.33 5.11012 9.81 5.11012 10.1 5.40012C10.39 5.69012 10.39 6.17012 10.1 6.46012L4.56 12.0001L10.1 17.5401C10.39 17.8301 10.39 18.3101 10.1 18.6001C9.96 18.7501 9.76 18.8201 9.57 18.8201Z" fill="#07152D"/>
<path d="M20.5 12.75H3.66998C3.25998 12.75 2.91998 12.41 2.91998 12C2.91998 11.59 3.25998 11.25 3.66998 11.25H20.5C20.91 11.25 21.25 11.59 21.25 12C21.25 12.41 20.91 12.75 20.5 12.75Z" fill="#07152D"/>
</svg>',
		'<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M14.43 18.8191C14.24 18.8191 14.05 18.7491 13.9 18.5991C13.61 18.3091 13.61 17.8291 13.9 17.5391L19.44 11.9991L13.9 6.45914C13.61 6.16914 13.61 5.68914 13.9 5.39914C14.19 5.10914 14.67 5.10914 14.96 5.39914L21.03 11.4691C21.32 11.7591 21.32 12.2391 21.03 12.5291L14.96 18.5991C14.81 18.7491 14.62 18.8191 14.43 18.8191Z" fill="#07152D"/>
<path d="M20.33 12.75H3.5C3.09 12.75 2.75 12.41 2.75 12C2.75 11.59 3.09 11.25 3.5 11.25H20.33C20.74 11.25 21.08 11.59 21.08 12C21.08 12.41 20.74 12.75 20.33 12.75Z" fill="#07152D"/>
</svg>
'
	];
} else {
	$carousel_options['navText'] = [ '<i class="fas fa-caret-left"></i>', '<i class="fas fa-caret-right"></i>' ];
}
$carousel_options['dots']          = $show_dots;
$carousel_options['dotsEach']      = true;
$carousel_options['dotsContainer'] = '#rhea-dots-' . esc_html( $widget_id );
$carousel_options['responsive']    = array(
	0    => array(
		'items'   => (int)$slides_to_show_mobile,
		'slideBy' => (int)$slides_to_scroll_mobile,
		'margin'  => (int)$slide_margin_mobile,
	),
	768  => array(
		'items'   => (int)$slides_to_show_tablet,
		'slideBy' => (int)$slides_to_scroll_tablet,
		'margin'  => (int)$slide_margin_tablet,
	),
	1200 => array(
		'items'   => (int)$slides_to_show,
		'slideBy' => (int)$slides_to_scroll,
		'margin'  => (int)$slide_margin,
	),
	2400 => array(
		'items'   => (int)$slides_to_show_widescreen,
		'slideBy' => (int)$slides_to_scroll_widescreen,
		'margin'  => (int)$slide_margin_widescreen,
	),
);
?>
<script type="application/javascript">
    ( function ( $ ) {
        'use strict';
        $( document ).ready( function () {
            $( "#rhea-carousel-<?php echo esc_attr( $widget_id ); ?>" )
            .owlCarousel( <?php echo wp_json_encode( $carousel_options ); ?>);
        } );
    } )( jQuery );
</script>
