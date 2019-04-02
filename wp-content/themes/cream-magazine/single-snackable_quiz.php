<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Cream_Magazine
 */

get_header();
    ?>
    <div class="cm-container">
        <div class="inner-page-wrapper">
            <div id="primary" class="content-area">
                <main id="main" class="site-main">
                    <div class="cm_post_page_lay_wrap">
                        <?php
                        /**
    					* Hook - cream_magazine_breadcrumb.
    					*
    					* @hooked cream_magazine_breadcrumb_action - 10
    					*/
    					do_action( 'cream_magazine_breadcrumb' );
                        ?>
                        <div class="row">
                            <div class="single-container clearfix">
                            	<?php
                            	$sidebar_position = cream_magazine_sidebar_position();
                            	$class = cream_magazine_main_container_class();
                            	if( $sidebar_position == 'left' && is_active_sidebar( 'sidebar' ) ) {
                            		get_sidebar();
                            	}
                            	?>
                                <div class="<?php echo esc_attr( $class ); ?>">
								<article id="post-69" class="post-detail post-69 snackable_quiz type-snackable_quiz status-publish hentry">
										<div class="the_title">
											<h2><?php the_title(); ?></h2>
										</div><!-- .the_title -->
										<div class="the_content">
											<?php
												$data = array_filter(parse_blocks(get_post()->post_content), function ($block) {
													return $block['blockName'] !== NULL;
												});
												$topic_map = array();
												$topic_ids = array();

												$topics = json_decode(get_post_meta(get_post()->ID)['snackable_quiz_topics'][0])->topics;
												$questions = array();

												foreach($topics as $t) {
													$topic_map[$t->id] = $t;
													$topic_ids[] = $t->id;
												}
											?>
											<form id="quiz">
												<?php foreach ($data as $block): ?>
													<?php switch ($block['blockName']):
														case 'snackable/block-snackable-quiz-results': ?>
															<div class="snackable-quiz-results" style="display:none;"></div>
															<?php break; 
														case 'snackable/block-snackable-quiz': ?>
															<div class="snackable-present-quiz-question">
																<h3><?php echo $block['attrs']['question'];  ?></h3>
																<?php 
																	$slug_name = preg_replace("/[^a-zA-Z0-9]+/", "", $block['attrs']['question']);
																	$questions[$slug_name] = array();
																 ?>
																<ol>
																	<?php foreach( $topic_ids as $topic): ?>
																		<?php foreach( $block['attrs']['choices'] as $choice): ?>
																			<?php 
																				if($choice['id'] == $topic): 
																					array_push($questions[$slug_name], $choice);
																					$choice_id = $choice['id'] . $slug_name;
																				?>
																				<li>	
																					<input class="quiz-input" type="radio" id="<?php echo $choice_id; ?>" name="<?php echo $slug_name;?>" value="<?php echo $choice['id']; ?>">
																					<label for="<?php echo $choice_id;?>">
																						<?php echo $choice['name']; ?>
																					</label>
																				</li>
																			<?php endif; ?>
																		<?php endforeach; ?>
																	<?php endforeach; ?>
																</ol>
															</div>
															<?php break;
														default:
															print_r($block['innerHTML']);
															break;
													endswitch; ?>

												<?php endforeach; ?>
											</form>
										</div><!-- .the_content -->
	    							</article>
                                </div><!-- .col -->
                                <?php 
                                if( $sidebar_position == 'right' && is_active_sidebar( 'sidebar' ) ) {
                            		get_sidebar();
                            	}
                                ?>
                            </div><!-- .single-container -->
                        </div><!-- .row -->
                    </div><!-- .cm_post_page_lay_wrap -->
                </main><!-- #main.site-main -->
            </div><!-- #primary.content-area -->
        </div><!-- .inner-page-wrapper -->
    </div><!-- .cm-container -->

	<script>
		var TOPIC_IDS = <?php echo json_encode($topic_ids); ?>;
		var TOPIC_MAP = <?php echo json_encode($topic_map); ?>;
		var QUESTIONS = <?php echo json_encode($questions); ?>;
	</script>

	<script>
		(function ($) {
			$('.quiz-input').change( () => {
				const choices = jQuery('form#quiz').serializeArray();
				if( choices.length === Object.keys(QUESTIONS).length ) {
					const topicCount = {};
					TOPIC_IDS.forEach(t => {
						topicCount[t] = 0;
					});

					jQuery('.quiz-input').attr('disabled', true);

					choices.forEach(c => {
						topicCount[c.value]++; 
					})

					console.log(topicCount);
					choice = Object.keys(topicCount).map( e => [ topicCount[e], TOPIC_MAP[e].topic ] ).sort().reverse()[0][1];
					$('.snackable-quiz-results').html('<h1>You are a: ' + choice +'</h1>').show();
				}
			})
		}(jQuery));
	</script>

	
    <?php
get_footer();
