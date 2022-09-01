<?php get_header(); ?>

<section class="page-header flexy-box-row vertical-center flex-center">
	<h1><?php _e( the_title(), 'html5blank' ); ?></h1>
	<img src="/wp-content/uploads/banner/page-banner.jpg" alt="Jenga">
	
	<div class="colour-section-bottom">
			<svg id="curveUpColor" xmlns="http://www.w3.org/2000/svg" version="1.1" width="100%" height="100" viewBox="0 0 100 100" preserveAspectRatio="none">
				<path d="M0 100 C 20 0 50 0 100 100 Z"/>
			</svg>
	</div>
</section>

	<!-- section -->
	<section class="padded wrapper">

	<?php if ( have_posts() ) : while (have_posts() ) : the_post(); ?>

		<!-- article -->
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<!-- thumbnail, title, company -->
			<div class="jobs-single-title">
				<!-- post thumbnail -->
				<?php if ( has_post_thumbnail() ) : // Check if Thumbnail exists. ?>
						<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
							<?php the_post_thumbnail('medium'); // Medium image for single post. ?>
						</a>
					<?php endif; ?>
					<!-- /post thumbnail -->

					<!-- post title -->
					<h1>
						<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
					</h1>
					<!-- /post title -->

					<!-- company name -->
					<h2><?php the_field('company_name'); ?></h2>
					<!-- /company name -->
			</div>
			<!-- /thumbnail, title, company -->

			<?php 
					function app_deadline() {
						if ( get_field( 'no_deadline' ) ): ?>
							
							<span>Open Until Filled</span>
						<?php else: // field_name returned false ?>
							<span> <?php the_field('app_deadline'); ?> </span>
						
						<?php endif; // end of if field_name logic ?>
					<?php } ?>


					<?php 
						function start_date() {
							if ( get_field( 'no_start' ) ): ?>
								
								<span>Immediately</span>
							<?php else: // field_name returned false ?>
								<span> <?php the_field('start_date'); ?> </span>
							
							<?php endif; // end of if field_name logic ?>
						<?php } ?>

			<!--job content-->
			<div class="jobs-single">
				<div>
					<!--details sidebar-->
					<div class="jobs-details-sidebar">
						<div class="job-meta">
							<ul>
								<li><b>Posted On: </b><span><time datetime="<?php the_time( 'Y-m-d' ); ?>"><?php the_date(); ?></time></span></li>
								<li><b>Application Deadline: </b><?php app_deadline(); ?></span></li>
								<li><b>Expected Start Date: </b><span><?php start_date(); ?></span></li>
								<li><b>Job Type: </b><span><?php the_field('job_type'); ?></span></li>
								<li><b>Salaray/ Wage: </b><span><?php the_field('salary'); ?></span></li>
							</ul>
						</div>
					</div>
					<!-- /details sidebar -->

					<!-- description -->
					<div class="jobs-single-desription">
						<?php the_content(); // Dynamic Content. ?>
					</div>
					<!-- /description -->
				</div>	
			</div>
			<!-- /job content -->

			<!-- apply button -->
			<div class="jobs-archive-job-btn">
				<a href="<?php the_field('app_link'); ?>" class="jobs-archive-apply-btn">Apply Here</a>
			</div>
			<!-- /apply button -->

			<?php edit_post_link(); // Always handy to have Edit Post Links available. ?>

		</article>
		<!-- /article -->

	<?php endwhile; ?>

	<?php else : ?>

		<!-- article -->
		<article>

			<h1><?php esc_html_e( 'Sorry, nothing to display.', 'html5blank' ); ?></h1>

		</article>
		<!-- /article -->

	<?php endif; ?>

	</section>
	<!-- /section -->
	</main>


<?php get_footer(); ?>
