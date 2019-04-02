<?php
/**
 * Custom functions for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Cream_Magazine
 */
/*
 * Menu Wrapper
 */
if( ! function_exists( 'cream_magazine_main_menu_wrap' ) ) {
	
	function cream_magazine_main_menu_wrap() {

		$show_home_icon = cream_magazine_get_option( 'cream_magazine_enable_home_button' );

	  	$wrap  = '<ul id="%1$s" class="%2$s">';
	  	if( $show_home_icon == true ) {
	  		$wrap .= '<li class="home-btn"><a href="' . esc_url( home_url( '/' ) ) . '"><i class="feather icon-home" aria-hidden="true"></i></a></li>';
	  	}
	  	$wrap .= '%3$s';
	  	$wrap .= '</ul>';

	  	return $wrap;
	}
}


/**
 * Fallback For Main Menu
 */


if ( !function_exists( 'cream_magazine_navigation_fallback' ) ) {

    function cream_magazine_navigation_fallback() {

    	$show_home_icon = cream_magazine_get_option( 'cream_magazine_enable_home_button' );
        ?>
        <ul>
        	<?php if( $show_home_icon == true ) { ?>
	        	<li><a href="<?php echo esc_url( home_url( '/' ) );?>"><i class="feather icon-home" aria-hidden="true"></i></a></li>
	        <?php } ?>
            <?php 
                wp_list_pages( array( 
                    'title_li' => '', 
                    'depth' => 3,
                ) ); 
            ?>
        </ul>
        <?php    
    }
}

/*
 * Banner Post Query
 */
if( ! function_exists( 'cream_magazine_banner_query' ) ) {
	
	function cream_magazine_banner_query() {

		$banner_post_no = '';
		$banner_post_cats = cream_magazine_get_option( 'cream_magazine_banner_categories' );
		$banner_layout = cream_magazine_get_option( 'cream_magazine_select_banner_layout' );		
		$banner_post_no = absint( cream_magazine_get_option( 'cream_magazine_banner_posts_no' ) ) + 4 ;
		
		$banner_args = array(
		    'post_type' => 'post',
		);

		if( absint( $banner_post_no ) > 0 ) {
		    $banner_args['posts_per_page'] = absint( $banner_post_no );
		}

		if( !empty( $banner_post_cats ) ) {
		    $banner_args['category_name'] = implode( ',', $banner_post_cats );
		}  

		$banner_query = new WP_Query( $banner_args );

		return $banner_query;
	}
}

/*
 * Post Metas: Author, Date and Comments Number
 */
if( ! function_exists( 'cream_magazine_post_meta' ) ) {

	function cream_magazine_post_meta( $show_date, $show_author, $show_comments_no ) {

		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() )
		);

		$enable_date = cream_magazine_get_option( 'cream_magazine_enable_date_meta' );

		$enable_author = cream_magazine_get_option( 'cream_magazine_enable_author_meta' );

		$enable_comments_no = cream_magazine_get_option( 'cream_magazine_enable_comment_meta' );

		if( get_post_type() == 'post' ) {
			?>
			<div class="meta">
				<ul class="post_meta">
					<?php 
			        if( $enable_author == true ) {
				        if( $show_author == true ) {
				        	?>
				        	<li class="post_author">
				            	<?php
				            	printf(
									/* translators: %1$s: span i tag open, %2$s: span i tag close, %3$s: post author. */
									esc_html_x( '%1$s %2$s %3$s', 'post author', 'cream-magazine' ),
									'<span class="meta-icon"><i class="feather icon-user">', '</i></span>', '<a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a>'
								);
				            	?>
				            </li><!-- .post_author -->
				        	<?php
				        }
			        }

			        if( $enable_date == true ) {
						if( $show_date == true ) { 
							?>
				            <li class="posted_date">
				            	<?php
				            	printf(
									/* translators: %1$s: i tag open, %2$s: i tag close, %3$s: post date. */
									esc_html_x( '%1$s %2$s %3$s', 'post date', 'cream-magazine' ), '<span class="meta-icon"><i class="feather icon-calendar">', '</i></span>', '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
								);
				            	?>
				           	</li><!-- .posted_date -->
				           	<?php 
				        } 
			        }

			        if( $enable_comments_no == true ) {
				        if( $show_comments_no == true ) {
				        	if( ( comments_open() || get_comments_number() ) ) {
				        		?>
					            <li class="comments">
					            	<span class="meta-icon"><i class="feather icon-message-square"></i></span><a href="<?php the_permalink(); ?>"><?php echo esc_html( get_comments_number() ); ?></a>
					            </li><!-- .comments -->
					          	<?php
					        }
				        }
				    }
			        ?>
		        </ul><!-- .post_meta -->
		    </div><!-- .meta -->
			<?php
		}
	}
}

/*
 * Post Meta: Categories
 */
if( ! function_exists( 'cream_magazine_post_categories_meta' ) ) {

	function cream_magazine_post_categories_meta( $show_categories ) {

		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {

			if( $show_categories == true ) {

				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list();

				if ( $categories_list ) {
					?>
					<div class="entry_cats">
						<?php echo wp_kses_post( $categories_list ); // WPCS: XSS OK. ?>
					</div><!-- .entry_cats -->
					<?php
				}
			}
		}
	}
}

/*
 * Post Meta: Tags
 */
