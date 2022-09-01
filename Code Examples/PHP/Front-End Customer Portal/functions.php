<?php

/*------------------------------------*\
		CMS Link in Admin Bar
\*------------------------------------*/

add_action('admin_bar_menu', 'add_toolbar_items', 999);
function add_toolbar_items($admin_bar){
	$admin_bar->add_menu( array(
		'id'    => 'my-home',
		'title' => '<span class="dashicons-before dashicons-edit-large">My Home</span>',
		'href'  => '/my-home/',
		'meta'  => array(
			'title' => __('My Home'),            
		),
	));
}

?>