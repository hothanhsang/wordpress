<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>

<?php
$args = array();
$args['show_count'] = get_option('shopme_woof_show_count', 1);
?>

<?php

if (!function_exists('shopme_woof_print_tax')) {

	function shopme_woof_print_tax($taxonomies, $tax_slug, $terms, $taxonomies_info, $additional_taxes, $shopme_woof_settings, $args, $counter) {

		if (!isset($shopme_woof_settings['tax'][$tax_slug])) { return ""; }

		global $SHOPME_WOOF;

		$args['taxonomy_info'] = $taxonomies_info[$tax_slug];
		$args['tax_slug'] = $tax_slug;
		$args['terms'] = $terms;
		$args['all_terms_hierarchy'] = $taxonomies[$tax_slug];
		$args['additional_taxes'] = $additional_taxes;
		?>

		<div data-css-class="woof_container_<?php echo $tax_slug ?>" class="woof_container woof_container_<?php echo $shopme_woof_settings['tax_type'][$tax_slug] ?> woof_container_<?php echo $tax_slug ?> woof_container_<?php echo $counter ?>">

			<div class="woof_container_inner">

				<?php switch ($shopme_woof_settings['tax_type'][$tax_slug]) {
					case 'checkbox': ?>
						<span class="woof_label"><?php echo SHOPME_WOOF_HELPER::wpml_translate($taxonomies_info[$tax_slug]) ?></span>
						<?php echo $SHOPME_WOOF->render_html(SHOPME_WOOF_PATH . 'views/types/checkbox.php', $args);
						break;
					case 'price': ?>
						<span class="woof_label"><?php echo SHOPME_WOOF_HELPER::wpml_translate($taxonomies_info[$tax_slug]) ?></span>
						<?php echo $SHOPME_WOOF->render_html(SHOPME_WOOF_PATH . 'views/types/wc-price-filter.php', $args);
						break;
					case 'select': ?>
						<span class="woof_label"><?php echo SHOPME_WOOF_HELPER::wpml_translate($taxonomies_info[$tax_slug]) ?></span>
						<?php echo $SHOPME_WOOF->render_html(SHOPME_WOOF_PATH . 'views/types/select.php', $args);
						break;
					case 'label': ?>
						<span class="woof_label"><?php echo SHOPME_WOOF_HELPER::wpml_translate($taxonomies_info[$tax_slug]) ?></span>
						<?php $args['labels'] = (isset($shopme_woof_settings['labels'][$tax_slug]) && !empty($shopme_woof_settings['labels'][$tax_slug])) ? $shopme_woof_settings['labels'][$tax_slug] : ''; ?>
						<?php echo $SHOPME_WOOF->render_html(SHOPME_WOOF_PATH . 'views/types/label.php', $args);
						break;
					case 'color': ?>
						<span class="woof_label"><?php echo SHOPME_WOOF_HELPER::wpml_translate($taxonomies_info[$tax_slug]) ?></span>
						<?php $args['colors'] = isset($shopme_woof_settings['colors'][$tax_slug]) ? $shopme_woof_settings['colors'][$tax_slug] : array() ;?>
						<?php echo $SHOPME_WOOF->render_html(SHOPME_WOOF_PATH . 'views/types/color.php', $args);
						break;
					default:
						?>
						<span class="woof_label"><?php echo SHOPME_WOOF_HELPER::wpml_translate($taxonomies_info[$tax_slug]) ?></span>
						<?php echo $SHOPME_WOOF->render_html(SHOPME_WOOF_PATH . 'views/types/checkbox.php', $args);
						break;
				} ?>

			</div><!--/ .woof_container_inner-->

		</div><!--/ .woof_container-->
		<?php
	}
}

if (!function_exists('shopme_woof_print_item_by_key')) {

	function shopme_woof_print_item_by_key($key, $shopme_woof_settings) {

		global $SHOPME_WOOF;

		switch ($key) {
			case 'by_text':
				if (isset($SHOPME_WOOF->settings['by_text']['show'])) {
					if ($SHOPME_WOOF->settings['by_text']['show']) {
						echo do_shortcode('[shopme_woof_text_filter]');
					}
				}
			break;
			case 'by_sku':
				if (isset($SHOPME_WOOF->settings['by_sku']['show'])) {
					if ($SHOPME_WOOF->settings['by_sku']['show']) {
						echo do_shortcode('[shopme_woof_sku_filter]');
					}
				}
			break;
		}

	}

}


?>

<div class="shopme-woof" data-shortcode="<?php echo(isset($_REQUEST['woof_shortcode_txt']) ? $_REQUEST['woof_shortcode_txt'] : 'shopme_woof') ?>">

	<div class="woof_redraw_zone">

	<?php
	global $wp_query;

	if (!empty($taxonomies)) {

		$show_reset = get_option('shopme_woof_show_reset');

		$exclude_tax_key = '';

		if ($this->is_really_current_term_exists()) {
			$o = $this->get_really_current_term();
			$exclude_tax_key = $o->taxonomy;
		}

		if (!empty($wp_query->query)) {
			if (isset($wp_query->query_vars['taxonomy']) AND in_array($wp_query->query_vars['taxonomy'], get_object_taxonomies('product')))
			{
				$taxes = $wp_query->query;
				if (isset($taxes['paged'])) {
					unset($taxes['paged']);
				}

				foreach ($taxes as $key => $value)
				{
					if (in_array($key, array_keys($this->get_request_data())))
					{
						unset($taxes[$key]);
					}
				}

				if (!empty($taxes)) {
					$t = array_keys($taxes);
					$v = array_values($taxes);

					$exclude_tax_key = $t[0];
					$_REQUEST['WOOF_IS_TAX_PAGE'] = $exclude_tax_key;
				}
			}
		} else { }

		$items_order = array();
		$taxonomies_keys = array_keys($taxonomies);

		if (isset($shopme_woof_settings['items_order']) AND ! empty($shopme_woof_settings['items_order'])) {
			$items_order = explode(',', $shopme_woof_settings['items_order']);
		} else {
			$items_order = array_merge($this->items_keys, $taxonomies_keys);
		}

		foreach (array_merge($this->items_keys, $taxonomies_keys) as $key) {
			if (!in_array($key, $items_order)) {
				$items_order[] = $key;
			}
		}

		//lets print our items and taxonomies
		$counter = 0;
		foreach ($items_order as $key) {
			if (in_array($key, $this->items_keys)) {
				shopme_woof_print_item_by_key($key, $shopme_woof_settings);
			} else {
				shopme_woof_print_tax($taxonomies, $key, $taxonomies[$key], $taxonomies_info, $additional_taxes, $shopme_woof_settings, $args, $counter);
			}
			$counter++;
		}

		if ($show_reset):

			ob_start(); ?>

			<footer class="bottom_box">
				<button class="woof-reset-navigation woof_reset_search_form"><?php esc_html_e('Reset', 'shopme'); ?></button>
			</footer>

			<?php echo ob_get_clean(); ?>

		<?php endif;

	}

	?>
	</div>

</div><!--/ .woof-->

