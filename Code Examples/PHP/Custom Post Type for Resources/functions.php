<?php

//create custom post type
function my_custom_post_resources() {
	$labels = array(
	  'name'               => _x( 'Resources', 'post type general name' ),
	  'singular_name'      => _x( 'Resource', 'post type singular name' ),
	  'add_new'            => _x( 'Add New', 'resource' ),
	  'add_new_item'       => __( 'Add New Resource' ),
	  'edit_item'          => __( 'Edit Resource' ),
	  'new_item'           => __( 'New Resource' ),
	  'all_items'          => __( 'All Resources' ),
	  'view_item'          => __( 'View Resources' ),
	  'search_items'       => __( 'Search Resources' ),
	  'not_found'          => __( 'No resources found' ),
	  'not_found_in_trash' => __( 'No resources found in the Trash' ), 
	  'parent_item_colon'  => ’,
	  'menu_name'          => 'Resources'
	);
	$args = array(
	  'labels'        => $labels,
	  'description'   => 'Holds our resources and resource specific data',
	  'public'        => true,
	  'menu_position' => 10,
	  'supports'      => array( 'title', 'editor'),
	  'has_archive'   => true,
	);
	register_post_type( 'resources', $args ); 
  }
  add_action( 'init', 'my_custom_post_resources' );

  //category taxonomies
  function my_taxonomies_resources() {
	$labels_categories = array(
	  'name'              => _x( 'Resources Categories', 'taxonomy general name' ),
	  'singular_name'     => _x( 'Resource Category', 'taxonomy singular name' ),
	  'search_items'      => __( 'Search Resource Categories' ),
	  'all_items'         => __( 'All Resource Categories' ),
	  'parent_item'       => __( 'Parent Resource Category' ),
	  'parent_item_colon' => __( 'Parent Resource Category:' ),
	  'edit_item'         => __( 'Edit Resource Category' ), 
	  'update_item'       => __( 'Update Resource Category' ),
	  'add_new_item'      => __( 'Add New Resource Category' ),
	  'new_item_name'     => __( 'New Resource Category' ),
	  'menu_name'         => __( 'Resource Categories' ),
	);
	$args_categories = array(
	  'labels'				=> $labels_categories,
	  'hierarchical'		=> true
	//   'rewrite'				=> true,
	//   'rewrite' => array(
	// 	'slug' => '$category_slug',
	// 	'hierarchical' => TRUE,
	// 	'with_front' => FALSE
	// ),
	);
	register_taxonomy( 'resources_category', 'resources', $args_categories );
  }
  add_action( 'init', 'my_taxonomies_resources', 0 );

 //custom meta box
  //define meta box
  add_action( 'add_meta_boxes', 'resources_link_box' );

function resources_link_box() {
    add_meta_box( 
        'resources_link_box',
        __( 'Resource Link', 'myplugin_textdomain' ),
        'resources_link_box_content',
        'resources',
        'normal',
        'high'
	);
}

//define meta box content
function resources_link_box_content( $post ) {
	wp_nonce_field( plugin_basename( __FILE__ ), 'resources_link_box_content_nonce' );
?>

	<style>
		.resources-label {
			display: block;
			font-weight: 700;
			font-size: 1.2em;
			padding-top: 10px;
		}
		.resources-label span {
			display: block;
			font-size: .9em;
			font-style: italic;
			font-weight: 500;
			color: grey;
		}

		.resources-input{
			display: block;
			width: 100%;
		}
	</style>

	<label class="resources-label" for="resources_url">Resource Link: *<span class="resources-label-description">Here you can add a link to a website, pdf, video, etc.</span></label>
	<input type="url" id="resources_url" name="resources_url" class="resources-input" value="<?php resources_url(); ?>" required>
	

	<?php 
}

//handling submitted data
  add_action( 'save_post', 'resources_link_box_save' );
