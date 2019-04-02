<?php

class Cream_Magazine_News_Widget_One extends WP_Widget {
 
    function __construct() { 

        parent::__construct(
            'cream-magazine-news-widget-one',  // Base ID
            esc_html__( 'CM Full: News Widget One', 'cream-magazine' ),   // Name
            array(
                'description' => esc_html__( 'Displays posts of selected category.', 'cream-magazine' ), 
            )
        );
 
    }
 
    public function widget( $args, $instance ) {

        $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

		$post_cat = !empty( $instance[ 'post_cat' ] ) ? $instance[ 'post_cat' ] : 'none';

		$post_no = !empty( $instance[ 'post_no' ] ) ? $instance[ 'post_no' ] : 6;

        $show_categories_meta = $instance['show_categories_meta'];

        $show_author_meta = $instance['show_author_meta'];

        $show_date_meta = $instance['show_date_meta'];

        $show_cmnt_no_meta = $instance['show_cmnt_no_meta'];

		$post_args = array(
			'post_type' => 'post',
		);

        if( $post_cat != 'none' ) {
            $post_args['category_name'] = sanitize_text_field( $post_cat );
        }

        if( absint( $post_no ) > 0 ) {
            $post_args['posts_per_page'] = absint( $post_no );
        }

        $half_post_no = absint( $post_no )/2;

		$post_query = new WP_Query( $post_args );

		if( $post_query->have_posts() ) {
            ?>
            <section class="cm-post-widget-two cm-post-widget-section">
                <div class="section_inner">
                    <?php 
                    if( !empty( $title ) ) {
                        ?>
                        <div class="section-title">
                            <h2><?php echo esc_html( $title ); ?></h2>
                        </div><!-- .section-title -->
                        <?php
                    } 
                    ?>      
                    <div class="row clearfix">
                        <?php
                        $count = 0;
                        while( $post_query->have_posts() ) {
                            $post_query->the_post();

                            if( $count <= 1 ) {
                                ?>
                                <div class="col-md-6 col-sm-12 col-xs-12">
                                    <article class="big-card">
                                        <div class="<?php cream_magazine_thumbnail_class(); ?>">
                                            <?php
                                            if( has_post_thumbnail() ) {
                                                
                                                $lazy_thumbnail = cream_magazine_get_option( 'cream_magazine_enable_lazy_load' );

                                                if( $lazy_thumbnail == true ) {
                                                    cream_magazine_lazy_thumbnail( 'cream-magazine-thumbnail-2' );
                                                } else {
                                                    cream_magazine_normal_thumbnail( 'cream-magazine-thumbnail-2' );
                                                }
                                            }
                                            ?>
                                            <div class="post-holder">
                                                <?php cream_magazine_post_categories_meta( $show_categories_meta ); ?>
                                                <div class="post_title">
                                                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                                </div>
                                                <?php cream_magazine_post_meta( $show_date_meta, $show_author_meta, $show_cmnt_no_meta ); ?>
                                            </div><!-- .post-holder -->
                                        </div><!-- .post_thumb -->
                                    </article><!-- .card -->
                                    <!-- <div class="mask"></div> --><!-- .mask -->
                                </div><!-- .col -->
                                <?php
                            }
                            $count++;
                        }
                        wp_reset_postdata();
                        ?>
                    </div><!-- .row.clearfix -->
                    <div class="row clearfix">
                        <?php
                        $count = 0;
                        while( $post_query->have_posts() ) {
                            $post_query->the_post();

                            if( $count > 1 ) {
                                ?>
                                <div class="col-md-3 col-sm-6 col-xs-12">
                                    <div class="small-card">
                                        <div class="<?php cream_magazine_thumbnail_class(); ?>">
                                            <?php
                                            if( has_post_thumbnail() ) {
                                                
                                                $lazy_thumbnail = cream_magazine_get_option( 'cream_magazine_enable_lazy_load' );

                                                if( $lazy_thumbnail == true ) {
                                                    cream_magazine_lazy_thumbnail( 'cream-magazine-thumbnail-2' );
                                                } else {
                                                    cream_magazine_normal_thumbnail( 'cream-magazine-thumbnail-2' );
                                                }
                                            }
                                            ?>
                                        </div><!-- .post_thumb -->
                                        <div class="post-holder">
                                            <div class="post_title">
                                                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                            </div>
                                            <?php cream_magazine_post_meta( $show_date_meta, $show_author_meta, $show_cmnt_no_meta ); ?>
                                        </div><!-- .post-holder -->
                                    </div><!-- .small-card -->
                                    <!-- <div class="mask"></div> --><!-- .mask -->
                                </div><!-- .col -->
                                <?php
                            }
                            $count++;
                        }
                        wp_reset_postdata();
                        ?>
                    </div><!-- .row -->
                </div><!-- .section_inner -->
            </section><!-- .cm-post-widget-two -->
            <?php
        }
 
    }
 
