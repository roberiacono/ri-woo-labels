<?php
global $post;

// Add nonce for security and authentication.
wp_nonce_field( 'ri_woo_labels_save_nonce_action', 'save_nonce' );

$post_id = $post->ID;

$value = get_post_meta( $post_id, '_type_meta_key', true );
/*
$conditions = get_post_meta( $post_id, '_ri_woo_labels_conditions', true );
$conditions = maybe_unserialize( $conditions ); */
$conditions = Ri_WL_CPT_Conditions::get_label_conditions( $post_id );
// print_r( $conditions );
?>
<div id="conditions-wrapper">
	<?php
	if ( $conditions ) {
		$default_conditions = Ri_WL_CPT_Conditions::get_default_conditions();
		foreach ( $conditions as $key => $value ) {
			?>
				<div class="conditions-wrapper__row">
					<?php
					if ( $key > 0 ) {
						?>
						<div class="relation">AND</div>
						<?php
					}
					?>
					<div class="conditions-wrapper__row__inner-wrapper">
						<div class="conditions-wrapper__row__inner" >
							<select name="conditions[<?php echo $key; ?>][type]" class="select-type">
								<option value="null">Select</option>
								<?php
								foreach ( $default_conditions as $default_key => $default_value ) {
									?>
										<option value="<?php echo esc_attr( $default_key ); ?>" <?php selected( $default_key, $value['type'] ); ?>><?php esc_html_e( $default_value['label'] ); ?></option>
										<?php
								}
								?>
							</select>
							<select name="conditions[<?php echo $key; ?>][compare]" class="select-compare">
							<?php
							foreach ( $default_conditions[ $value['type'] ]['compare'] as $default_key => $default_value ) {
								?>
								
									<option value="<?php echo esc_attr( $default_key ); ?>" <?php selected( $default_key, $value['compare'] ); ?>><?php esc_html_e( $default_value ); ?></option>
									<?php
							}
							?>
							</select>
							<select name="conditions[<?php echo $key; ?>][value]" class="select-values">
							<?php
							foreach ( $default_conditions[ $value['type'] ]['values'] as $default_key => $default_value ) {
								?>
								
									<option value="<?php echo esc_attr( $default_key ); ?>" <?php selected( $default_key, $value['value'] ); ?>><?php esc_html_e( $default_value ); ?></option>
									<?php
							}
							?>
							</select>
						</div>
						<button type="button" class="remove-condition button btn"><?php esc_html_e( 'Remove', 'ri-woo-labels' ); ?></button>
					</div>
				</div>
			<?php
		}
	}
	?>
</div>
<div>
	<button type="button" id="add-new-condition" class="button btn button-primary"><?php esc_html_e( '+ Add Condition', 'ri-woo-labels' ); ?> </button>
</div>


<style>
		#conditions-wrapper {
			display: flex;
			flex-direction: column; 
			gap: 0.5rem;
			margin-bottom: 10px;
		}

		.conditions-wrapper__row{
			display: flex; 
			flex-direction: column; 
			gap: 0.5rem;
		}

		.conditions-wrapper__row__inner-wrapper{
			display: flex; 
			flex-direction: row;
			gap: 0.5rem;
		}

		.conditions-wrapper__row__inner{
			display: flex; 
			gap: 0.5rem; 
			flex: 1;
		}

		.conditions-wrapper__row__inner select{
			flex: 1;
		}


</style>
