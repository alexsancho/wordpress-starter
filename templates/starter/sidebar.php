<?php
/**
 * The sidebar template.
 *
 * @category  Theme
 * @package   [starter]
 * @author    [Your Name]
 * @copyright 2012 [Your Name]
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
