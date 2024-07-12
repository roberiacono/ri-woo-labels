<div id="variables-wrapper">
	<p>
		<?php esc_html_e( 'You can use variables in labels:', 'ri-woo-labels' ); ?>
		<?php
		$variables = Ri_WL_CPT_Values::get_label_variables();

		foreach ( $variables as $key => $value ) {
			echo '<p><code>' . esc_html( $key ) . '</code><span>' . $value . '</span></p>';
		}
		?>
	</p>
</div>
