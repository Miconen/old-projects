<?php
add_action( 'admin_menu', __NAMESPACE__ . '\\anonymized_add_admin_menu' );
add_action( 'admin_init', __NAMESPACE__ . '\\anonymized_settings_init' );


function anonymized_add_admin_menu(  ) {

	add_menu_page( 'anonymized', 'anonymized', 'manage_options', 'anonymized', __NAMESPACE__ . '\\anonymized_options_page' );

}


function anonymized_settings_init(  ) {

	register_setting( 'pluginPage', __NAMESPACE__ . '\\anonymized_settings' );

	add_settings_section(
		__NAMESPACE__ . '\\anonymized_pluginPage_section',
		__( 'Settings', 'anonymized' ),
		__NAMESPACE__ . '\\anonymized_settings_section_callback',
		'pluginPage'
	);

	add_settings_field(
		__NAMESPACE__ . '\\anonymized_text_field_0',
		__( '"Read More" link', 'anonymized' ),
		__NAMESPACE__ . '\\anonymized_text_field_0_render',
		'pluginPage',
		__NAMESPACE__ . '\\anonymized_pluginPage_section'
	);

	add_settings_field(
		__NAMESPACE__ . '\\anonymized_textarea_field_1',
		__( 'Category Selections', 'anonymized' ),
		__NAMESPACE__ . '\\anonymized_textarea_field_1_render',
		'pluginPage',
		__NAMESPACE__ . '\\anonymized_pluginPage_section'
	);

	add_settings_field(
		__NAMESPACE__ . '\\anonymized_textarea_field_2',
		__( 'Target Selections', 'anonymized' ),
		__NAMESPACE__ . '\\anonymized_textarea_field_2_render',
		'pluginPage',
		__NAMESPACE__ . '\\anonymized_pluginPage_section'
	);


}


function anonymized_text_field_0_render(  ) {

	$options = get_option( 'anonymized_settings' );
	?>
	<input type='text' name='anonymized_settings[anonymized_text_field_0]' value='<?php echo $options['anonymized_text_field_0']; ?>'>
	<?php

}


function anonymized_textarea_field_1_render(  ) {

	$options = get_option( 'anonymized_settings' );
	?>
	<textarea cols='40' rows='5' name='anonymized_settings[anonymized_textarea_field_1]'><?php echo $options['anonymized_textarea_field_1']; ?></textarea>
	<?php

}


function anonymized_textarea_field_2_render(  ) {

	$options = get_option( 'anonymized_settings' );
	?>
	<textarea cols='40' rows='5' name='anonymized_settings[anonymized_textarea_field_2]'><?php echo $options['anonymized_textarea_field_2']; ?></textarea>
	<?php

}


function anonymized_settings_section_callback(  ) {

	echo __( 'General settings for the plugin', 'anonymized' );

}


function anonymized_options_page(  ) {

	?>
	<form action='options.php' method='post'>

		<h2>anonymized Plugin</h2>

		<?php
		settings_fields( 'pluginPage' );
		do_settings_sections( 'pluginPage' );
		submit_button();
		?>

	</form>
	<?php

}
?>
