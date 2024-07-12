<?php
global $post;

// Add nonce for security and authentication.
wp_nonce_field( 'ri_woo_labels_save_nonce_action', 'save_nonce' );

/*
$default_values = new Ri_WL_CPT_Values();

print_r( $default_values->get_default_values() ); */
$meta_box_custom_style = Ri_WL_CPT_Values::get_meta_box_settings_style_values();

echo '<pre>';
echo 'ri_wl_label_setting_border_radius: ';
var_dump( get_post_meta( $post->ID, '_ri_wl_label_setting_border_radius', true ) );
echo '</pre>';

$is_new_label = false;
if ( Ri_WL_Helpers::is_new_page() ) {
	$is_new_label = true;
}

?>

<div class="ri_woo_labels_options_panel">
	<?php
	foreach ( $meta_box_custom_style as $key => $value ) {
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
							<div class="woo-labels-template">
								<span class=" <?php echo esc_attr( $option_key ); ?>" style="<?php echo esc_attr( $option_values['style'] ); ?>">
								<span><?php esc_html_e( $option_values['label'] ); ?></span>
								</span>
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
			case 'color':
				$color_value = $is_new_label ? $value['default'] : get_post_meta( $post->ID, '_' . $key, true );
				?>
						<input type="text" name="<?php echo esc_attr( $key ); ?>" value="<?php echo esc_attr( $color_value ); ?>" class="ri-woo-labels-color-field" data-default-color="<?php echo esc_attr( $value['default'] ); ?>;" />
							<?php
				break;
			case 'four-numbers':
				$elements = maybe_unserialize( get_post_meta( $post->ID, '_' . $key, true ) );
				?>
					<div class="four-elements-inline">
							<input type="number" step="any" name="<?php echo esc_attr( $key ); ?>[]" value="<?php echo $elements[0]; ?>">
							<input type="number" step="any" name="<?php echo esc_attr( $key ); ?>[]" value="<?php echo $elements[1]; ?>">
							<input type="number" step="any" name="<?php echo esc_attr( $key ); ?>[]" value="<?php echo $elements[2]; ?>">
							<input type="number" step="any" name="<?php echo esc_attr( $key ); ?>[]" value="<?php echo $elements[3]; ?>">
					</div>			
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

	.ri_woo_labels_options_panel .four-elements-inline{
		display: flex;
		gap: 0.5rem;
	}

  


</style>
