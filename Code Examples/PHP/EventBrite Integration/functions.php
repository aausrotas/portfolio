<?php

/*------------------------------------*\
		Eventbrite URL Custom Field
\*------------------------------------*/


if( function_exists('acf_add_local_field_group') ):

	acf_add_local_field_group(array(
		'key' => 'group_5f244bf08e7fb',
		'title' => 'Eventbrite URL',
		'fields' => array(
			array(
				'key' => 'field_6091846ae0ff1',
				'label' => 'Eventbrite URL for Tickets',
				'name' => 'eventbrite_url_for_tickets',
				'type' => 'url',
				'instructions' => 'On Eventbrite, navigate to the main page of the corresponding event. Scroll to the bottom and find the label "Your Event URL". Copy the link in the box and paste it here.',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'tribe_events',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => array(
			0 => 'excerpt',
			1 => 'discussion',
			2 => 'comments',
			3 => 'author',
			4 => 'tags',
		),
		'active' => true,
		'description' => '',
	));
	
	endif;

    ?>