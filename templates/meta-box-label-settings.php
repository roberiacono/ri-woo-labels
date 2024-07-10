<?php
global $post;

// Add nonce for security and authentication.
wp_nonce_field( 'ri_woo_labels_save_nonce_action', 'save_nonce' );

$default_values = new Ri_WL_CPT_Values();

print_r( $default_values->get_default_values() );

$value = get_post_meta( $post->ID, '_type_meta_key', true );
?>
<div>
	<label for="type_select">Scegli il tipo:</label>
	<select name="type" id="type_select">
		<option value="sale" <?php selected( $value, 'sale' ); ?>>Sale</option>
		<option value="category" <?php selected( $value, 'category' ); ?>>Category</option>
	</select>
</div>
