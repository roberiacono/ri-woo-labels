<?php
global $post;

// Add nonce for security and authentication.
wp_nonce_field( 'ri_woo_labels_save_nonce_action', 'save_nonce' );

/*
$default_values = new Ri_WL_CPT_Values();

print_r( $default_values->get_default_values() ); */
$meta_box_settings = Ri_WL_CPT_Values::get_meta_box_settings_values();

$label_setting_where = get_post_meta( $post->ID, '_ri_wl_label_setting_where', true );
print_r( 'ri_wl_label_setting_where: ' . $label_setting_where );
?>

<?php
foreach ( $meta_box_settings as $key => $value ) {
	switch ( $value['type'] ) {
		case 'select':
			?>
				<div>
					<label><?php echo esc_html( $value['label'] ); ?>
					<select name="<?php echo esc_attr( $key ); ?>">
					<?php
					foreach ( $value['options'] as $option_value => $option_label ) {
						?>
						<option value="<?php echo esc_attr( $option_value ); ?>" <?php selected( get_post_meta( $post->ID, '_' . $key, true ), $option_value ); ?>><?php esc_html_e( $option_label ); ?></option>
						<?php
					}
					?>
					</select>
					</label>
				</div>
				<?php
			break;
	}
}
?>
