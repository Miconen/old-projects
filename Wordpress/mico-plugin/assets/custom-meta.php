<?php
function add_meta_boxes()
{
    add_meta_box('mico_employee_location', 'Employee Information', 'mico_employee_location', 'employee', 'normal', 'default');
};

function mico_employee_location()
{
    global $post;

    wp_nonce_field(basename(__FILE__), 'event_fields');

    $location = get_post_meta($post->ID, 'contact', true);
    // var_dump($location);
    $phone = (!empty($location['phone'])) ? esc_textarea($location['phone']): '';
    $email = (!empty($location['email'])) ? esc_textarea($location['email']): '';
    $position = (!empty($location['position'])) ? esc_textarea($location['position']): '';
    ?>
    <label><span>Phone:</span>
    <input type="text" name="contact[phone]" value="<?php echo $phone ?>" class="widefat" placeholder="Nimi" style="margin-bottom:10px">
    </label>
    <label><span>Email:</span>
    <input type="email" name="contact[email]" value="<?php echo $email  ?>" class="widefat" placeholder="Email" style="margin-bottom:10px">
    </label>
    <label><span>Position:</span>
    <input type="text" name="contact[position]" value="<?php echo $position ?>" class="widefat" placeholder="Extra Information (Optional)">
    </label>
    <?php
}

function mico_save_post($post_id, $post)
{

    if ('employee' !== $post->post_type) {
        return $post_id;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return $post_id;
    }

    if (empty($_POST['contact']) || !wp_verify_nonce($_POST['event_fields'], basename(__FILE__))) {
        return $post_id;
    }
    $sanitized_meta = array();
    foreach ($_POST['contact'] as $key => $value):
        if (is_email( $value )) {
            $sanitized_meta[$key] = sanitize_email( $value );
        } else {
            $sanitized_meta[$key] = sanitize_text_field( $value );
        }
    endforeach;
    update_post_meta( $post_id, 'contact', $sanitized_meta );
}

add_action('save_post', 'mico_save_post', 10, 2);
?>
