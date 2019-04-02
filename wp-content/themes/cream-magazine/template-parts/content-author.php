<?php
/**
 * Template part for displaying author detail
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Cream_Magazine
 */
$enable_author_section = cream_magazine_get_option( 'cream_magazine_enable_author_section' );
if( $enable_author_section == true ) {
	?>
	<div class="author_box">
	    <div class="row clearfix">
	        <div class="col-md-3 col-sm-3 col-xs-12">
	            <div class="author_thumb">
	            	<?php echo get_avatar( get_the_author_meta( 'ID' ), 300 ); ?>
	            </div><!-- .author_thumb -->
	        </div><!-- .col -->
	        <div class="col-md-9 col-sm-9 col-xs-12">
	            <div class="author_details">
	                <div class="author_name">
	                    <h3><?php echo get_the_author(); ?></h3>
	                </div><!-- .author_name -->
	                <div class="author_desc">
	                    <?php the_author_meta('description'); ?>
	                </div><!-- .author_desc -->
	            </div><!-- .author_details -->
	        </div><!-- .col -->
	    </div><!-- .row -->
	</div><!-- .author_box -->
	<?php
}