    public function form( $instance ) {
        $defaults = array(
            'title'       => '',
            'post_cat'	=> 'none',
            'post_no'	  => 6,
            'show_categories_meta' => true,
            'show_author_meta' => true,
            'show_date_meta' => true,
            'show_cmnt_no_meta' => true,
        );


        $instance = wp_parse_args( (array) $instance, $defaults );

		?>
		<p>
            <label for="<?php echo esc_attr( $this->get_field_name('title') ); ?>">
                <strong><?php esc_html_e('Title', 'cream-magazine'); ?></strong>
            </label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />   
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'post_cat' ) )?>"><strong><?php echo esc_html__( 'Select Category: ', 'cream-magazine' ); ?></strong></label>
            <?php
            $categories = get_terms( 
                array( 
                    'taxonomy' => 'category', 
                    'hide_empty' => 0, 
                )
            );
            ?>
            <select class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'post_cat' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'post_cat' ) ); ?>">
                <option value="<?php esc_attr_e( 'none', 'cream-magazine' ); ?>"<?php if( $instance['post_cat'] == 'none' ) { esc_attr_e( 'selected', 'cream-magazine' ); } ?>><?php esc_html_e( 'Select Category', 'cream-magazine' ); ?></option>
                <?php
                if( !empty( $categories ) ) {
                    foreach( $categories as $cat ) {
                        ?>
                        <option value="<?php echo esc_attr( $cat->slug ); ?>" <?php if( $instance['post_cat'] == $cat->slug ) { esc_attr_e( 'selected', 'cream-magazine' ); } ?>><?php echo esc_html( $cat->name ); ?></option>
                        <?php
                    }
                }
                ?>
            </select>
            <small><?php echo esc_html__( 'If no category is selected, then recent posts will be displayed.', 'cream-magazine' ); ?></small>
        </p>

		<p>
            <label for="<?php echo esc_attr( $this->get_field_name('post_no') ); ?>">
                <strong><?php esc_html_e('No of Posts', 'cream-magazine'); ?></strong>
            </label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('post_no') ); ?>" name="<?php echo esc_attr( $this->get_field_name('post_no') ); ?>" type="number" value="<?php echo esc_attr( $instance['post_no'] ); ?>" /> 
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_name('show_categories_meta') ); ?>">
                <input type="checkbox" id="<?php echo esc_attr( $this->get_field_id('show_categories_meta') ); ?>" name="<?php echo esc_attr( $this->get_field_name('show_categories_meta') ); ?>" <?php if( $instance['show_categories_meta'] == true ) { esc_attr_e( 'checked', 'cream-magazine' ); } ?> >
                <?php esc_html_e('Show Post Categories', 'cream-magazine'); ?>
            </label>
        </p> 

        <p>
            <label for="<?php echo esc_attr( $this->get_field_name('show_author_meta') ); ?>">
                <input type="checkbox" id="<?php echo esc_attr( $this->get_field_id('show_author_meta') ); ?>" name="<?php echo esc_attr( $this->get_field_name('show_author_meta') ); ?>" <?php if( $instance['show_author_meta'] == true ) { esc_attr_e( 'checked', 'cream-magazine' ); } ?> >
                <?php esc_html_e('Show Post Author', 'cream-magazine'); ?>
            </label>
        </p> 

        <p>
            <label for="<?php echo esc_attr( $this->get_field_name('show_date_meta') ); ?>">
                <input type="checkbox" id="<?php echo esc_attr( $this->get_field_id('show_date_meta') ); ?>" name="<?php echo esc_attr( $this->get_field_name('show_date_meta') ); ?>" <?php if( $instance['show_date_meta'] == true ) { esc_attr_e( 'checked', 'cream-magazine' ); } ?> >
                <?php esc_html_e('Show Posted Date', 'cream-magazine'); ?>
            </label>
        </p>  

        <p>
            <label for="<?php echo esc_attr( $this->get_field_name('show_cmnt_no_meta') ); ?>">
                <input type="checkbox" id="<?php echo esc_attr( $this->get_field_id('show_cmnt_no_meta') ); ?>" name="<?php echo esc_attr( $this->get_field_name('show_cmnt_no_meta') ); ?>" <?php if( $instance['show_cmnt_no_meta'] == true ) { esc_attr_e( 'checked', 'cream-magazine' ); } ?> >
                <?php esc_html_e('Show Post Comments Number', 'cream-magazine'); ?>
            </label>
        </p>  
		<?php
    }
 
    public function update( $new_instance, $old_instance ) {
 
        $instance = $old_instance;

        $instance['title']  	= sanitize_text_field( $new_instance['title'] );

        $instance['post_cat']  	= sanitize_text_field( $new_instance['post_cat'] );

        $instance['post_no']  	= absint( $new_instance['post_no'] );

        $instance['show_categories_meta']  = wp_validate_boolean( $new_instance['show_categories_meta'] );
        
        $instance['show_author_meta']  = wp_validate_boolean( $new_instance['show_author_meta'] );

        $instance['show_date_meta']  = wp_validate_boolean( $new_instance['show_date_meta'] );

        $instance['show_cmnt_no_meta']  = wp_validate_boolean( $new_instance['show_cmnt_no_meta'] );

        return $instance;
    } 
}