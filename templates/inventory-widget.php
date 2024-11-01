<?php
	defined( 'ABSPATH' ) or die;
	$id = 'shedhub_widget_' . substr( md5( uniqid() ), 0, 6 );
?>
<div class="shedhub-widget-container">
	<center><h1><?php _e( 'Current Shed Inventory', 'shedhub-seller' ); ?></h1></center>
	<div id="<?php esc_attr_e( $id ); ?>"></div>
</div>
<script>
	(function (w,d,s,o,f,js,fjs) {
	w['Shed-Widget']=o;w[o] = w[o] || function () { (w[o].q = w[o].q || []).push(arguments) };
	js = d.createElement(s), fjs = d.getElementsByTagName(s)[0];
	js.id = o; js.src = f; js.async = 1; fjs.parentNode.insertBefore(js, fjs);
	}(window, document, 'script', 'shedhub', 'https://assets.shedhub.com/js/common/shed_widget.js'));

	shedhub('sellerListing', {partnerId: <?php esc_attr_e( $block_attributes['partnerId'] ); ?>, element: '#<?php esc_attr_e( $id )?>', sortBy: "<?php esc_attr_e( $block_attributes['sortBy'] ); ?>", sortOrder: "<?php esc_attr_e( $block_attributes['sortOrder'] ); ?>", pageSize: <?php esc_attr_e( $block_attributes['pageSize'] ); ?>, vertical: true, pdp_url_template: "<?php esc_attr_e( $block_attributes['pdp_url_template'] ); ?>" });
</script>
