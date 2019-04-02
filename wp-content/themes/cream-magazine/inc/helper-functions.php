<?php
/**
 * Helper functions for this theme.
 *
 * @package Cream_Magazine
 */

if ( ! function_exists( 'cream_magazine_get_option' ) ) {

	/**
	 * Get theme option.
	 *
	 * @since 1.0.0
	 *
	 * @param string $key Option key.
	 * @return mixed Option value.
	 */
	function cream_magazine_get_option( $key ) {

	       if ( empty( $key ) ) {
			return;
		}

		$value = '';

		$default = cream_magazine_get_default_theme_options();

		$default_value = null;

		if ( is_array( $default ) && isset( $default[ $key ] ) ) {
			$default_value = $default[ $key ];
		}

		if ( null !== $default_value ) {
			$value = get_theme_mod( $key, $default_value );
		}
		else {
			$value = get_theme_mod( $key );
		}

		return $value;
	}
}


if ( ! function_exists( 'cream_magazine_get_default_theme_options' ) ) {

	/**
	 * Get default theme options.
	 *
	 * @since 1.0.0
	 *
	 * @return array Default theme options.
	 */

	function cream_magazine_get_default_theme_options() {

    	$defaults = array();

        $defaults['cream_magazine_select_site_layout'] = 'fullwidth';

    	$defaults['cream_magazine_enable_ticker_news'] = false;
    	$defaults['cream_magazine_ticker_news_title'] = esc_html__( 'Breaking News', 'cream-magazine' );
    	$defaults['cream_magazine_ticker_news_posts_no'] = 5;

    	$defaults['cream_magazine_enable_banner'] = false;
        $defaults['cream_magazine_banner_posts_no'] = 3;
        $defaults['cream_magazine_enable_banner_categories_meta'] = true;
        $defaults['cream_magazine_enable_banner_author_meta'] = true;
        $defaults['cream_magazine_enable_banner_date_meta'] = true;
    	$defaults['cream_magazine_enable_banner_cmnts_no_meta'] = true;

    	$defaults['cream_magazine_homepage_sidebar'] = 'right';

        $defaults['cream_magazine_enable_top_header'] = true;
    	$defaults['cream_magazine_enable_home_button'] = false;
    	$defaults['cream_magazine_enable_search_button'] = true;
        $defaults['cream_magazine_select_header_layout'] = 'header_1';
        
        $defaults['cream_magazine_enable_scroll_top_button'] = true;
    	$defaults['cream_magazine_copyright_credit'] = '';

        $defaults['cream_magazine_enable_blog_categories_meta'] = true;
        $defaults['cream_magazine_enable_blog_author_meta'] = true;
        $defaults['cream_magazine_enable_blog_date_meta'] = true;
        $defaults['cream_magazine_enable_blog_cmnts_no_meta'] = true;
    	$defaults['cream_magazine_select_blog_sidebar_position'] = 'right';

        $defaults['cream_magazine_enable_archive_categories_meta'] = true;
        $defaults['cream_magazine_enable_archive_author_meta'] = true;
        $defaults['cream_magazine_enable_archive_date_meta'] = true;
        $defaults['cream_magazine_enable_archive_cmnts_no_meta'] = true;
    	$defaults['cream_magazine_select_archive_sidebar_position'] = 'right';

        $defaults['cream_magazine_enable_search_categories_meta'] = true;
        $defaults['cream_magazine_enable_search_author_meta'] = true;
        $defaults['cream_magazine_enable_search_date_meta'] = true;
        $defaults['cream_magazine_enable_search_cmnts_no_meta'] = true;
    	$defaults['cream_magazine_select_search_sidebar_position'] = 'right';

        $defaults['cream_magazine_enable_post_single_tags_meta'] = true;
        $defaults['cream_magazine_enable_post_single_author_meta'] = true;
        $defaults['cream_magazine_enable_post_single_date_meta'] = true;
        $defaults['cream_magazine_enable_post_single_featured_image'] = true;
        $defaults['cream_magazine_enable_post_single_cmnts_no_meta'] = true;
    	$defaults['cream_magazine_enable_author_section'] = true;
    	$defaults['cream_magazine_enable_related_section'] = true;
    	$defaults['cream_magazine_related_section_title'] = '';
    	$defaults['cream_magazine_related_section_posts_number'] = 6;
        $defaults['cream_magazine_enable_related_section_categories_meta'] = true;
        $defaults['cream_magazine_enable_related_section_author_meta'] = true;
        $defaults['cream_magazine_enable_related_section_date_meta'] = true;
        $defaults['cream_magazine_enable_related_section_cmnts_no_meta'] = true;

    	$defaults['cream_magazine_enable_category_meta'] = true;
    	$defaults['cream_magazine_enable_date_meta'] = true;
    	$defaults['cream_magazine_enable_author_meta'] = true;
    	$defaults['cream_magazine_enable_tag_meta'] = true;
    	$defaults['cream_magazine_enable_comment_meta'] = true;

    	$defaults['cream_magazine_post_excerpt_length'] = 15;

        $defaults['cream_magazine_facebook_link'] = '';
        $defaults['cream_magazine_twitter_link'] = '';
        $defaults['cream_magazine_instagram_link'] = '';
        $defaults['cream_magazine_youtube_link'] = '';
        $defaults['cream_magazine_google_plus_link'] = '';
        $defaults['cream_magazine_vk_link'] = '';
        $defaults['cream_magazine_linkedin_link'] = '';
        $defaults['cream_magazine_vimeo_link'] = '';

        $defaults['cream_magazine_enable_breadcrumb'] = true;
        
        $defaults['cream_magazine_enable_sticky_sidebar'] = true;

        $defaults['cream_magazine_enable_lazy_load'] = false;

        $defaults['cream_magazine_primary_theme_color'] = '#FF3D00';

        if( class_exists( 'Woocommerce' ) ) {
            $defaults['cream_magazine_select_woocommerce_sidebar_position'] = 'right';
        }  


    	return $defaults;

	}
}


