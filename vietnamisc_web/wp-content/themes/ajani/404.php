<?php
get_header(); 

$image_404      = boldthemes_get_404_image();
?>
        <section class="btErrorPage btPageHeadline gutter bt_bb_section bt_bb_top_spacing_large bt_bb_bottom_spacing_large bt_bb_layout_boxed_1200 bt_bb_vertical_align_top bt_bb_background_image bt_bb_background_overlay_dark_solid"  style="background-image: url('<?php echo esc_url_raw( $image_404 )?>')">
                <div class="bt_bb_port">
                        <div class="bt_bb_cell">
                                <div class="bt_bb_cell_inner">
                                        <div class="bt_bb_row" data-structure="12">
                                                <div class="bt_bb_column col-md-12 col-ms-12 bt_bb_align_center bt_bb_vertical_align_top bt_bb_animation_fade_in animate bt_bb_padding_normal animated" data-width="12">
                                                        <div class="bt_bb_column_content">
                                                                <?php echo boldthemes_get_heading_html( 
                                                                        array ( 
                                                                                'superheadline' => esc_html__( 'We can\'t find the page you\'re looking for.', 'ajani' ), 
                                                                                'headline' => esc_html__( 'Error 404.', 'ajani' ),
                                                                                'subheadline' => '<span class="bt_bb_button bt_bb_color_scheme_4 bt_bb_style_filled bt_bb_size_normal bt_bb_width_inline"><a class="bt_bb_link" href="' . home_url( '/' ) . '"><span class="bt_bb_button_text">' . esc_html__( 'Go back to homepage', 'ajani' ) . '</span></a></span>',
                                                                                'size' => 'huge'
                                                                                ) 
                                                                        )
                                                                ?>
                                                        </div>
                                                </div>
                                        </div>
                                </div>
                        </div>
                </div>
        </section>
<?php get_footer();