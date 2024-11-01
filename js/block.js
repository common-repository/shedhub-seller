( function ( blocks, element, blockEditor, components ) {
    var el = element.createElement;
	var Fragment = element.Fragment;
	var useState = element.useState;
	var InspectorControls = blockEditor.InspectorControls;
    var useBlockProps = blockEditor.useBlockProps;
	var TextControl = components.TextControl;
	var SelectControl = components.SelectControl;
	var RadioControl = components.RadioControl;
	var Panel = components.Panel;
	var PanelBody = components.PanelBody;
	var PanelRow = components.PanelRow;
	var Button = components.Button;
	var ResponsiveWrapper = components.ResponsiveWrapper;
 
    var blockStyle = {
        backgroundColor: "#900",
        color: "#fff",
        padding: "20px",
    };
 
    blocks.registerBlockType( "shedhub-seller/inventory-widget-block", {
        apiVersion: 2,
        title: SHSBlockData.i18n.inventoryBlockTitle,
        icon: el("img", {
			src: SHSBlockData.iconUrl
		}),
        category: 'widgets',
        example: {},
		attributes: {
			partnerId: {
				type: "string"
			},
			sortBy: {
				type: "string"
			},
			sortOrder: {
				type: "string"
			},
			pageSize: {
				type: "string",
				default: SHSBlockData.defPageSize
			},
			pdp_url_template: {
				type: "string"
			}
		},
        edit: function ( props ) {
			var blockProps = useBlockProps( { style: blockStyle } );

            return (
				el( Fragment, {},
					el( InspectorControls, {},
						el( PanelBody, { title: SHSBlockData.i18n.inventoryWidgetSettings, initialOpen: true },
							el( PanelRow, {},
								el( TextControl,
									{
										label: SHSBlockData.i18n.partnerId,
										onChange: ( value ) => {
											props.setAttributes( { partnerId: value } );
										},
										value: props.attributes.partnerId
									}
								)
							),
							el( PanelRow, {},
								el( SelectControl,
									{
										label: SHSBlockData.i18n.sortBy,
										value: props.attributes.sortBy,
										options: SHSBlockData.sortOrders,
										onChange: ( value ) => {
											props.setAttributes( { sortBy: value } );
										}
									}
								)
							),
							el( PanelRow, {},
								el( SelectControl,
									{
										label: SHSBlockData.i18n.sortOrder,
										
										value: props.attributes.sortOrder,
										options: [
											{ label: SHSBlockData.i18n.asc, value: SHSBlockData.i18n.asc },
											{ label: SHSBlockData.i18n.desc, value: SHSBlockData.i18n.desc },
										],
										onChange: ( value ) => {
											props.setAttributes( { sortOrder: value } );
										}
									}
								)
							),
							el( PanelRow, {},
								el( TextControl,
									{
										label: SHSBlockData.i18n.pageSize,
										isShiftStepEnabled: true,
										shiftStep: 10,
										onChange: ( value ) => {
											props.setAttributes( { pageSize: value } );
										},
										type: "number",
										step: 1,
										min: 1,
										value: props.attributes.pageSize
									}
								)
							),
							el( PanelRow, {},
								el( TextControl,
									{
										label: SHSBlockData.i18n.pdp_url_template,
										onChange: ( value ) => {
											props.setAttributes( { pdp_url_template: value } );
										},
										value: props.attributes.pdp_url_template
									}
								)
							)
						),
					),
					el( "p", blockProps, "[" + SHSBlockData.i18n.inventoryBlockTitle + "]" )
				)
			)
        },
        save: function ( props ) {
            var blockProps = useBlockProps.save();

            return el( "p", blockProps, "[" + SHSBlockData.i18n.inventoryBlockTitle + "]" );
        },
    } );

	blocks.registerBlockType( "shedhub-seller/pdp-widget-block", {
        apiVersion: 2,
        title: SHSBlockData.i18n.PDPBlockTitle,
        icon: el("img", {
			src: SHSBlockData.iconUrl
		}),
        category: 'widgets',
        example: {},
		attributes: {
			idValue: {
				type: "string"
			},
			shinQueryVar: {
				type: "string"
			},
			idType: {
				type: "string",
				default: "staticId"
			}
		},
        edit: function ( props ) {
			var blockProps = useBlockProps( { style: blockStyle } );

            return (
				el( Fragment, {},
					el( InspectorControls, {},
						el( PanelBody, { title: SHSBlockData.i18n.PDPWidgetSettings, initialOpen: true },
							el( PanelRow, {},
								el( RadioControl,
									{
										label: SHSBlockData.i18n.idType,
										selected: props.attributes.idType,
										options: SHSBlockData.idTypes,
										onChange: ( value ) => {
											props.setAttributes( { idType: value } )
											//props.setOption( value );
										},
										//value: props.attributes.idType
									}
								)
							),
							el( PanelRow, {},
								el( TextControl,
									{
										label: SHSBlockData.i18n.idValue,
										onChange: ( value ) => {
											props.setAttributes( { idValue: value } );
										},
										value: props.attributes.idValue
									}
								)
							)
						),
					),
					el( "p", blockProps, "[" + SHSBlockData.i18n.PDPBlockTitle + "]" )
				)
			)
        },
        save: function ( props ) {
            var blockProps = useBlockProps.save();

            return el( "p", blockProps, "[" + SHSBlockData.i18n.PDPBlockTitle + "]" );
        },
    } );
} )( window.wp.blocks, window.wp.element, window.wp.blockEditor, window.wp.components );

(function() {
	document.addEventListener("DOMContentLoaded", function() {
		
	});
})();