/**
 * Funtion To Get Google Fonts
 */
if ( !function_exists( 'cream_magazine_fonts_url' ) ) :

    /**
     * Return Font's URL.
     *
     * @since 1.0.0
     * @return string Fonts URL.
     */
    function cream_magazine_fonts_url() {

        $fonts_url = '';
        $fonts     = array();
        $subsets   = 'latin,latin-ext';

        /* translators: If there are characters in your language that are not supported by Merriweather, translate this to 'off'. Do not translate into your own language. */
        if ('off' !== _x('on', 'Roboto Condensed font: on or off', 'cream-magazine')) {

            $fonts[] = 'Roboto+Condensed:400,400i,700,700i';
        }

        /* translators: If there are characters in your language that are not supported by Merriweather, translate this to 'off'. Do not translate into your own language. */
        
        if ('off' !== _x('on', 'Muli font: on or off', 'cream-magazine')) {

            $fonts[] = 'Muli:400,400i,600,600i,700,700i';
        }

        $fonts = array_unique( $fonts );

        if ( $fonts ) {
            $fonts_url = add_query_arg( array(
                'family' => urlencode( implode( '|', $fonts ) ),
                'subset' => urlencode( $subsets ),
            ), '//fonts.googleapis.com/css' );
        }

        return $fonts_url;
    }
endif;


/**
 * Funtion To Get Sidebar Position
 */
