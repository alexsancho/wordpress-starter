<?php
function of_options() {
	// Set the Options Array
	global $of_options;
	$of_options = array();

	$of_options[] = array(
		'name' => __( 'Theme settings', 'starter' ),
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

	// Backup Options
	$of_options[] = array(
		'name' => 'Backup Options',
		'type' => 'heading',
	);

	$of_options[] = array(
		'name' => 'Backup and Restore Options',
		'id'   => 'of_backup',
		'std'  => '',
		'type' => 'backup',
		'desc' => 'You can use the two buttons below to backup your current options, and then restore it back at a later time. This is useful if you want to experiment on the options but would like to keep the old settings in case you need it back.',
	);

	$of_options[] = array(
		'name' => 'Transfer Theme Options Data',
		'id'   => 'of_transfer',
		'std'  => '',
		'type' => 'transfer',
		'desc' => 'You can tranfer the saved options data between different installs by copying the text inside the text box. To import data from another install, replace the data in the text box with the one from another install and click "Import Options".',
	);
}
