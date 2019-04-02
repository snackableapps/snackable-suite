<?php
/**
 * Template part for displaying banner layout five
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Cream_Magazine
 */

$banner_query = cream_magazine_banner_query();
$item_no = cream_magazine_get_option( 'cream_magazine_banner_posts_no' );

if( $banner_query->have_posts() ) {

    $show_categories_meta = cream_magazine_get_option( 'cream_magazine_enable_banner_categories_meta' );
    $show_author_meta = cream_magazine_get_option( 'cream_magazine_enable_banner_author_meta' );
    $show_date_meta = cream_magazine_get_option( 'cream_magazine_enable_banner_date_meta' );
    $show_cmnt_no_meta = cream_magazine_get_option( 'cream_magazine_enable_banner_cmnts_no_meta' );
    ?>
    <div class="cm_banner cm_banner-five">
        <div class="banner-inner">
            <div class="row">
                <div class="col-md-7 col-sm-12 col-xs-12 gutter-left">
                    <article class="card">
                        <div class="owl-carousel cm_banner-carousel-five">
                            <?php
                            $count = 0;
                            while( $banner_query->have_posts() ) {
                                $banner_query->the_post();
                                if( $count < $item_no ) {
                                    ?>
                                    <div class="item">
                                        <div class="<?php cream_magazine_thumbnail_class(); ?>" style="background-image: url(<?php esc_url( the_post_thumbnail_url( 'full' ) ); ?>)">
                                            <div class="post-holder">
                                                <?php cream_magazine_post_categories_meta( $show_categories_meta ); ?>
                                                <div class="post_title">
                                                   <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                                </div><!-- .post_title -->
                                                <?php cream_magazine_post_meta( $show_date_meta, $show_author_meta, $show_cmnt_no_meta ); ?>
                                            </div><!-- .post-holder -->
                                        </div>
                                        <!-- // post_thumb -->
                                    </div><!-- .item -->
                                    <?php
                                }
                                $count++;
                            }
                            wp_reset_postdata();
                            ?>
                        </div><!-- .owl-carousel -->
                    </article><!-- .card -->
                </div><!-- .col -->
                <div class="col-md-5 col-sm-12 col-xs-12 gutter-right">
                    <div class="right-content-holder">
                        <div class="custom_row clearfix">
                            <?php
                            $count = 0;
                            while( $banner_query->have_posts() ) {
                                $banner_query->the_post();
                                if( $count >= $item_no ) {
                                    ?>
                                    <div class="col small_posts">
                                        <article class="card">
                                            <div class="<?php cream_magazine_thumbnail_class(); ?>" style="background-image: url(<?php esc_url( the_post_thumbnail_url( 'full' ) ); ?>);">
                                                <div class="post-holder">
                                                    <?php cream_magazine_post_categories_meta( $show_categories_meta ); ?>
                                                    <div class="post_title">
                                                       <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                                    </div><!-- .post_title -->
                                                    <?php cream_magazine_post_meta( $show_date_meta, $show_author_meta, $show_cmnt_no_meta ); ?>
                                                </div><!-- .post-holder -->
                                            </div><!-- .post_thumb -->
                                        </article><!-- .card -->
                                    </div><!-- .col.small_posts -->
                                    <?php
                                }
                                $count++;
                            }
                            wp_reset_postdata();
                            ?>
                        </div><!-- .row -->
                    </div><!-- .right-content-holder -->
                </div><!-- .col -->
            </div><!-- .row -->
        </div><!-- .banner-inner -->
    </div><!-- .cm_banner -->
    <?php
}
