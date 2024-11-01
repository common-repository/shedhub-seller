<?php
	defined( 'ABSPATH' ) or die;
	$id = 'pdp_widget_' . substr( md5( uniqid() ), 0, 6 );
?>
<div class="shedhub-widget-container">
	<div id="<?php esc_attr_e( $id ); ?>"></div>
</div>
<script>
 (function (w,d,s,o,f,js,fjs) {
 w['PDP-Widget']=o;w[o] = w[o] || function () { (w[o].q = w[o].q || []).push(arguments) };
 js = d.createElement(s), fjs = d.getElementsByTagName(s)[0];
 js.id = o; js.src = f; js.async = 1; fjs.parentNode.insertBefore(js, fjs);
 }(window, document, 'script', 'shedhub', 'https://assets.shedhub.com/js/common/pdp_widget.js'));

shedhub('init','<?php esc_attr_e( $id_value ); ?>', '#<?php esc_attr_e( $id ); ?>');
</script>
