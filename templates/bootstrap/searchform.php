<?php
/**
 * The template for displaying the search form.
 *
 * @category  Theme
 * @package   [bootstrap]
 * @author    [Your Name]
 * @copyright 2012 [Your Name]
 */

// obtain a list of post names to use with 'typeahead'
$myposts = new WP_Query( array( 'numberposts' => 40 ) );

while ( $myposts->have_posts() ) {
	$myposts->the_post();
	$typeahead_data[] = get_the_title();
}
// Reset Post Data
wp_reset_postdata();
?>
<script>
jQuery(function($) {
	var titles = <?php echo json_encode( $typeahead_data );?>;
	$('#s').typeahead({source: titles, items: 7, minLength: 3, provide: 'typeahead'});
});
</script>

<form role="search" method="get" id="searchform" class="search" action="<?php echo home_url( '/' ); ?>">
	<label class="assistive-text" for="s"><?php _e( 'Search', 'bootstrap' ); ?></label>
	<input name="s" id="s" value="<?php if ( is_search() ) echo get_search_query(); ?>" type="search" class="search-query" autocomplete="off" placeholder="<?php _e( 'Search', 'bootstrap' ) ?>">
</form>
