<?php

//Add Action Hook to Wordpress
add_action ('init', 'my_custom_post_jobs');

//Create custom post type
function my_custom_post_jobs() {
	$job_slug = get_option('job_board_jobpost_slug') ? get_option('job_board_jobpost_slug') : 'jobs';
	$category_slug = get_option('job_board_job_category_slug') ? get_option('job_board_job_category_slug') : 'job-category';

	$labels = array(
		'name'               	=> _x( 'Careers', 'post type general name' ),
		'singular_name'      	=> _x( 'Career', 'post type singular name' ),
		'menu_name'				=> _('Job Listings'),
		'add_new'            	=> _x( 'Add New', 'jobs' ),
		'add_new_item'       	=> __( 'Add New Job' ),
		'edit_item'          	=> __( 'Edit Job' ),
		'new_item'           	=> __( 'New Job' ),
		'all_items'          	=> __( 'All Jobs' ),
		'view_item'          	=> __( 'View Job' ),
		'search_items'       	=> __( 'Search Jobs' ),
		'not_found'          	=> __( 'No jobs found' ),
		'not_found_in_trash' 	=> __( 'No jobs found in the Trash' ),
		'featured-image'	   	=> _x('Company Logo', 'jobs'),
		'set_featured_image' 	=> _x('Set Company Logo', 'jobs'),
		'remove_featured_image'	=> _x('Remove Company Logo', 'jobs'),
		'use_featured_image'	=> _x('Use as company logo', 'jobs')
	);
	$args = array(
	  'labels'        => $labels,
	  'description'   => 'Holds jobs and job specific data.',
	  'public'        => true,
	  'menu_position' => 5,
	  'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments' ),
	  'has_archive'   => true,
	  'rewrite' => array('slug' => 'careers', 'hierarchical' => TRUE, 'with_front' => FALSE),
	);
	register_post_type( 'jobs', $args ); 
  }
  add_action( 'init', 'my_custom_post_jobs' );

  //custom interaction messages
  function my_updated_messages( $messages ) {
	global $post, $post_ID;
	$messages['jobs'] = array(
	  0 => ’, 
	  1 => sprintf( __('Job updated. <a href="%s">View jobs</a>'), esc_url( get_permalink($post_ID) ) ),
	  2 => __('Custom field updated.'),
	  3 => __('Custom field deleted.'),
	  4 => __('Job updated.'),
	  5 => isset($_GET['revision']) ? sprintf( __('Job restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
	  6 => sprintf( __('Job published. <a href="%s">View job</a>'), esc_url( get_permalink($post_ID) ) ),
	  7 => __('Job saved.'),
	  8 => sprintf( __('Job submitted. <a target="_blank" href="%s">Preview job</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
	  9 => sprintf( __('Job scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview job</a>'), date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
	  10 => sprintf( __('Job draft updated. <a target="_blank" href="%s">Preview job</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
	);
	return $messages;
  }
  add_filter( 'post_updated_messages', 'my_updated_messages' );

  //contextual help
  function my_contextual_help( $contextual_help, $screen_id, $screen ) { 
	if ( 'jobs' == $screen->id ) {
  
	  $contextual_help = '<h2>Jobs</h2>
	  <p>Jobs show the details of the job listings that we show on the website. You can see a list of them on this page in reverse chronological order - the latest one we added is first.</p> 
	  <p>You can view/edit the details of each job by clicking on its name, or you can perform bulk actions using the dropdown menu and selecting multiple items.</p>';
  
	} elseif ( 'edit-product' == $screen->id ) {
  
	  $contextual_help = '<h2>Editing jobs</h2>
	  <p>This page allows you to view/modify job details. Please make sure to fill out the available boxes with the appropriate details (company logo, application deadline, job type, salary, start date) and do <strong>not</strong> add these details to the product description.</p>';
  
	}
	return $contextual_help;
  }
  add_action( 'contextual_help', 'my_contextual_help', 10, 3 );


  //category taxonomies
  function my_taxonomies_jobs() {
	$labels_categories = array(
	  'name'              => _x( 'Jobs Categories', 'taxonomy general name' ),
	  'singular_name'     => _x( 'Job Category', 'taxonomy singular name' ),
	  'search_items'      => __( 'Search Job Categories' ),
	  'all_items'         => __( 'All Job Categories' ),
	  'parent_item'       => __( 'Parent Job Category' ),
	  'parent_item_colon' => __( 'Parent Job Category:' ),
	  'edit_item'         => __( 'Edit Job Category' ), 
	  'update_item'       => __( 'Update Job Category' ),
	  'add_new_item'      => __( 'Add New Job Category' ),
	  'new_item_name'     => __( 'New Job Category' ),
	  'menu_name'         => __( 'Job Categories' ),
	);
	$args_categories = array(
	  'labels'				=> $labels_categories,
	  'hierarchical'		=> true,
	  'rewrite'				=> true,
	  'rewrite' => array(
		'slug' => '$category_slug',
		'hierarchical' => TRUE,
		'with_front' => FALSE
	),
	);
	register_taxonomy( 'jobs_category', 'jobs', $args_categories );
  }
  add_action( 'init', 'my_taxonomies_jobs', 0 );