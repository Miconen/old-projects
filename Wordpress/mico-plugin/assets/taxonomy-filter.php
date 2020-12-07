<?php
/**
  * Add taxonomy filtering to custom post types
  *
  * Original example for one post type, https://generatewp.com/filtering-posts-by-taxonomies-in-the-dashboard/
  *
  */
function filter_cpt_by_taxonomies( $post_type, $which ) {
  // Affected post types
  $post_types = array(
    'employee'
  );
	// Apply this only on a specific post type
	if ( !in_array( $post_type, $post_types ) ) {
    return;
  }
  // Loop cpts
  foreach ( $post_types as $type ) {
    // Exceute only on matching type
    if ( $post_type == $type ) {
      // Get associated taxonomies names
      $taxonomies = get_object_taxonomies( $type, 'object' );
      // Loop taxonomies
      foreach ( $taxonomies as $taxonomy  ) {
    		// Retrieve taxonomy terms
    		$terms = get_terms( $taxonomy->name );
    		// Display filter HTML
    		echo "<select name='{$taxonomy->name}' id='{$taxonomy->name}' class='postform'>";
    		echo '<option value="">' . sprintf( esc_html__( 'Show All %s', 'text_domain' ), $taxonomy->label ) . '</option>';
    		foreach ( $terms as $term ) {
    			printf(
    				'<option value="%1$s" %2$s>%3$s (%4$s)</option>',
    				$term->slug,
    				( ( isset( $_GET[$taxonomy->name] ) && ( $_GET[$taxonomy->name] == $term->slug ) ) ? ' selected="selected"' : '' ),
    				$term->name,
    				$term->count
    			);
    		}
    		echo '</select>';
    	}
    }
  }
}
add_action( 'restrict_manage_posts', 'filter_cpt_by_taxonomies' , 10, 2);
?>
