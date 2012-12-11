<?php
/**
 * The Header for our theme.
 *
 * @category  Theme
 * @package   [bootstrap]
 * @author    [Your Name]
 * @copyright 2012 [Your Name]
 */
?><!DOCTYPE html>
<!--[if IEMobile 7 ]> <html <?php language_attributes(); ?>class="no-js iem7"> <![endif]-->
<!--[if lt IE 7 ]> <html <?php language_attributes(); ?> class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html <?php language_attributes(); ?> class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html <?php language_attributes(); ?> class="no-js ie8"> <![endif]-->
<!--[if (gte IE 9)|(gt IEMobile 7)|!(IEMobile)|!(IE)]><!--><html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

		<title><?php
			/*
			 * Print the <title> tag based on what is being viewed.
			 * We filter the output of wp_title() a bit -- see
			 * bootstrap_filter_wp_title() in functions.php.
			 */
			wp_title( '|', true, 'right' );

		?></title>

		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="cleartype" content="on">

		<?php
			/* Always have wp_head() just before the closing </head>
			 * tag of your theme, or you will break many plugins, which
			 * generally use this hook to add elements to <head> such
			 * as styles, scripts, and meta tags.
			 */
			wp_head();
		?>

		<!--[if lt IE 9]>
		<link href="<?php echo get_template_directory_uri();?>/stylesheets/ie.css" media="all" rel="stylesheet">
		<![endif]-->

		<?php if ( wp_count_posts()->publish > 0 ) : ?>
			<link rel="alternate" type="application/rss+xml" title="<?php echo get_bloginfo( 'name' ); ?> Feed" href="<?php echo home_url(); ?>/feed/">
		<?php endif; ?>
	</head>
	<body <?php body_class(); ?>>
		<div class="page container">
			<header class="header row" role="banner">
				<hgroup class="span12">
					<h1>
						<a href="<?php echo site_url();?>"><span class="assistive-text"><?php bloginfo( 'name' );?></span></a>
					</h1>
					<h2 class="assistive-text"><?php bloginfo( 'description' );?></h2>
				</hgroup>
			</header>
			<div class="row">
				<div class="navbar">
					<div class="navbar-inner">
						<?php
						wp_nav_menu(
							array(
								'container'       => '',
								'menu_class'      => 'nav',
								'theme_location'  => 'primary',
								'fallback_cb'     => 'foundation_page_menu',
								'walker'          => new Bootstrap_Walker_Nav_Menu(),
							)
						);
						?>
					</div>
				</div>
				<section class="content row" role="document">
					<div class="main span9" role="main">
