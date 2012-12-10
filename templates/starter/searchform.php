<?php
/**
 * The template for displaying the search form.
 *
 * @category  Theme
 * @package   [starter]
 * @author    [Your Name]
 * @copyright 2012 [Your Name]
 */
?>
<form role="search" method="get" id="searchform" class="search" action="<?php echo home_url( '/' ); ?>">
	<label class="assistive-text" for="s"><?php _e( 'Search', 'starter' ); ?></label>
	<input name="s" id="s" value="<?php if ( is_search() ) { echo get_search_query(); } ?>" type="search" class="search-query" autocomplete="off" placeholder="<?php _e( 'Search', 'starter' ) ?>">
</form>
