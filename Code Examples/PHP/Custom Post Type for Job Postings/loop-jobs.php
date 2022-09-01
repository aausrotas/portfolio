<?php if (have_posts()): while (have_posts()) : the_post(); ?>

	<!-- article -->
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<div class="jobs-archive-job-posting">

			<!-- post thumbnail -->
				<div class="jobs-archive-img">
					<?php if ( has_post_thumbnail() ) : // Check if thumbnail exists. ?>
						<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
							<?php the_post_thumbnail( array( 120, 120 ), array('alt' => 'logo') ); // Declare pixel size you need inside the array. ?>
						</a>
					<?php endif; ?>
				</div>
			<!-- /post thumbnail -->

			<!-- post title -->
				<div class="jobs-archive-job-name">
					<h2>
						<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
					</h2>
				</div>
			<!-- /post title -->

			<!-- company name -->
				<div class="jobs-archive-company-name">
					<h3>
						<span><?php the_field('company_name'); ?></span>
					</h3>
				</div>
			<!-- /company name -->

			<!-- post date -->
				<div class="jobs-archive-details">
					<b>Date Posted:</b> 
					<span class="date">
						<time datetime="<?php the_time( 'Y-m-d' ); ?>">
							<?php the_date(); ?>
						</time>
					</span>
				</div>
			<!-- /post date -->

			<!-- application deadline -->

				<?php 
					function app_deadline() {
						if ( get_field( 'no_deadline' ) ): ?>
							
							<span>Open Until Filled</span>
						<?php else: // field_name returned false ?>
							<span> <?php the_field('app_deadline'); ?> </span>
						
						<?php endif; // end of if field_name logic ?>
					<?php } ?>


				<div class="jobs-archive-date-end">
					<b>Application Deadline: </b>
					<span><?php app_deadline(); ?> <?php //if ($is_deadline = true) {deadline_option();} else {job_deadline();} ?></span>
				</div>
			<!-- /app deadline -->

			<!-- post exerpt -->
				<div class="jobs-archive-description">
				<b>Description: </b>
					<?php the_excerpt(300);?>
				</div>
			<!-- /post exerpt -->

			<!-- job type -->
				<div class="jobs-archive-job-type">
					<b>Job Type: </b>
					<span><?php the_field('job_type'); ?></span>
				</div>
			<!-- /job type -->
			
			<!-- job salary -->
				<div class="jobs-archive-salary">
					<b>Salary/ Wage: </b>
					<span><?php the_field('salary'); ?></span>
				</div>
			<!-- /job salary -->

			<!-- start date -->

						<?php 
						function start_date() {
							if ( get_field( 'no_start' ) ): ?>
								
								<span>Immediately</span>
							<?php else: // field_name returned false ?>
								<span> <?php the_field('start_date'); ?> </span>
							
							<?php endif; // end of if field_name logic ?>
						<?php } ?>

				<div class="jobs-archive-start-date">
					<b>Expected Start Date: </b>
					<span><?php start_date(); ?></span>
				</div>

			<!-- /start date -->

			<?php

			// function app_link() {
			// 	if get_field('email'): 
			// 		$email = 'mailto:';
			// 		$email .= get_field('email');
			// 		echo $email; ?>

				<?php //else: ?>
					<?php //the_field('app_link'); ?>

				<?php //endif; 
			//} ?>

			<div class="jobs-archive-job-btn">
				<a href="<?php the_field('app_link'); ?>" class="jobs-archive-apply-btn" target="_blank" rel="noopener noreferrer">Apply</a>
			</div>

			<?php edit_post_link(); //good to have ?> 

		</div>


	</article>
	<!-- /article -->

<?php endwhile; ?>

<?php else : ?>

	<!-- article -->
	<article>
		<h2 style="text-align:center;"><?php esc_html_e( 'Sorry, we have no career postings at the moment. Check back again soon.', 'html5blank' ); ?></h2>
	</article>
	<!-- /article -->

<?php endif; ?>
