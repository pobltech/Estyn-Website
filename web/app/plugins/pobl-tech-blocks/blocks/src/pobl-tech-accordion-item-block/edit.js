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
import { useBlockProps, InspectorControls, RichText } from '@wordpress/block-editor';
import { TextControl, PanelBody, Disabled } from '@wordpress/components';
import { useEffect } from '@wordpress/element';
import { useSelect } from '@wordpress/data';

/**
 * Lets webpack process CSS, SASS or SCSS files referenced in JavaScript files.
 * Those files can contain any CSS code that gets applied to the editor.
 *
 * @see https://www.npmjs.com/package/@wordpress/scripts#using-css
 */
import './editor.scss';

/**
 * Only show the accordion item text if the item is selected/focussed
 */
const BodySection = ( { isSelected, body, onChange } ) => {
	if ( isSelected === true ) {
		return (
			<RichText
				tagName="p"
				placeholder={ __( 'Content...', 'pobl-tech-accordion-item-block' ) }
				value={ body }
				onChange={ onChange }
			/>
		)
	} else {
		return (
			<></>
		)
	}
};

/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#edit
 *
 * @return {Element} Element to render.
 */
export default function Edit( { attributes, setAttributes, clientId }) {
	const { heading, body, parentID, itemID } = attributes;
	useEffect(() => {
		if ( ! itemID ) {
			setAttributes( { itemID: 'pobl-tech-accordion-item-block-' + Math.floor( Math.random() * 100000 ) } );
		}
	}, [itemID]);

	const isSelected = useSelect( ( select ) => {
		const { getSelectedBlockClientId } = select( 'core/block-editor' );
		return getSelectedBlockClientId() === clientId;
	}, [ clientId ] );



	return (
		<div { ...useBlockProps() }>
			<InspectorControls>
				<PanelBody title={ __( 'Accordion Item Settings', 'pobl-tech-accordion-item-block' ) }>
					<Disabled>
						<TextControl
							label={ __( 'Parent Accordion ID', 'pobl-tech-accordion-item-block' ) }
							value={ parentID }
						/>
						<TextControl
							label={ __( 'Item ID', 'pobl-tech-accordion-item-block' ) }
							value={ itemID }
						/>
					</Disabled>
				</PanelBody>
			</InspectorControls>
			<div className="accordion-item p-2">
				<RichText
					tagName="h2"
					placeholder={ __( 'Heading', 'pobl-tech-accordion-item-block' ) }
					value={ heading }
					onChange={ ( value ) => setAttributes( { heading: value } ) }
				/>
				<BodySection isSelected={isSelected} body={body} onChange = {( value ) => setAttributes( { body: value } )} />
			</div>
		</div>
	);
}
