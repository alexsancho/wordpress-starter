<?php
function of_options() {
	// Set the Options Array
	global $of_options;
	$of_options = array();

	$of_options[] = array(
		'name' => __( 'Welcome Developer!!', 'starter' ),
		'type' => 'heading',
	);

	$of_options[] = array(
		'name' => 'Hello there!',
		'desc' => '',
		'id'   => 'introduction',
		'std'  => '<h3 style="margin: 0 0 10px;">'.__( 'Welcome to the WordPress Starter Theme.', 'starter' ).'</h3> This is a demo of the SMOF options framework, edit the options.php file inside the theme folder to setup your own, you can learn about the SMOF at <a href="//aquagraphite.com/2011/11/smof-documentation/" target="_blank">aquagraphite</a>.',
		'icon' => true,
		'type' => 'info',
	);
}
