<?php
global $post;

$label_id = get_the_ID();
$view     = new Ri_WL_Label_View();
$text     = get_post_meta( $label_id, '_ri_wl_label_setting_text', true );
// $text     = $view->replace_variables_in_text( $text );
$variables = Ri_WL_CPT_Values::get_label_variables();
if ( strpos( $text, '%%' ) !== false ) {
	foreach ( $variables as $key => $value ) {
		if ( strpos( $text, $key ) !== false ) {
			switch ( $key ) {
				case '%%quantity%%':
					$text = str_replace( $key, '10', $text );
					break;
				case '%%price%%':
						$text = str_replace( $key, '99', $text );
					break;
				case '%%regular_price%%':
						$text = str_replace( $key, '110', $text );
					break;
				case '%%sale_price%%':
						$text = str_replace( $key, '99', $text );
					break;
				case '%%save_amount%%':
					$save_amount = 110 - 99;
						$text    = str_replace( $key, $save_amount, $text );
					break;
				case '%%discount%%':
						$discount = 100 - ceil( ( 99 / 110 ) * 100 );
							$text = str_replace( $key, $discount, $text );
					break;
				case '%%total_sales%%':
						$text = str_replace( $key, 16, $text );
					break;
				case '%%date_on_sale_to%%':
						$text = str_replace( $key, '2024-01-01', $text );
					break;
				case '%%rating%%':
						$text = str_replace( $key, 4.8, $text );
					break;
				case '%%reviews_count%%':
						$text = str_replace( $key, 63, $text );
					break;
			}
		}
	}
}

$style = $view->get_style( $label_id );
$html  = '<span class="" style="' . esc_attr( $style ) . '">' . $text . '</span>';


?>

<div class="ri_woo_labels_preview_panel">
	<div class="ri_wl_div_wrapper" style="position: relative; max-width: 324px; margin: 0 auto;">
		<?php echo wc_placeholder_img(); ?>
		<div class="ri-woo-labels-container" style="position: absolute; display: flex;">
			<?php echo $html; ?>
		</div>
	</div>
	<div class="before-title">
		<div class="ri-woo-labels-container" style="margin-top: 10px;">
			<?php echo $html; ?>
		</div>
	</div>
	<h3 class="woocommerce-loop-product__title">Product Title</h3>
	<span class="price">
		<span class="woocommerce-Price-amount amount">
			<bdi>99,00&nbsp;<span class="woocommerce-Price-currencySymbol">€</span>
			</bdi>
		</span>
	</span>
</div>


<style>
#ri-woo-labels-cpt-preview-meta-box .inside {
	background-color: #f6f7f7;
	padding: 12px;
}
.ri_woo_labels_preview_panel img{
	width: 100%;
	height: auto;
}
</style>
