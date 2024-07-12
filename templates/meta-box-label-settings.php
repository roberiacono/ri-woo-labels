<?php
global $post;

// Add nonce for security and authentication.
wp_nonce_field( 'ri_woo_labels_save_nonce_action', 'save_nonce' );

/*
$default_values = new Ri_WL_CPT_Values();

print_r( $default_values->get_default_values() ); */
$meta_box_settings = Ri_WL_CPT_Values::get_meta_box_settings_values();

$label_setting_where = get_post_meta( $post->ID, '_ri_wl_label_setting_where', true );
echo '<pre>';
var_dump( 'ri_wl_label_setting_where: ' . $label_setting_where );
var_dump( 'ri_wl_label_setting_position: ' . get_post_meta( $post->ID, '_ri_wl_label_setting_position', true ) );
var_dump( 'ri_wl_label_setting_template: ' . get_post_meta( $post->ID, '_ri_wl_label_setting_template', true ) );
echo '</pre>';

$is_new_label = false;
if ( Ri_WL_Helpers::is_new_page() ) {
	$is_new_label = true;
}
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
					$styles           = '';
					$background_color = '';
					$color            = '';
					$padding          = '';
					$border_radius    = '';
					if ( $is_new_label ) {
						$styles .= 'background-color: ' . $meta_box_settings['ri_wl_label_setting_predefined_colors']['options']['color-1']['style']['background-color'] . '; ';
						$styles .= 'color: ' . $meta_box_settings['ri_wl_label_setting_predefined_colors']['options']['color-1']['style']['color'] . '; ';
						$styles .= 'padding: ' . $meta_box_settings['ri_wl_label_setting_template']['options']['template-1']['style']['padding'] . '; ';
						$styles .= 'border-radius: ' . $meta_box_settings['ri_wl_label_setting_template']['options']['template-1']['style']['border-radius'] . '; ';
					}
					if ( isset( $option_values['style']['background-color'] ) ) {
						$background_color = $option_values['style']['background-color'];
						$styles          .= 'background-color: ' . $background_color . '; ';
					}
					if ( isset( $option_values['style']['color'] ) ) {
						$color   = $option_values['style']['color'];
						$styles .= 'color: ' . $color . '; ';
					}
					if ( isset( $option_values['style']['padding'] ) ) {
						$padding = $option_values['style']['padding'];
						$styles .= 'padding: ' . $padding . '; ';
					}
					if ( isset( $option_values['style']['border-radius'] ) ) {
						$border_radius = $option_values['style']['border-radius'];
						$styles       .= 'border-radius: ' . $border_radius . '; ';
					}

					// set initial style
					if ( $key === 'ri_wl_label_setting_template' ) {
						if ( $background_color = get_post_meta( $post->ID, '_ri_wl_label_setting_background_color', true ) ) {
							$styles .= 'background-color: ' . $background_color . '; ';
						}
						if ( $color = get_post_meta( $post->ID, '_ri_wl_label_setting_text_color', true ) ) {
							$styles .= 'color: ' . $color . '; ';
						}
					}

					// set initial style
					if ( $key === 'ri_wl_label_setting_predefined_colors' ) {
						if ( $padding = get_post_meta( $post->ID, '_ri_wl_label_setting_padding', true ) ) {
							$padding = maybe_unserialize( $padding );
							$styles .= 'padding: ' . $padding[0] . 'px ' . $padding[1] . 'px ' . $padding[2] . 'px ' . $padding[3] . 'px;';
						}
						if ( $border_radius = get_post_meta( $post->ID, '_ri_wl_label_setting_border_radius', true ) ) {
							$border_radius = maybe_unserialize( $border_radius );
							$styles       .= 'border-radius: ' . $border_radius[0] . 'px ' . $border_radius[1] . 'px ' . $border_radius[2] . 'px ' . $border_radius[3] . 'px;';
						}
					}


					?>
						<label>
							<input type="radio" name="<?php echo esc_attr( $key ); ?>" value="<?php echo esc_attr( $option_key ); ?>" class="radio-button" <?php checked( get_post_meta( $post->ID, '_' . $key, true ), $option_key ); ?>   data-background-color="<?php echo esc_attr( $background_color ); ?>" data-color="<?php echo esc_attr( $color ); ?>"  data-padding="<?php echo esc_attr( $padding ); ?>" data-border-radius="<?php echo esc_attr( $border_radius ); ?>" />
							<div class="woo-labels-<?php echo esc_attr( $key ); ?>">
								<span class="woo-labels-<?php echo esc_attr( $key ); ?>__span <?php echo esc_attr( $option_key ); ?>" style="<?php echo esc_attr( $styles ); ?>">
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
	.ri_woo_labels_options_panel .form-field .radio-wrapper {
		display: flex;
		gap: 1.5rem;
		flex-wrap: wrap;
	}

	.ri_woo_labels_options_panel .form-field .radio-wrapper label {
		display: flex;
		gap: 0.25rem;
		align-items: center;
	}

	.ri_woo_labels_options_panel label{
	
	}
	.ri_woo_labels_options_panel .description {
	
	}


	/* .woo-labels-template {
		position: relative;
		background-color: #fafafa;
		width: 150px;
		height: 150px;
	}
	.template-3 {
	position: absolute;
	top: -6.1px;
	right: 10px;
	}
	.template-3:after {
		position: absolute;
		content: "";
		width: 0;
		height: 0;
		border-left: 53px solid transparent;
		border-right: 53px solid transparent;
		border-top: 10px solid #F8463F;
	}
	.template-3 span {
		position: relative;
		display: block;
		text-align: center;
		background: #F8463F;
		font-size: 14px;
		line-height: 1;
		padding: 12px 8px 10px;
		border-top-right-radius: 8px;
		width: 90px;
	}
	.template-3 span:before, .template-3 span:after {
		position: absolute;
		content: "";
	}
	.template-3 span:before {
	height: 6px;
	width: 6px;
	left: -6px;
	top: 0;
	background: #F8463F;
	}
	.template-3 span:after {
	height: 6px;
	width: 8px;
	left: -8px;
	top: 0;
	border-radius: 8px 8px 0 0;
	background: #C02031;
	} */

</style>
