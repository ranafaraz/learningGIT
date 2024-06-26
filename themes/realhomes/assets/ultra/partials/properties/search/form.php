<?php
/**
 * Properties Search Form
 *
 * @since      4.0.0
 * @package    realhomes
 * @subpackage ultra
 */

if ( inspiry_is_search_fields_configured() ) :
	$theme_search_fields = inspiry_get_search_fields();
	$theme_top_row_fields = get_option( 'inspiry_search_fields_main_row', '4' );

//	$location_select_counter = inspiry_get_locations_number();

	?>
    <div class="rh-ultra-search-form-wrapper">
        <form class="rh-ultra-search-form rh_prop_search__form rh_prop_search_form_header advance-search-form"
              action="<?php echo esc_url( inspiry_get_search_page_url() ); ?>" method="get">

            <div class="rh-ultra-search-form-inner">
                <div class="rh-top-search-fields">
                    <div class="rh-top-search-box <?php echo esc_attr( 'rhea_top_fields_count_'  ) ?>"
<!--                         id="top---><?php //echo esc_attr( $this->get_id() ); ?><!--"-->
                    >
                    </div>
                </div>


            </div>
            <!-- /.rh_prop_search__fields -->

            <div class="rh_prop_search__buttons">
				<?php
				/**
				 * Search Button
				 */
				get_template_part( 'assets/ultra/partials/properties/search/fields/button' );
				?>
            </div>
            <!-- /.rh_prop_search__buttons -->

        </form>
    </div>
    <!-- /.rh_prop_search__form -->

<?php
endif;
