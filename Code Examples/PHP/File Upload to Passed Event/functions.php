<?php
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
?>