if ( !function_exists( 'cream_magazine_sidebar_position' ) ) :

    /**
     * Return Position of Sidebar.
     *
     * @since 1.0.0
     * @return string Fonts URL.
     */
    function cream_magazine_sidebar_position() {

        $sidebar_position = '';

        if( class_exists( 'Woocommerce' ) ) {
            if( is_woocommerce() || is_cart() || is_account_page() || is_checkout() ) {

                $sidebar_position = cream_magazine_get_option( 'cream_magazine_select_woocommerce_sidebar_position' );
            } else {
                
                if( is_home() ) {
                    $sidebar_position = cream_magazine_get_option( 'cream_magazine_select_blog_sidebar_position' );
                }

                if( is_archive() ) {
                    $sidebar_position = cream_magazine_get_option( 'cream_magazine_select_archive_sidebar_position' );
                }

                if( is_search() ) {
                    $sidebar_position = cream_magazine_get_option( 'cream_magazine_select_search_sidebar_position' );
                }

                if( is_single() ) {
                    $sidebar_position = get_post_meta( get_the_ID(), 'cream_magazine_sidebar_position', true );
                }

                if( is_page() ) {
                    $sidebar_position = get_post_meta( get_the_ID(), 'cream_magazine_sidebar_position', true );
                }
            }
        } else {
            if( is_home() ) {
                $sidebar_position = cream_magazine_get_option( 'cream_magazine_select_blog_sidebar_position' );
            }

            if( is_archive() ) {
                $sidebar_position = cream_magazine_get_option( 'cream_magazine_select_archive_sidebar_position' );
            }

            if( is_search() ) {
                $sidebar_position = cream_magazine_get_option( 'cream_magazine_select_search_sidebar_position' );
            }

            if( is_single() ) {
                $sidebar_position = get_post_meta( get_the_ID(), 'cream_magazine_sidebar_position', true );
            }

            if( is_page() ) {
                $sidebar_position = get_post_meta( get_the_ID(), 'cream_magazine_sidebar_position', true );
            }
        }
        
        if( empty( $sidebar_position ) ) {
            $sidebar_position = 'right';
        }

        return $sidebar_position;
    }
endif;



/**
 * Funtion To Check Sidebar Sticky
 */
if ( !function_exists( 'cream_magazine_check_sticky_sidebar' ) ) :

    /**
     * Return True or False
     *
     * @since 1.0.0
     * @return boolean.
     */
    function cream_magazine_check_sticky_sidebar() {

        $is_sticky_sidebar = cream_magazine_get_option( 'cream_magazine_enable_sticky_sidebar' );

        if( $is_sticky_sidebar == true ) {
            return true;
        } else {
            return false;
        }
    }
endif;


/**
 * Function To Get Woocommerce Sidebar
 */
if( ! function_exists( 'cream_magazine_woocommerce_sidebar' ) ) {

    function cream_magazine_woocommerce_sidebar() {

        if( is_active_sidebar( 'woocommerce-sidebar' ) ) {

            $sidebar_class = '';

            $is_sticky = cream_magazine_check_sticky_sidebar();

            if( $is_sticky == true ) {
                $sidebar_class .= 'col-md-4 col-sm-12 col-xs-12 sticky_portion';
            } else {
                $sidebar_class .= 'col-md-4 col-sm-12 col-xs-12';
            }

            ?>
            <div class="<?php echo esc_attr( $sidebar_class ); ?>">
                <aside id="secondary" class="sidebar-widget-area">
                    <?php dynamic_sidebar( 'woocommerce-sidebar' ); ?>
                </aside><!-- #secondary -->
            </div><!-- .col.sticky_portion -->
            <?php
        }
    }
}


/**
 * Function To Get Thumbnail Class
 */
if( ! function_exists( 'cream_magazine_thumbnail_class' ) ) {

    function cream_magazine_thumbnail_class() {

        $thumbnail_class = 'post_thumb imghover';

        $lazy_thumbnail = cream_magazine_get_option( 'cream_magazine_enable_lazy_load' );

        if( $lazy_thumbnail == true ) {

            $thumbnail_class .= ' lazy-thumb lazyloading';
        }

        echo esc_attr( $thumbnail_class );
    }
}


/*
 * Hook - Plugin Recommendation
 */
if ( ! function_exists( 'cream_magazine_recommended_plugins' ) ) :
    /**
     * Recommend plugins.
     *
     * @since 1.0.0
     */
    function cream_magazine_recommended_plugins() {

        $plugins = array(
            array(
                'name'     => esc_html__( 'Themebeez Toolkit', 'cream-magazine' ),
                'slug'     => 'themebeez-toolkit',
                'required' => false,
            ),
        );

        tgmpa( $plugins );
    }
endif;
add_action( 'tgmpa_register', 'cream_magazine_recommended_plugins' );