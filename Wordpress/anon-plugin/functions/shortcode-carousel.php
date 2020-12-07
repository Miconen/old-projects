<?php
function anonymized_shortcode_handler( $atts ) {
    // $atts = array_change_key_case((array)$atts, CASE_LOWER);
    //
    // $a = shortcode_atts(
    // array(
    //         'employee' => '',
    //         'taxonomy' => 'test',
	// 		'images'   => '',
	// 		'user'     => '',
	// ), $atts );
    //
	// if(!empty($a['employee'])) {
	// 	$a['employee'] = explode(',', $a['employee']);
	// };
    //
	// $query_attributes = array(
    //     'post_type' => 'employee',
    //     'orderby' => 'rand',
    //     'posts_per_page' => -1,
	// 	    'post_name__in' => $a['employee'],
    //     'tax_query' => array(
    //         array(
    //             'taxonomy' => 'occupations',
    //             'field'    => 'slug',
    //             'terms'    => $a['taxonomy'],
    //         ),
    //     )
    // );

	function check_date( $input, $format ) {
		if ( $input == date($format)) {
			return true;
		} elseif ($input != date($format)) {
			return false;
		}
	};

	function print_info() {
		?>
		<div class="shortcode-box">
            <div class="your-class">
                <?php
                $query_value = transient_check();
                $day_iteration = 0;
                while (isset($query_value[$day_iteration])) {
                    // Check if current post is for today, if not then break
                    // if ( !check_date($query_value[$day_iteration]->paiva, 'Y-m-d') ) {
                    // 	break;
                    // }

                    // If test is passed print current post
                    echo "<div style='background-color: #f7f7f7'>";
                    echo "<h4>" . $query_value[$day_iteration]->nimi . "</h4>";
                    echo "<p>" . $query_value[$day_iteration]->kuvaus . "</p>";
					echo $day_iteration + 1;
                    echo "</div>";
                    // Loop & Iterate
                    $day_iteration++;
                };
                ?>
            </div>
		</div>
        <script type="text/javascript">
            jQuery(document).ready(function($) {
                $('.your-class').slick({
                    infinite: true,
                    slidesToShow: 1,
                    slidesToScroll: 1
                });
            });
        </script>
		<?php
	}

    ob_start();
    print_info();
    return ob_get_clean();
}

add_shortcode( 'anonymized_carousel', __NAMESPACE__ . '\\anonymized_shortcode_handler' );
?>
