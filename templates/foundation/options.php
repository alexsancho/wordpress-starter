<?php
function of_options() {
	// Set the Options Array
	global $of_options;
	$of_options = array();

	$of_options[] = array(
		'name' => __( 'Home settings', 'foundation' ),
		'type' => 'heading',
	);

	$of_options[] = array(
		'name' => __( 'Hello there!', 'foundation' ),
		'desc' => '',
		'id'   => 'introduction',
		'std'  => '<h3 style="margin: 0 0 10px;">'.__( 'Welcome to the WordPress Starter Foundation Theme.', 'foundation' ).'</h3> '. __( 'This is a demo of the SMOF options framework, edit the options.php file inside the theme folder to setup your own, you can learn about the SMOF at <a href="//aquagraphite.com/2011/11/smof-documentation/" target="_blank">aquagraphite</a>.', 'foundation' ),
		'icon' => true,
		'type' => 'info',
	);

	// Backup Options
	$of_options[] = array(
		'name' => __( 'Backup Options', 'foundation' ),
		'type' => 'heading',
	);

	$of_options[] = array(
		'name' => __( 'Backup and Restore Options', 'foundation' ),
		'id'   => 'of_backup',
		'std'  => '',
		'type' => 'backup',
		'desc' => __( 'You can use the two buttons below to backup your current options, and then restore it back at a later time. This is useful if you want to experiment on the options but would like to keep the old settings in case you need it back.', 'foundation' ),
	);

	$of_options[] = array(
		'name' => __( 'Transfer Theme Options Data', 'foundation' ),
		'id'   => 'of_transfer',
		'std'  => '',
		'type' => 'transfer',
		'desc' => __( 'You can tranfer the saved options data between different installs by copying the text inside the text box. To import data from another install, replace the data in the text box with the one from another install and click "Import Options".', 'foundation' ),
	);

}
