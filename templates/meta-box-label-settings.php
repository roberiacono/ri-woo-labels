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
print_r( 'ri_wl_label_setting_position: ' . get_post_meta( $post->ID, '_ri_wl_label_setting_position', true ) );
print_r( 'ri_wl_label_setting_template: ' . get_post_meta( $post->ID, '_ri_wl_label_setting_template', true ) );
?>

<div class="ri_woo_labels_options_panel">
	<?php
	foreach ( $meta_box_settings as $key => $value ) {
		?>
<div class="form-field <?php echo esc_attr( $key ); ?>">
							<label><?php echo esc_html( $value['label'] ); ?></label>
		<?php
		switch ( $value['type'] ) {
			case 'select':
				?>
						<select name="<?php echo esc_attr( $key ); ?>">
						<?php
						foreach ( $value['options'] as $option_key => $option_label ) {
							?>
							<option value="<?php echo esc_attr( $option_key ); ?>" <?php selected( get_post_meta( $post->ID, '_' . $key, true ), $option_key ); ?> ><?php esc_html_e( $option_label ); ?></option>
							<?php
						}
						?>
						</select>	
					<?php
				break;
			case 'radio':
				?>
				<div class="radio-wrapper">
				<?php
				foreach ( $value['options'] as $option_key => $option_values ) {
					?>
						<label>
							<input type="radio" name="<?php echo esc_attr( $key ); ?>" value="<?php echo esc_attr( $option_key ); ?>" class="radio-button" <?php checked( get_post_meta( $post->ID, '_' . $key, true ), $option_key ); ?> />
							<div class="<?php echo esc_attr( $option_key ); ?>" style="<?php echo esc_attr( $option_values['style'] ); ?>">
							<?php esc_html_e( $option_values['label'] ); ?>
							</div>
						</label>
					<?php
				}
				?>
				</div>
				<?php
				break;
			case 'text':
				?>
						<input type="text" name="<?php echo esc_attr( $key ); ?>" value="<?php echo get_post_meta( $post->ID, '_' . $key, true ); ?>">
						<?php
				break;
		}

		if ( isset( $value['description'] ) && $value['description'] ) {
			?>
			<span class="description"><?php echo esc_html( $value['description'] ); ?></span>
			<?php
		}
		?>
		</div>
		<?php
	}
	?>
</div>

<style>
	.ri_woo_labels_options_panel .form-field {
		margin-bottom: 15px;
		
	}
	.ri_woo_labels_options_panel .form-field.ri_wl_label_setting_template .radio-wrapper {
		display: flex;
		gap: 1rem;
	}

	.ri_woo_labels_options_panel .form-field.ri_wl_label_setting_template .radio-wrapper label {
		display: flex;
		gap: 0.25rem;
		align-items: center;
	}

	.ri_woo_labels_options_panel label{
	
	}
	.ri_woo_labels_options_panel .description {
	
}

</style>
