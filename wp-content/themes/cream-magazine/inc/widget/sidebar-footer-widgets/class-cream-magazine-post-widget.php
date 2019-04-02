<?php

class Cream_Magazine_Post_Widget extends WP_Widget {
 
    function __construct() { 

        parent::__construct(
            'cream-magazine-post-widget',  // Base ID
            esc_html__( 'CM: Posts Widget', 'cream-magazine' ),   // Name
            array(
                'description' => esc_html__( 'Displays Recent, Most Commented or Editor Picked Posts.', 'cream-magazine' ), 
            )
        );
 
    }
 
    public function widget( $args, $instance ) {

        $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

		$post_choice = !empty( $instance[ 'post_choice' ] ) ? $instance[ 'post_choice' ] : 'recent';

		$posts_no = !empty( $instance[ 'post_no' ] ) ? $instance[ 'post_no' ] : 5;

        $layout = !empty( $instance[ 'layout' ] ) ? $instance[ 'layout' ] : 'layout_one';

        $show_author_meta = $instance['show_author_meta'];

        $show_date_meta = $instance['show_date_meta'];

        $show_cmnt_no_meta = $instance['show_cmnt_no_meta'];

		echo $args[ 'before_widget' ];

		$post_args = array(
			'posts_per_page' => absint( $posts_no ),
			'post_type' => 'post'
		);

		if( !empty( $post_choice ) ) {

			if( $post_choice == 'most_commented' ) {
				$post_args['orderby'] = 'comment_count';
				$post_args['order'] = 'desc';
			}
		}

		$post_query = new WP_Query( $post_args );

		if( $post_query->have_posts() ) :
			echo $args[ 'before_title' ];
				echo esc_html( $title );
			echo $args[ 'after_title' ];
			?>
			<div class="cm_relatedpost_widget">
                <div class="row clearfix">
                    <?php
                    $count = 0;
                    while( $post_query->have_posts() ) {
                        $post_query->the_post();
                        if( $count%2 == 0 && $count > 0 ) {
                            ?>
                            <div class="row clearfix"></div>
                            <?php
                        }
                        ?>
                        <div class="col-md-12 col-sm-6 col-xs-12">
                            <div class="row">
                                <div class="box clearfix">
                                    <div class="col-md-5 col-sm-5 col-xs-4">
                                        <div class="<?php cream_magazine_thumbnail_class(); ?>">
                                            <?php
                                            if( has_post_thumbnail() ) {
                                                
                                                $lazy_thumbnail = cream_magazine_get_option( 'cream_magazine_enable_lazy_load' );

                                                if( $lazy_thumbnail == true ) {
                                                    cream_magazine_lazy_thumbnail( 'cream-magazine-thumbnail-3' );
                                                } else {
                                                    cream_magazine_normal_thumbnail( 'cream-magazine-thumbnail-3' );
                                                }
                                            }
                                            ?>
                                        </div><!-- .post_thumb.imghover -->
                                    </div>
                                    <div class="col-md-7 col-sm-7 col-xs-8">
                                        <div class="post_title">
                                            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                        </div>
                                        <?php cream_magazine_post_meta( $show_date_meta, $show_author_meta, $show_cmnt_no_meta ); ?>
                                    </div>
                                </div><!-- .box.clearfix -->
                            </div><!-- .row -->
                        </div>
                        <?php
                        $count++;
                    }
                    wp_reset_postdata();
                    ?>
                </div><!-- .row.clearfix -->
            </div><!-- .cm_relatedpost_widget -->
			<?php
		endif;
			
		echo $args[ 'after_widget' ]; 
 
    }
 
    public function form( $instance ) {
        $defaults = array(
            'title'       => '',
            'post_choice'	=> 'recent',
            'post_no'	  => 5,
            'show_author_meta' => false,
            'show_date_meta' => true,
            'show_cmnt_no_meta' => false,
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
            <label for="<?php echo esc_attr( $this->get_field_name('post_choice') ); ?>">
                <?php esc_html_e('Type of Posts:', 'cream-magazine'); ?>
            </label>
            <select class="widefat" id="<?php echo esc_attr( $this->get_field_id('post_choice') ); ?>" name="<?php echo esc_attr( $this->get_field_name('post_choice') ); ?>">
            	<?php
        		$post_choices = array(
        			'recent' => esc_html__( 'Recent Posts', 'cream-magazine' ),
        			'most_commented' => esc_html__( 'Most Commented', 'cream-magazine' ),
        		);

        		foreach( $post_choices as $key => $post_choice ) {
        	        ?>
        			<option value="<?php echo esc_attr( $key ); ?>" <?php if( $instance['post_choice'] == $key ) { echo esc_attr( 'selected' ); } ?>>
        				<?php
        					echo esc_html( $post_choice );
        				?>
        			</option>
        	        <?php
        		}
            	?>
            </select>
        </p> 

		<p>
            <label for="<?php echo esc_attr( $this->get_field_name('post_no') ); ?>">
                <strong><?php esc_html_e('No of Popular Posts', 'cream-magazine'); ?></strong>
            </label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('post_no') ); ?>" name="<?php echo esc_attr( $this->get_field_name('post_no') ); ?>" type="number" value="<?php echo esc_attr( $instance['post_no'] ); ?>" />   
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

        $instance['post_choice']  	= sanitize_text_field( $new_instance['post_choice'] );

        $instance['post_no']  	= absint( $new_instance['post_no'] );
        
        $instance['show_author_meta']  = wp_validate_boolean( $new_instance['show_author_meta'] );

        $instance['show_date_meta']  = wp_validate_boolean( $new_instance['show_date_meta'] );

        $instance['show_cmnt_no_meta']  = wp_validate_boolean( $new_instance['show_cmnt_no_meta'] );

        return $instance;
    } 
}