function resources_link_box_save( $post_id ) {

  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
  return;

  if ( !wp_verify_nonce( $_POST['resources_link_box_content_nonce'], plugin_basename( __FILE__ ) ) )
  return;

  if ( 'page' == $_POST['post_type'] ) {
    if ( !current_user_can( 'edit_page', $post_id ) )
    return;
  } else {
    if ( !current_user_can( 'edit_post', $post_id ) )
    return;
  }

  $resources_url = $_POST['resources_url'];
  update_post_meta( $post_id, 'resources_url', $resources_url );
}

//reading post data

function resources_url() {
	$resources_url = get_post_meta( get_the_ID(), 'resources_url', true );
	echo $resources_url;
}



/*------------------------------------*\
		File Upload to Events
\*------------------------------------*/
function add_event_file_upload() {

    //Define custom meta box
     
        // Define the custom attachment for posts
        add_meta_box(
            'event_file_upload', //ID of the meta box
            'Custom Attachment', //UI label
            'event_file_upload', //callback function
            'tribe_events', //post type
            'normal' //location on page
        );
         
        // Define the custom attachment for pages
        add_meta_box(
            'event_file_upload',
            'Post-Event Resource File',
            'event_file_upload',
            'page',
            'side'
        ); 
    } // end add_event_file_upload
    add_action('add_meta_boxes', 'add_event_file_upload');
    
    //set up callback function
    function event_file_upload() {
        
        wp_nonce_field(plugin_basename(__FILE__), 'event_file_upload_nonce');
        
        $html = '<p class="description">';
            $html .= 'Upload a document, photo, or audio file associated with this event. It will become available after an event has passed. Accepted file types are: .pdf, .jpg, .png, .mp4';
        $html .= '</p>';
        $html .= '<input type="file" id="event_file_upload" name="event_file_upload"/>';
        
        echo $html;
    
    } // end event_file_upload
    
    //save file
    function save_file_upload($id) {
     
        /* --- security verification --- */
        if(!wp_verify_nonce($_POST['event_file_upload_nonce'], plugin_basename(__FILE__))) {
          return $id;
        } // end if
           
        if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
          return $id;
        } // end if
           
        if('page' == $_POST['post_type']) {
          if(!current_user_can('edit_page', $id)) {
            return $id;
          } // end if
        } else {
            if(!current_user_can('edit_page', $id)) {
                return $id;
            } // end if
        } // end if
        /* - end security verification - */
    
        // Make sure the file array isn't empty
        if(!empty($_FILES['event_file_upload']['name'])) {
             
            // Setup the array of supported file types.
            $supported_types = array('application/pdf','image/jpeg', 'image/png', 'video/mp4');
             
            // Get the file type of the upload
            $arr_file_type = wp_check_filetype(basename($_FILES['event_file_upload']['name']));
            $uploaded_type = $arr_file_type['type'];
             
            // Check if the type is supported. If not, throw an error.
            if(in_array($uploaded_type, $supported_types)) {
     
                // Use the WordPress API to upload the file
                $upload = wp_upload_bits($_FILES['event_file_upload']['name'], null, file_get_contents($_FILES['event_file_upload']['tmp_name']));
         
                if(isset($upload['error']) && $upload['error'] != 0) {
                    wp_die('There was an error uploading your file. The error is: ' . $upload['error']);
                } else {
                    add_post_meta($id, 'event_file_upload', $upload);
                    update_post_meta($id, 'event_file_upload', $upload);     
                } // end if/else
     
            } else {
                wp_die("The file type that you've uploaded is not valid. Accepted file types are: .pdf, .jpg, .png, .mp4");
            } // end if/else
             
        } // end if
         
    } // end save_file_upload
    add_action('save_post', 'save_file_upload');
    
    //update form to accept file
    function update_edit_form() {
        echo ' enctype="multipart/form-data"';
    } // end update_edit_form
    add_action('post_edit_form_tag', 'update_edit_form');