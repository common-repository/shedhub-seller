<?php
/*
Plugin Name: ShedHub Seller
Description: Enables ShedHub Seller editor blocks.
Version:     1.1.0
Author:      Torricelli
Author URI:  https://www.fiverr.com/torricelli
Text Domain: shedhub-seller
Domain Path: /languages
*/

defined( 'ABSPATH' ) or die;

define( 'SHEDHUB_SELLER_FILE', __FILE__ );
define( 'SHEDHUB_SELLER_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'SHEDHUB_SELLER_CLASS_PATH', SHEDHUB_SELLER_PLUGIN_PATH . 'class/' );
define( 'SHEDHUB_SELLER_TEMPLATES_PATH', SHEDHUB_SELLER_PLUGIN_PATH . 'templates/' );
define( 'SHEDHUB_SELLER_NONCE_BN', basename( __FILE__ ) );
define( 'SHEDHUB_SELLER_NONCE_NAME', 'shedhub_seller_nonce' );
define( 'SHEDHUB_SELLER_DEF_PAGE_SIZE', '10' );
define( 'SHEDHUB_SELLER_DEF_SORT_BY', 'SubTotal' );
define( 'SHEDHUB_SELLER_DEF_SORT_ORDER', 'DESC' );
define( 'SHEDHUB_SELLER_DEF_ID_TYPE', 'staticId' );
define( 'SHEDHUB_SELLER_VER', '1.1.0' );

if ( ! class_exists( 'ShedHub_Seller' ) ) {
	class ShedHub_Seller {
		public static function get_instance() {
			if ( self::$instance == null ) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		private static $instance = null;

		private function __clone() { }

		private function __wakeup() { }

		private function __construct() {
			add_action( 'init', array( $this, 'init' ) );
			
		}

		public function init() {
			load_plugin_textdomain( 'shedhub-seller', false, dirname( plugin_basename( SHEDHUB_SELLER_FILE ) ) . '/languages' );

			wp_register_script(
				'shedhub-seller',
				plugins_url( 'js/block.js', SHEDHUB_SELLER_FILE ),
				array(),
				SHEDHUB_SELLER_VER,
				true
			);

			wp_localize_script( 'shedhub-seller', 'SHSBlockData', array(
				'i18n' => array(
					'inventoryWidgetSettings' => __( 'ShedHub Inventory Settings', 'shedhub-seller' ),
					'inventoryBlockTitle' => __( 'ShedHub Inventory', 'shedhub-seller' ),
					'partnerId' => __( 'Partner ID', 'shedhub-seller' ),
					'sortBy' => __( 'Sort By', 'shedhub-seller' ),
					'asc' => __( 'ASC', 'shedhub-seller' ),
					'desc' => __( 'DESC', 'shedhub-seller' ),
					'pageSize' => __( 'Page Size', 'shedhub-seller' ),
					'vertical' => __( 'Vertical', 'shedhub-seller' ),
					'pdp_url_template' => __( 'PDP URL Template', 'shedhub-seller' ),
					'PDPWidgetSettings' => __( 'ShedHub PDP Settings', 'shedhub-seller' ),
					'PDPBlockTitle' => __( 'ShedHub PDP', 'shedhub-seller' ),
					'idValue' => __( 'Value', 'shedhub-seller' ),
					'idType' => __( 'ID Type', 'shedhub-seller' ),
				),
				'sortOrders' => array(
					array( 'label' => __( 'Price', 'shedhub-seller' ), 'value' => 'subTotal' ),
					array( 'label' => __( 'Length', 'shedhub-seller' ), 'value' => 'Length' ),
					array( 'label' => __( 'Width', 'shedhub-seller' ), 'value' => 'Width' ),
					array( 'label' => __( 'Zip Of Seller', 'shedhub-seller' ), 'value' => 'ZipOfSeller' ),
					array( 'label' => __( 'SHIN', 'shedhub-seller' ), 'value' => 'id' ),
				),
				'idTypes' => array(
					array( 'label' => __( 'Static SHIN', 'shedhub-seller' ), 'value' => 'staticId' ),
					array( 'label' => __( 'Query var', 'shedhub-seller' ), 'value' => 'queryVar' ),
				),
				'defPageSize' => SHEDHUB_SELLER_DEF_PAGE_SIZE,
				'defIdType' => SHEDHUB_SELLER_DEF_ID_TYPE,
				'iconUrl' => plugins_url( 'images/icon.png', __FILE__ )
			) );

			register_block_type( 'shedhub-seller/inventory-widget-block', array(
				'api_version' => 2,
				'editor_script' => 'shedhub-seller',
				'render_callback' => array( $this, 'render_inventory_block' )
			) );

			register_block_type( 'shedhub-seller/pdp-widget-block', array(
				'api_version' => 2,
				'editor_script' => 'shedhub-seller',
				'render_callback' => array( $this, 'render_pdp_block' )
			) );
		}

		public function render_inventory_block( $block_attributes, $content ) {
			if ( ! isset( $block_attributes['sortBy'] ) || empty( $block_attributes['sortBy'] ) ) $block_attributes['sortBy'] = SHEDHUB_SELLER_DEF_SORT_BY;
			if ( ! isset( $block_attributes['sortOrder'] ) || empty( $block_attributes['sortOrder'] ) ) $block_attributes['sortBy'] = SHEDHUB_SELLER_DEF_SORT_ORDER;

			ob_start();
			require( SHEDHUB_SELLER_TEMPLATES_PATH . 'inventory-widget.php' );
			return ob_get_clean();
		}

		public function render_pdp_block( $block_attributes, $content ) {
			$id_type = isset( $block_attributes['idType'] ) && ! empty( $block_attributes['idType'] ) ? $block_attributes['idType'] : SHEDHUB_SELLER_DEF_ID_TYPE;
			$id_value = isset( $block_attributes['idValue'] ) && ! empty( $block_attributes['idValue'] ) ? $block_attributes['idValue'] : '';
			if ( $id_type == 'queryVar' ) {
				$id_value = isset( $_GET[$id_value] ) ? sanitize_text_field( $_GET[$id_value] ) : '';
			}

			ob_start();
			require( SHEDHUB_SELLER_TEMPLATES_PATH . 'pdp-widget.php' );
			return ob_get_clean();
		}
	}
}

ShedHub_Seller::get_instance();