<?php
/**
 * The default template for displaying footer
 *
 * @category  Theme
 * @package   [starter]
 * @author    [Your Name]
 * @copyright 2012 [Your Name]
 */
?>
		</section>
	</div>
	<footer id="footer" role="contentinfo">
		<?php do_action( 'starter_footer' ); ?>
		<a href="<?php echo esc_url( __( 'http://wordpress.org/', 'starter' ) ); ?>" title="<?php esc_attr_e( 'Semantic Personal Publishing Platform', 'starter' ); ?>"><?php printf( __( 'Proudly powered by %s', 'starter' ), 'WordPress' ); ?></a>
	</footer>
<?php
	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */

	wp_footer();
?>
	</body>
</html>
