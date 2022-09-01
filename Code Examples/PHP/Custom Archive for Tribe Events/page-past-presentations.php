<?php get_header(); ?>

		<!-- section -->
<?php $i = 1; ?>
		<?php if ( have_posts()) : while ( have_posts() ) : the_post(); ?>
			<section class="page-header flexy-box-row vertical-center flex-center">
				<h1><?php echo ( get_field('page_title') ? the_field('page_title') : the_title() ); ?></h1>

				<?php if ( has_post_thumbnail() ) : // Check if Thumbnail exists. ?>
						<?php the_post_thumbnail('page-header'); // Fullsize image for the single post. ?>
				<?php else : ?>
					<img src="/wp-content/uploads/banner/page-banner.jpg" alt="Jenga">
				<?php endif; ?>

				<div class="colour-section-bottom">
						<svg id="curveUpColor" xmlns="http://www.w3.org/2000/svg" version="1.1" width="100%" height="100" viewBox="0 0 100 100" preserveAspectRatio="none">
							<path d="M0 100 C 20 0 50 0 100 100 Z"/>
						</svg>
				</div>

			</section>
			<section class="padded wrapper">
				<!-- article -->
				<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?>>

					<?php 
					
						// Ensure the global $post variable is in scope
						global $post;
						
						// Retrieve the next 5 upcoming events starting now
						$events = tribe_get_events( [ 
							'posts_per_page' => 5,
							'start_date' => '2000-01-01',
							'end_date' => 'yesterday',
							'order_by' => 'date',
							'order' => 'DESC'
							] );
						
						// Loop through the events

						foreach ( $events as $post ) {
						setup_postdata( $post );
							if($i%2 == 0) :
					?> 

<div class="flexy-box-row vertical-start event-list-single-container">
									<!-- left box -->
									<div class="event-list-date-1">
										<!-- Date -->
										<?php tribe_get_template_part( 'modules/meta/details/date' ); ?>
									</div>
									<!-- right box -->
									<div class="event-list-details-1">
										<!-- title & image -->
										<div class="flexy-box-row vertical-end">
											<!-- thumbnail -->
											<?php tribe_get_template_part( 'embed/image' ); ?>
											<!-- title & cost-->
											<a href="<?php  echo esc_url( tribe_get_event_link() ); ?>" class="event-list-title-1"><?php echo $post->post_title ?> - <?php tribe_get_template_part('embed/cost') ?></a>
										</div>
										<div class="event-list-text-1">
											<!-- time -->
											<span class="event-list-time"><?php tribe_get_template_part('modules/meta/details/time') ?></span>
											<!-- content -->
											<span class="event-list-content-1"><?php tribe_get_template_part( 'embed/content' ) ?></span>
										</div>

									</div>

								</div>

							<?php else: ?>

								<!-- <div class="flexy-box-row vertical-start event-list-single-container"> -->
								<div class="event-list-single-container">
									<!-- left box -->
									<div class="event-list-date-2">
										<!-- Date -->
										<?php tribe_get_template_part( 'modules/meta/details/date' ); ?>
									</div>								
									<!-- right box -->
									<div class="event-list-details-2">
										<!-- title & image -->
										<div class="flexy-box-row vertical-end">
											<!-- thumbnail -->
											<?php tribe_get_template_part( 'embed/image' ); ?>
											<!-- title & cost-->
											<a href="<?php  echo esc_url( tribe_get_event_link() ); ?>" class="event-list-title-2"><?php echo $post->post_title ?> - <?php tribe_get_template_part('embed/cost') ?></a>
										</div>
										<div class="event-list-text-2">
											<!-- time -->
											<span class="event-list-time"><?php tribe_get_template_part('modules/meta/details/time') ?></span>
											<!-- venue -->
											<span class="event-list-venue"><?php tribe_get_template_part('modules/meta/venue') ?></span>
											<!-- content -->
											<span class="event-list-content-2"><?php tribe_get_template_part( 'embed/content' ) ?></span>
										</div>

									</div>

								</div>
					<?php 

							endif;
							$i++;
							}
			
					?>

					<?php edit_post_link(); ?>

				</article>
				<!-- /article -->
			</section>
			<!-- /section -->

		<?php endwhile; ?>

		<?php else : ?>

			<!-- article -->
			<article>

				<h2><?php esc_html_e( 'Sorry, nothing to display.', 'html5blank' ); ?></h2>

			</article>
			<!-- /article -->

		<?php endif; ?>

		<?php get_template_part( 'pagination' ); ?>

	</main>

<?php get_footer(); ?>
