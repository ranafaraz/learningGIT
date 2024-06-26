<?php
/**
 * Gallery
 *
 * @package    realhomes/modern
 */
?>
<section class="rh_section rh_wrap--padding rh_wrap--topPadding">
	<?php
	// Display any contents after the page banner and before the contents.
	do_action( 'inspiry_before_page_contents' );
	?>
    <div class="rh_page">

		<?php
		$inspiry_gallery_properties_sorting = get_option( 'inspiry_gallery_properties_sorting', 'hide' );
		if ( 'show' === $inspiry_gallery_properties_sorting ) {
			?>
            <div class="rh_page__head">
                <div class="rh_page__controls">
					<?php get_template_part( 'assets/modern/partials/properties/sort-controls' ); ?>
                </div>
            </div><!-- /.rh_page__head -->
			<?php
		}
		?>

        <div class="rh_page__head">
            <h2 class="rh_page__title">
			    <?php $page_title = get_the_title( get_the_ID() ); ?>
                <p class="title"><?php echo esc_html( $page_title ); ?></p>
            </h2><!-- /.rh_page__title -->
		    <?php
		    $status_items               = array();
		    $gallery_properties_filters = get_option( 'realhomes_gallery_properties_filters', 'show' );
		    if ( 'show' === $gallery_properties_filters ) {
			    /* Getting the property status terms and assigning these a
				 * unique key to manage in isotopes for all languages properly.
				 * */
			    if ( class_exists( 'ERE_Data' ) ) {
				    $status_terms = ERE_Data::get_statuses_slug_name();
				    $count        = 1;
				    foreach ( $status_terms as $term ) {
					    $status_items[ 'status-' . $count ] = $term;
					    $count++;
				    }
				    ?>
                    <div id="filter-by" class="rh_page__gallery_filters">
                        <a href="#" data-filter="rh_gallery__item" class="active">
						    <?php esc_html_e( 'All', 'framework' ); ?>
                        </a>
					    <?php
					    if ( 0 < count( $status_items ) ) {
						    foreach ( $status_items as $item_key => $item_name ) {
							    echo '<a href="#" data-filter="' . esc_attr( $item_key ) . '" title="' . sprintf( esc_html__( 'View all Properties having %s status', 'framework' ), esc_attr( $item_name ) ) . '">' . esc_html( $item_name ) . '</a>';
						    }
					    }
					    ?>
                    </div><!-- /.rh_page__gallery_filters -->
				    <?php
			    }
		    }
		    ?>
        </div><!-- /.rh_page__head -->

		<?php
		$get_content_position = get_post_meta( get_the_ID(), 'REAL_HOMES_content_area_above_footer', true );
		if ( $get_content_position !== '1' ) {
			if ( have_posts() ) {
				while ( have_posts() ) {
					the_post();
					$the_contents = get_the_content();
					?>
                    <div class="rh_content <?php echo ! empty( $the_contents ) ? 'rh_page__content' : ''; ?>">
						<?php echo wp_kses_post( $the_contents ); ?>
                    </div>
					<?php
				}
			}
		}
		?>

        <div class="rh_gallery">
            <div class="rh_gallery__wrap isotope">
				<?php
				if ( isset( $args['gallery_column_class'] ) ) {
					$gallery_name = $args['gallery_column_class'];
				}

				$paged = 1;
				if ( get_query_var( 'paged' ) ) {
					$paged = get_query_var( 'paged' );
				} else if ( get_query_var( 'page' ) ) { // if is static front page
					$paged = get_query_var( 'page' );
				}

				// Gallery Query.
				$gallery_listing_args = array(
					'post_type' => 'property',
					'paged'     => $paged,
				);

				/**
				 * Gallery Property Arguments Filter.
				 *
				 * @var array
				 */
				$gallery_listing_args = apply_filters( 'inspiry_gallery_properties_filter', $gallery_listing_args );

				if ( 'show' === $inspiry_gallery_properties_sorting ) {
					$gallery_listing_args = sort_properties( $gallery_listing_args );
				}

				// Gallery Query and Start of Loop.
				$gallery_query = new WP_Query( $gallery_listing_args );
				while ( $gallery_query->have_posts() ) :
					$gallery_query->the_post();

					// Getting list of property status terms.
					$term_list = $gallery_name;
					$terms     = get_the_terms( get_the_ID(), 'property-status' );

					/* Condition to make sure that terms doesn't have a wp_error
					 * also that the assigned status keys variable is set as
					 * array and has at least one item in it.
					 * */
					if (
						! empty( $terms ) &&
						! is_wp_error( $terms ) &&
						is_array( $status_items ) &&
						0 < count( $status_items )
					) {
						/* Managing a terms list with assigned substitute
						 * keys and term names for the classes to be used
						 * with isotopes js library.
						 * */
						foreach ( $terms as $term ) {
							$term_list .= ' ';
							foreach ( $status_items as $item_key => $item ) {
								if ( $item === $term->name ) {
									$term_list .= $item_key;
									$term_list .= ' ';
									$term_list .= $term->slug;
								}
							}
						}
					}

					if ( has_post_thumbnail() ) :
						?>
                        <div class="rh_gallery__item isotope-item <?php echo esc_attr( $term_list ); ?>">
							<?php
							$image_id       = get_post_thumbnail_id();
							$full_image_url = wp_get_attachment_url( $image_id );
							$featured_image = wp_get_attachment_image_src( $image_id, 'modern-property-child-slider' );
							?>
                            <figure>
                                <div class="media_container">
                                    <a data-fancybox-trigger="gallery-<?php echo esc_attr( get_the_ID() ); ?>" data-this-id="<?php echo esc_attr( get_the_ID() ); ?>" class="zoom" href="javascript:;" title="<?php the_title_attribute(); ?>">
										<?php inspiry_safe_include_svg( '/images/icons/icon-zoom.svg' ); ?>
                                    </a>
                                    <a class="link" href="<?php the_permalink(); ?>">
										<?php inspiry_safe_include_svg( '/images/icons/icon-link.svg' ); ?>
                                    </a>
                                </div>
								<?php echo '<img class="img-border" src="' . esc_attr( $featured_image[0] ) . '" alt="' . the_title_attribute( 'echo=0' ) . '">'; ?>
                            </figure>
                            <h5 class="item-title entry-title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h5>

							<?php
							$get_post_meta_image = get_post_meta( get_the_ID(), 'REAL_HOMES_property_images', false );
							$get_prop_images     = count( $get_post_meta_image );
							?>
                            <div class="rh_property_images_load" style="display: none">
								<?php
								foreach ( $get_post_meta_image as $item ) {
									$images_src = wp_get_attachment_image_src( $item, 'post-featured-image' );

									if ( ! empty( $images_src[0] ) ) {
										?>
                                        <span style="display: none;" data-fancybox="gallery-<?php echo esc_attr( get_the_ID() ); ?>" data-src="<?php echo esc_url( $images_src[0] ); ?>" data-thumb="<?php echo esc_url( $images_src[0] ); ?>"></span>
										<?php
									}
								}
								?>

                            </div>
                        </div>

					<?php
					endif;
				endwhile;
				wp_reset_postdata();
				?>
            </div><!-- /.rh_gallery__wrap isotope -->
        </div><!-- /.rh_gallery -->

		<?php inspiry_theme_pagination( $gallery_query->max_num_pages ); ?>

    </div><!-- /.rh_page rh_page__main -->

</section>
<?php
if ( '1' === $get_content_position ) {
	if ( have_posts() ) {
		while ( have_posts() ) {
			the_post(); ?>
            <div class="rh_content <?php if ( get_the_content() ) {
				echo esc_attr( 'rh_page__content' );
			} ?>">
				<?php the_content(); ?>
            </div><!-- /.rh_content -->
			<?php
		}
	}
}
?>
<!-- /.rh_section rh_wrap rh_wrap--padding -->