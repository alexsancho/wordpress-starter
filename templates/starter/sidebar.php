<?php
/**
 * The sidebar template.
 *
 * Copyright (c) 2012, Alex Sancho
 *
 * @category  Theme
 * @package   [starter]
 * @author    Alex Sancho
 * @copyright 2012 Alex Sancho
 * @license   http://opensource.org/licenses/mit-license.php MIT Licensed
 */
?>
	<aside id="sidebar" role="complementary">
		<ul id="widgets" class="side-nav">
			<li>
				<?php wp_nav_menu( array( 'theme_location' => 'primary', 'container' => '', 'menu_class' => 'nav' ) ); ?>
			</li>
			<?php dynamic_sidebar( 'primary-widget-area' ); ?>
		</ul>
	</aside>
