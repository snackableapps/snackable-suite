<?php
/**
 * Template Name: Home
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Cream_Magazine
 */

get_header(); 

    $show_ticker_news_section = cream_magazine_get_option( 'cream_magazine_enable_ticker_news' );
    if( $show_ticker_news_section == true ) {
        ?>
        <div class="ticker-news-area">
            <div class="cm-container">
                    <?php
            		/**
                    * Hook - cream_magazine_ticker_news.
                    *
                    * @hooked cream_magazine_ticker_news_action - 10
                    */
                    do_action( 'cream_magazine_ticker_news' );
                ?>
            </div><!-- .cm-container -->
        </div><!-- .ticker-news-area -->
        <?php
    }

    
    $show_banner = cream_magazine_get_option( 'cream_magazine_enable_banner' );
    if( $show_banner == true ) {
        ?>
        <div class="banner-area">
            <div class="cm-container">
                <?php
                /**
                * Hook - cream_magazine_banner_slider.
                *
                * @hooked cream_magazine_banner_slider_action - 10
                */
                do_action( 'cream_magazine_banner_slider' );
                ?>
            </div><!-- .cm-container -->
        </div><!-- .banner-area -->
        <?php
    }

    if( is_active_sidebar( 'home-top-news-area' ) ) {
        ?>
        <div class="top-news-area news-area">
            <div class="cm-container">
                <?php
                /**
                * Hook - cream_magazine_top_news.
                *
                * @hooked cream_magazine_top_news_action - 10
                */
                do_action( 'cream_magazine_top_news' );
            	?>
            </div><!-- .cm-container -->
        </div><!-- .top-news-area.news-area -->
        <?php
    }
    ?>
    
    <div class="middle-news-area news-area">
        <div class="cm-container">
            <div class="left_and_right_layout_divider">
                <div class="row">
                    <?php
                    $sidebar_position = cream_magazine_get_option( 'cream_magazine_homepage_sidebar' );
                    if( $sidebar_position == 'left' ) {
                        get_sidebar();
                    }
                    ?>
                    <div class="col-md-8 col-sm-12 col-xs-12 sticky_portion">
                        <div id="primary" class="content-area">
                            <main id="main" class="site-main">
                                <?php
                                /**
                                * Hook - cream_magazine_middle_news.
                                *
                                * @hooked cream_magazine_middle_news_action - 10
                                */
                                do_action( 'cream_magazine_middle_news' );
                                ?>
                            </main><!-- #main.site-main -->
                        </div><!-- #primary.content-area -->
                    </div><!-- .col -->
                    <?php 
                    if( $sidebar_position == 'right' ) {
                        get_sidebar();
                    }
                    ?>
                </div><!-- .main row -->
            </div><!-- .left_and_right_layout_divider -->
        </div><!-- .cm-container -->
    </div><!-- .middle-news-area.news-area -->
    <?php
    if( is_active_sidebar( 'home-bottom-news-area' ) ) {
        ?>
        <div class="bottom-news-area news-area">
            <div class="cm-container">
                <?php
                /**
                * Hook - cream_magazine_top_news.
                *
                * @hooked cream_magazine_top_news_action - 10
                */
                do_action( 'cream_magazine_bottom_news' );
                ?>
            </div><!-- .cm-container -->
        </div><!-- .bottom-news-area.news-area -->
        <?php
    }
get_footer();