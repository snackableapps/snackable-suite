<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Cream_Magazine
 */

get_header();
	?>
	<div class="cm-container">
	    <div class="inner-page-wrapper">
	        <div id="primary" class="content-area">
	            <main id="main" class="site-main">
	                <div class="cm_search_page">
	                    <?php
	                    /**
						* Hook - cream_magazine_breadcrumb.
						*
						* @hooked cream_magazine_breadcrumb_action - 10
						*/
						do_action( 'cream_magazine_breadcrumb' );
	                    ?>
	                    <div class="row">
	                    	<div class="search-container clearfix">
		                    	<?php
		                    	$sidebar_position = cream_magazine_sidebar_position();
		                    	$class = cream_magazine_main_container_class();
		                    	if( $sidebar_position == 'left' && is_active_sidebar( 'sidebar' ) ) {
		                    		get_sidebar();
		                    	}
		                    	?>
		                        <div class="<?php echo esc_attr( $class ); ?>">
		                            <div class="content-entry">
		                            	<?php
		                            	if( have_posts() ) {
			                            	?>
			                                <section class="list_page_iner">
			                                    <div class="section-title">
			                                    	<h2>
														<?php
														/* translators: %s: search query. */
														printf( esc_html__( 'Search Results for: %s', 'cream-magazine' ), '<span>' . get_search_query() . '</span>' );
														?>
													</h2><!-- .list_head -->
			                                    </div><!-- .section-title -->
		                                		<div class="list_entry">
	                                                <section class="cm-post-widget-three">
	                                                    <div class="section_inner">
	                                                        <div class="row">
	                                                            <?php
	                                                            $break = 0;
				                                            	/* Start the Loop */
																while ( have_posts() ) {
																	the_post();
																	if( $sidebar_position != 'none' ) {
																		if( $break%2 == 0 && $break > 0 ) {
																			?>
																			<div class="row clearfix visible-sm visible-md visible-lg"></div>
																			<?php
																		}
																	} else {
																		if( $break%3 == 0 && $break > 0 ) {
																			?>
																			<div class="row clearfix visible-md visible-lg"></div>
																			<?php
																		}
																		if( $break%2 == 0 && $break > 0 ) {
																			?>
																			<div class="row clearfix visible-sm"></div>
																			<?php
																		}
																	}

																	/*
																	 * Include the Post-Type-specific template for the content.
																	 * If you want to override this in a child theme, then include a file
																	 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
																	 */
																	get_template_part( 'template-parts/layout/layout', 'grid' );

																	$break++;
																}
																?>
	                                                        </div><!-- .row -->
	                                                    </div><!-- .section_inner -->
	                                                </section><!-- .cm-post-widget-three -->
	                                            </div><!-- .list_entry -->
			                                </section><!-- .section list -->
			                                <?php
					                        /**
											* Hook - cream_magazine_pagination.
											*
											* @hooked cream_magazine_pagination_action - 10
											*/
											do_action( 'cream_magazine_pagination' );
										} else {
											get_template_part( 'template-parts/content', 'none' );
										}
										?>
		                            </div><!-- .content-entry -->
		                        </div>
		                        <?php 
		                        if( $sidebar_position == 'right' && is_active_sidebar( 'sidebar' ) ) {
		                    		get_sidebar();
		                    	}
		                        ?>
		                    </div><!-- .search-container -->
	                    </div><!-- .row -->
	                </div><!-- .cm_archive_page -->
	            </main><!-- #main.site-main -->
	        </div><!-- #primary.content-area -->
	    </div><!-- .inner-page-wrapper -->
	</div><!-- .cm-container -->
	<?php
get_footer();
