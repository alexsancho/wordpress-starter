<?php
/**
 * The default template for displaying footer
 *
 * @category  Theme
 * @package   [foundation]
 * @author    [Your Name]
 * @copyright 2012 [Your Name]
 */
?>
				</div>
				<?php get_sidebar(); ?>
			</section>
		</div>
		<footer class="footer" role="contentinfo">
			<?php do_action( 'foundation_footer' ); ?>
			<a href="<?php echo esc_url( __( 'http://wordpress.org/', 'foundation' ) ); ?>" title="<?php esc_attr_e( 'Semantic Personal Publishing Platform', 'foundation' ); ?>"><?php printf( __( 'Proudly powered by %s', 'foundation' ), 'WordPress' ); ?></a>
		</footer>
	</div>
<?php
	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */

	wp_footer();
?>
	</body>
</html>