if( ! function_exists( 'cream_magazine_post_tags_meta' ) ) {

	function cream_magazine_post_tags_meta( $show_tags ) {

		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {

			$enable_tags_meta = cream_magazine_get_option( 'cream_magazine_enable_tag_meta' ); 

			if( $enable_tags_meta == true ) {

				/* translators: used between list items, there is a space after the comma */
				$tags_list = get_the_tag_list();

				if ( $tags_list ) {
					?>
					<div class="post_tags">
						<?php echo wp_kses_post( $tags_list ); // WPCS: XSS OK. ?>
					</div><!-- .post_tags -->
					<?php
				}
			}
		}
	}
}

/*
 * Function to define container class
 */
if( ! function_exists( 'cream_magazine_main_container_class' ) ) {

	function cream_magazine_main_container_class() {

		$sidebar_position = cream_magazine_sidebar_position();
		$is_sticky = cream_magazine_check_sticky_sidebar();
		$main_class = '';

		if( is_archive() || is_search() || is_home() || is_single() || is_page() ) {

			if( $sidebar_position != 'none' && is_active_sidebar( 'sidebar' ) ) {

				if( $is_sticky == true ) {

					$main_class = 'col-md-8 col-sm-12 col-xs-12 sticky_portion';
				} else {

					$main_class = 'col-md-8 col-sm-12 col-xs-12';	
				}
			} else {
				
				$main_class = 'col-md-12 col-sm-12 col-xs-12';
			}
		}
		return $main_class;
	}
}

/*
 * Function for post thumbnail
 */
if ( ! function_exists( 'cream_magazine_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function cream_magazine_post_thumbnail() {

		if ( post_password_required() || is_attachment() ) {
			return;
		}

		if( is_archive() || is_search() || is_home() ) {

			$thumbnail_size = '';

			if( is_archive() || is_home() ) {
				$thumbnail_size = 'cream-magazine-thumbnail-2';
			} 

			if( is_search() ) {
				$thumbnail_size = 'cream-magazine-thumbnail-3';
			}

			if( has_post_thumbnail() ) {

				$lazy_thumbnail = cream_magazine_get_option( 'cream_magazine_enable_lazy_load' );
				?>
				<div class="<?php cream_magazine_thumbnail_class(); ?>">
					<?php 
					if( $lazy_thumbnail == true ) {
						cream_magazine_lazy_thumbnail( $thumbnail_size );
					} else {
						cream_magazine_normal_thumbnail( $thumbnail_size );
					} 
					?>
				</div>
				<?php
			}
		}	


		if( is_single() || is_page() ) {

			if( has_post_thumbnail() ) {
				?>
				<div class="post_thumb">
				 	<a href="<?php the_permalink(); ?>">
				 		<?php the_post_thumbnail( 'full', array( 'alt' => the_title_attribute( array( 'echo' => false ) ) ) ); ?>
				 	</a>
				</div>
				<?php
			}
		}
	}
endif;


/**
 * Function to get lazy post thumbnail
 */
if( ! function_exists( 'cream_magazine_lazy_thumbnail' ) ) {

	function cream_magazine_lazy_thumbnail( $thumbnail_size ) {

		$thumbnail_url = get_the_post_thumbnail_url( get_the_ID(), $thumbnail_size );
		?>
	 	<a href="<?php the_permalink(); ?>">
		 	<img class="lazyload" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="<?php echo esc_url( $thumbnail_url ); ?>" data-srcset="<?php echo esc_url( $thumbnail_url ); ?>" alt="<?php cream_magazine_thumbnail_alt_text( get_the_ID() ); ?>">
		 	<noscript>
		 		<img src="<?php echo esc_url( $thumbnail_url ); ?>" srcset="<?php echo esc_url( $thumbnail_url ); ?>" class="image-fallback" alt="<?php cream_magazine_thumbnail_alt_text( get_the_ID() ); ?>">
		 	</noscript>
	 	</a>
		<?php
	}
}


/**
 * Function to get normal post thumbnail
 */
if( ! function_exists( 'cream_magazine_normal_thumbnail' ) ) {

	function cream_magazine_normal_thumbnail( $thumbnail_size ) {
		?>
	 	<a href="<?php the_permalink(); ?>">
		 	<?php the_post_thumbnail( $thumbnail_size, array( 'alt' => the_title_attribute( array( 'echo' => false ) ) ) ); ?>
	 	</a>
		<?php
	}
}


/**
 * Function to get post thumbnail Alt text
 */
if( !function_exists( 'cream_magazine_thumbnail_alt_text' ) ) {

    function cream_magazine_thumbnail_alt_text( $post_id ) {

        $post_thumbnail_id = get_post_thumbnail_id( $post_id );

        $alt_text = '';

        if( !empty( $post_thumbnail_id ) ) {

            $alt_text = get_post_meta( $post_thumbnail_id, '_wp_attachment_image_alt', true );
        }

	    if( !empty( $alt_text ) ) {

	    	echo esc_attr( $alt_text );
	    } else {

	    	the_title_attribute();
	    }
    }
}


/**
 * Filters For Excerpt Length
 */
if( !function_exists( 'cream_magazine_excerpt_length' ) ) :
    /*
     * Excerpt More
     */
    function cream_magazine_excerpt_length( $length ) {

        if( is_admin() ) {
            return $length;
        }

        $excerpt_length = cream_magazine_get_option( 'cream_magazine_post_excerpt_length' );

        if ( absint( $excerpt_length ) > 0 ) {
            $excerpt_length = absint( $excerpt_length );
        }

        return $excerpt_length;
    }
endif;
add_filter( 'excerpt_length', 'cream_magazine_excerpt_length' );