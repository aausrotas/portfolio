<?php get_header(); ?>

<!-- Add each category to display from resources post type. first create resources category in wp-admin -->
<?php $args_cat1 = array(
    'post_type' => 'resources',
    'post_status' => 'publish',
    'posts_per_page' => 999,
	'tax_query'=>array(
        array(
            'taxonomy'=>'resources_category',
            'field'=>'slug',
            'terms'=>'professional-resources'  // wp category slug
        )
     )
);

$arr_cat1 = new WP_Query( $args_cat1 );
?>

<?php $args_cat2 = array(
    'post_type' => 'resources',
    'post_status' => 'publish',
    'posts_per_page' => 999,
    'tax_query' => array(
        array(
            'taxonomy' => 'resources_category',
            'field'    => 'slug',
            'terms'    => 'ministry-of-education',  // wp category slug
        ),
    ),
);
$arr_cat2 = new WP_Query( $args_cat2 );
?>

<?php $args_cat3 = array(
    'post_type' => 'resources',
    'post_status' => 'publish',
    'posts_per_page' => 999,
    'tax_query' => array(
        array(
            'taxonomy' => 'resources_category',
            'field'    => 'slug',
            'terms'    => 'elpoxford',  // wp category slug
        ),
    ),
);
$arr_cat3 = new WP_Query( $args_cat3 );
?>


<section class="page-header flexy-box-row vertical-center flex-center">
				<h1>Professional Resources</h1>

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

			<section>
				<p class="resources-intro-p">Early learning professionals rely on a variety of legislative documents and resources regularly. You will find them located here.</p>
			</section>


		<!-- section -->
		<section class="wrapper">
		<h3 class="resources-heading">Professional Resources</h3>
		</section>
		
		<?php if ($arr_cat1->have_posts()) : while ($arr_cat1->have_posts() ) :$arr_cat1->the_post(); ?>
			
			<section class="wrapper">
				<!-- article -->
				<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?>>

					<details class="resources-details"> 
						<summary class="resources-details-summary"><span class="resources-details-chevron">&#10063;</span>
						<?php the_title(); ?>
						</summary>
						<div class="resources-details-text">
							<a href="
							<?php resources_url(); ?>
							">
							<?php resources_url(); ?>
							</a> <br/>
							<?php the_content(); ?>
							<?php edit_post_link(); ?>
						</div>
					</details>

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



		<section class="wrapper">
		<h3 class="resources-heading">Ministry of Education Documents</h3>
		</section>
		
		<?php if ($arr_cat2->have_posts()) : while ($arr_cat2->have_posts() ) :$arr_cat2->the_post(); ?>
			
			<section class="wrapper">
				<!-- article -->
				<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?>>

					<details class="resources-details">
						<summary class="resources-details-summary"><span class="resources-details-chevron">&#10063;</span>
						<?php the_title(); ?>
						</summary>
						<div class="resources-details-text">
							<a href="
							<?php resources_url(); ?>
							">
							<?php resources_url(); ?>
							</a> <br/>
							<?php the_content(); ?>
							<?php edit_post_link(); ?>
						</div>
					</details>
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

		<!-- section -->
		
		
		<?php if ($arr_cat3->have_posts()) : while ($arr_cat3->have_posts() ) :$arr_cat3->the_post(); ?>
		<section class="wrapper">
		<h3 class="resources-heading">Early Learning Professionals Oxford Resources</h3>
		</section>
			
			<section class="wrapper">
				<!-- article -->
				<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?>>

					<details class="resources-details"> 
						<summary class="resources-details-summary"><span class="resources-details-chevron">&#10063;</span>
						<?php the_title(); ?>
						</summary>
						<div class="resources-details-text">
							<a href="
							<?php resources_url(); ?>
							">
							<?php resources_url(); ?>
							</a> <br/>
							<?php the_content(); ?>
							<?php edit_post_link(); ?>
						</div>
					</details>

				</article>
				<!-- /article -->
			</section>
			<!-- /section -->

		<?php endwhile; ?>

		<?php else : ?>

			<!-- article -->
			<article>

				<!-- <h2><?php //esc_html_e( 'Sorry, nothing to display.', 'html5blank' ); ?></h2> -->

			</article>
			<!-- /article -->

		<?php endif; ?>

<div class="padded wrapper"></div>


	</main>

<?php get_footer(); ?>
