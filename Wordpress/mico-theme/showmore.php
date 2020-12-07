<?php
/**
 * Javascript for Load More
 *
 */
function mico_loadmore_scripts()
{

    if (!is_home('post'))
        return;

    global $wp_query;

    wp_register_script('mico_load_more', get_stylesheet_directory_uri() . '/load-more.js', array('jquery'));

    $args = array(
        'url' => admin_url('admin-ajax.php'),
        'posts' => json_encode($wp_query->query_vars),
        'current_page' => get_query_var('paged') ? get_query_var('paged') : 1,
        'max_page' => $wp_query->max_num_pages,
    );

    wp_localize_script('mico_load_more', 'mico_load_params', $args);
    wp_enqueue_script('mico_load_more');

}
add_action('wp_enqueue_scripts', 'mico_loadmore_scripts');
/**
 * AJAX Load More
 *
 */
function mico_ajax_load_more()
{
  $args = array(
    'posts_per_page' => 3,
    'post_type' => 'post',
    'paged' => (!empty($_POST['page']) && is_numeric($_POST['page'])) ? $_POST['page'] : 1,
  );

  $query = new WP_Query($args);
  if($query->have_posts()) {
    while ($query->have_posts()) {
      $query->the_post();
      echo "<h2>" . get_the_title() . "</h2>";
      the_content();
    }
    wp_reset_postdata();
  };
	die;
}
add_action('wp_ajax_loadmore', 'mico_ajax_load_more');
add_action('wp_ajax_nopriv_loadmore', 'mico_ajax_load_more');
?>
