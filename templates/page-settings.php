<div class="wrap">
<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
<?php
$tabs        = array(
	'tab-general'      => esc_html( __( 'General', 'ri-woo-labels' ) ),
	'tab-feedback-box' => esc_html( __( 'Feedback Box', 'ri-woo-labels' ) ),
	'tab-extra'        => esc_html( __( 'Extra', 'ri-woo-labels' ) ),
);
$current_tab = isset( $_GET['tab'] ) && isset( $tabs[ $_GET['tab'] ] ) ? $_GET['tab'] : array_key_first( $tabs );
?>
<form method="post" action="options.php">
<nav class="nav-tab-wrapper">
	<?php
	foreach ( $tabs as $tab => $name ) {
		// CSS class for a current tab
		$current = $tab === $current_tab ? ' nav-tab-active' : '';
		// URL
		$url = add_query_arg(
			array(
				'page' => 'ri-woo-labels-settings',
				'tab'  => $tab,
			),
			''
		);
		// printing the tab link
		echo '<a class="nav-tab' . esc_attr( $current ) . '" href="' . esc_url( $url ) . '">' . esc_html( $name ) . '</a>';
	}
	?>
</nav>

	<?php
	settings_fields( 'ri-woo-labels-settings-' . esc_attr( $current_tab ) );
	do_settings_sections( 'ri-woo-labels-settings-' . esc_attr( $current_tab ) );
	submit_button();
	?>
</form>
</div>
