<?php /* Template Name: Portal Template */ get_header(); ?>

<section class="page-header flexy-box-row vertical-center flex-center">
	<h1><?php _e( the_title(), 'html5blank' ); ?></h1>
	<img src="/wp-content/uploads/banner/page-banner.jpg" alt="Jenga">
	<?php if ( function_exists('yoast_breadcrumb') )
			{yoast_breadcrumb('<p id="breadcrumbs">','</p>');} ?>
	<div class="colour-section-bottom">
			<svg id="curveUpColor" xmlns="http://www.w3.org/2000/svg" version="1.1" width="100%" height="100" viewBox="0 0 100 100" preserveAspectRatio="none">
				<path d="M0 100 C 20 0 50 0 100 100 Z"/>
			</svg>
	</div>
</section>

	<main role="main" aria-label="Content" class="page_body">
		<!-- section -->
		<section>

		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

			<!-- article -->
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="padded wrapper">
					<?php if(is_user_logged_in()) :  ?>
					<div class="flexy-box-row space-between">
					<div class="page-sidebar no-col-width">
					<?php echo do_shortcode('[member-menu]'); ?>
					</div>
					<div class="page-content no-col-width">
						<?php the_content(); ?>
					</div>
					</div>
				<?php else: ?>
					<?php the_content(); ?>
				<?php endif; ?>
			</div>


				<?php edit_post_link(); ?>

			</article>
			<!-- /article -->

		<?php endwhile; ?>

		<?php else : ?>

			<!-- article -->
			<article>

				<h2><?php esc_html_e( 'Sorry, nothing to display.', 'html5blank' ); ?></h2>

			</article>
			<!-- /article -->

		<?php endif; ?>

		</section>
		<!-- /section -->
	</main>


<?php get_footer(); ?>
