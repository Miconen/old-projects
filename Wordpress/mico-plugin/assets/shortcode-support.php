<?php
function mico_shortcode_handler( $atts ) {
    $atts = array_change_key_case((array)$atts, CASE_LOWER);

    $a = shortcode_atts(
    array(
            'employee' => '',
            'taxonomy' => 'test',
			'images'   => '',
			'user'     => '',
	), $atts );

	if(!empty($a['employee'])) {
		$a['employee'] = explode(',', $a['employee']);
	};

	$query_attributes = array(
        'post_type' => 'employee',
        'orderby' => 'rand',
        'posts_per_page' => -1,
		    'post_name__in' => $a['employee'],
        'tax_query' => array(
            array(
                'taxonomy' => 'occupations',
                'field'    => 'slug',
                'terms'    => $a['taxonomy'],
            ),
        )
    );

	function print_info($post, $images) {
		$post_meta = get_post_meta( $post->ID, 'contact', true );
		?>
		<div class="shortcode-box">
		<?php if ($images != 'false' && !empty(get_the_post_thumbnail_url($post->ID, 'thumbnail'))): ?>
			<?php echo get_the_post_thumbnail( $post->ID, 'thumbnail', array('class' => 'employee-thumbnail', 'data-shortcode' => 'true') );?>
		<?php endif; ?>

		<?php if ($post->post_title): ?>
			<p> <?php echo $post->post_title; ?> </p>
		<?php else: return; endif; ?>

		<?php if (!empty($post_meta['email'])): ?>
			<p> <?php echo $post_meta['email']; ?> </p>
		<?php endif; ?>
		</div>
		<?php
	}

	// if(!empty($a['user'])) {
	// 	$request = wp_remote_get('http://localhost/wp-dev/wp-json/wp/v2/users/1');
	// 	$request = json_decode(wp_remote_retrieve_body( $request ));
	// 	// $request = new WP_REST_Request( 'GET', '/wp/v2/users/1' );
	// 	// $response = rest_do_request( $request );
	// 	var_dump($request);
	// } else {
		// The Query
	    $the_query = new WP_Query( $query_attributes );

	    // The Loop
	    if ( $the_query->posts ) {
	        ob_start();
	        foreach ($the_query->posts as $post) {
	            print_info($post, $a['images']);
	        }
	        return ob_get_clean();
	    } else {
	    	// no posts found
	    }
	// }
}

add_shortcode( 'myshortcode', 'mico_shortcode_handler' );
?>
