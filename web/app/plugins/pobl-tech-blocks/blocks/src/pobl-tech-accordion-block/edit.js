/**
 * Retrieves the translation of text.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-i18n/
 */
import { __ } from '@wordpress/i18n';

/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-block-editor/#useblockprops
 */
import { useBlockProps, InnerBlocks, InspectorControls } from '@wordpress/block-editor';
import { TextControl, PanelBody, Disabled, SelectControl } from '@wordpress/components';
import { useEffect } from '@wordpress/element';
import { useDispatch, useSelect } from '@wordpress/data';
import ServerSideRender from '@wordpress/server-side-render';

/**
 * Lets webpack process CSS, SASS or SCSS files referenced in JavaScript files.
 * Those files can contain any CSS code that gets applied to the editor.
 *
 * @see https://www.npmjs.com/package/@wordpress/scripts#using-css
 */
import './editor.scss';

import metadata from './block.json';

/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#edit
 *
 * @return {Element} Element to render.
 */
export default function Edit( { attributes, setAttributes, clientId } ) {
	const { getBlockOrder } = useSelect( ( select ) => select( 'core/block-editor' ), [] );
	const { updateBlockAttributes, moveBlockToPosition } = useDispatch( 'core/block-editor' );
	const { accordionID, accordionHeading, fullWidthSection } = attributes;

	const isSelected = useSelect( ( select ) => {
        const { getSelectedBlockClientId } = select( 'core/block-editor' );
        return getSelectedBlockClientId() === clientId;
    }, [ clientId ] );

	// If accordionID is undefined, set it
	useEffect(() => {
		if (!accordionID) {
			setAttributes({ accordionID: 'pobl-tech-accordion-block-' + Math.floor(Math.random() * 100000) });
		}

		const innerBlockClientIds = getBlockOrder(clientId);
		//const lastInnerBlockClientId = innerBlockClientIds[innerBlockClientIds.length - 1];
		//updateBlockAttributes(lastInnerBlockClientId, { parentID: accordionID });
		innerBlockClientIds.forEach( blockId => {
			updateBlockAttributes( blockId, { parentID: accordionID } );
		});
	});

	return (
		<div { ...useBlockProps() }>
			<InspectorControls>
				<PanelBody title={ __( 'Accordion Settings', 'pobl-tech-accordion-block' ) }>
					<Disabled>
						<TextControl
							label={ __( 'Accordion ID', 'pobl-tech-accordion-block' ) }
							value={ accordionID }
						/>
					</Disabled>
					<TextControl
						label={ __( 'Accordion Heading', 'pobl-tech-accordion-block' ) }
						value={ accordionHeading }
						onChange={ ( value ) => setAttributes( { accordionHeading: value } ) }
					/>
                    <SelectControl
                        label={ __( 'Full Width Section?', 'pobl-tech-accordion-block' ) }
                        value={ fullWidthSection }
                        options={ [
                            { label: 'Yes', value: true },
                            { label: 'No', value: false },
                        ] }
                        onChange={ ( value ) => setAttributes( { fullWidthSection: value === 'true' } ) }
                    />					
				</PanelBody>
			</InspectorControls>
			<div className="accordion accordion-flush p-2">
				{
					accordionHeading !== '' && (
						<h2>{ accordionHeading }</h2>
					)
				}
				<InnerBlocks
					allowedBlocks={ metadata.allowedBlocks }
					template={ [
						[ 'create-block/pobl-tech-accordion-item-block', { heading: 'Accordion Item Heading', body: 'Accordion item body', parentID: accordionID } ],
					] }
					onMove={ ( fromClientId, toClientId, indexToMove ) => {
						moveBlockToPosition( fromClientId, toClientId, indexToMove );
						const blockOrder = getBlockOrder( toClientId );
						blockOrder.forEach( blockId => {
							updateBlockAttributes( blockId, { parentID: accordionID } );
						});
					} }
				/>
			</div>
		</div>
	);
}
