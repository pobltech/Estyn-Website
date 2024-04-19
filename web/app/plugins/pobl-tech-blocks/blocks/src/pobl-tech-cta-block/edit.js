/**
 * Retrieves the translation of text.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-i18n/
 */
import { __ } from '@wordpress/i18n';

import ServerSideRender from '@wordpress/server-side-render';

/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-block-editor/#useblockprops
 */
import { useBlockProps, RichText, MediaUpload, MediaUploadCheck, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, Disabled, SelectControl } from '@wordpress/components';
import { useSelect } from '@wordpress/data';
import { useState, useEffect } from '@wordpress/element';

import metadata from './block.json';
/**
 * Lets webpack process CSS, SASS or SCSS files referenced in JavaScript files.
 * Those files can contain any CSS code that gets applied to the editor.
 *
 * @see https://www.npmjs.com/package/@wordpress/scripts#using-css
 */
import './editor.scss';
import mapImageSrc from '../../assets/images/map.svg';

/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#edit
 *
 * @return {Element} Element to render.
 */
export default function Edit( { attributes, setAttributes, clientId } ) {
	const { heading, text, buttonText, buttonURL, imageURL, imageAlt, imageBreakOut, variant } = attributes;
	
    
	const isSelected = useSelect( ( select ) => {
        const { getSelectedBlockClientId } = select( 'core/block-editor' );
        return getSelectedBlockClientId() === clientId;
    }, [ clientId ] );

	useEffect(() => {
		console.log( 'imageBreakOut updated to: ' + imageBreakOut );
	}, [ imageBreakOut ]);

	console.log( 'mapImageSrc: ' + mapImageSrc );

	return (
		<div { ...useBlockProps() }>
			<InspectorControls>
				{ variant === 'general' && (
					<>
					<PanelBody title={ __( 'Button Settings', 'pobl-tech-cta-block' ) }>
						<TextControl
							label={ __( 'Button URL', 'pobl-tech-cta-block' ) }
							value={ buttonURL }
							onChange={ ( value ) => setAttributes( { buttonURL: value } ) }
						/>
					</PanelBody>
					<PanelBody title={ __( 'Image Settings', 'pobl-tech-cta-block' ) }>
						<MediaUpload
							onSelect={(media) => setAttributes({ imageURL: media.url, imageAlt: media.alt })}
							allowedTypes={['image']}
							value={imageURL}
							render={({ open }) => (
								<button className="btn btn-secondary mb-3" onClick={open}>
									{imageURL ? (
										<img src={imageURL} className="img-fluid" alt={imageAlt} />
									) : (
										__('Select Image', 'pobl-tech-cta-block')
									)}
								</button>
							)}
						/>
						<TextControl
							label={ __( 'Image Alt Text', 'pobl-tech-cta-block' ) }
							value={ imageAlt }
							onChange={ ( value ) => setAttributes( { imageAlt: value } ) }
						/>
						<SelectControl
							label={ __( 'Image break out of container', 'pobl-tech-cta-block' ) }
							value={ imageBreakOut }
							options={ [
								{ label: 'No', value: 'false' },
								{ label: 'Yes', value: 'true' },
							] }
							onChange={ ( value ) => {
								// Convert to boolean because we store it as boolean
								value = value === 'true';
								setAttributes( { imageBreakOut: value } );
							} }
						/>
					</PanelBody>
					</>
				)}
				<PanelBody title={ __( 'Block Settings', 'pobl-tech-cta-block' ) }>
					<SelectControl
						label={ __( 'Variant', 'pobl-tech-cta-block' ) }
						value={ variant }
						options={ [
							{ label: 'General', value: 'general' },
							{ label: 'Search', value: 'search' }
						] }
						onChange={ ( value ) => setAttributes( { variant: value } ) }
					/>
				</PanelBody>
			</InspectorControls>
			{ isSelected === false && (
				<Disabled>
					<ServerSideRender
						block={ metadata.name }
						attributes={ attributes }
					/>
				</Disabled>
			)}		
			<section className={ isSelected === false ? "d-none cta position-relative w-100" : "cta position-relative w-100"}>
				<div className="container py-5 px-md-4 px-xl-5">
					<div className="row d-flex justify justify-content-center">
						<div className="col-12 col-md-10">
							<div className="card card-cta">
								<div className="card-body my-5 mx-4">
									<div className="row">
										<div className="col-12 col-md-6 mb-4 mb-md-0">
											<RichText 
												tagName="h2"
												value={ heading }
												onChange={ ( value ) => setAttributes( { heading: value } ) }
												placeholder={ __( 'Heading', 'pobl-tech-cta-block' ) }
											/>
											<RichText 
												tagName="p"
												value={ text }
												onChange={ ( value ) => setAttributes( { text: value } ) }
												placeholder={ __( 'Text', 'pobl-tech-cta-block' ) }
											/>
											<a className="btn btn-primary">
												<RichText 
													tagName="span"
													value={ buttonText }
													onChange={ ( value ) => setAttributes( { buttonText: value } ) }
													placeholder={ __( 'Button Text', 'pobl-tech-cta-block' ) }
													onClick={ ( event ) => event.preventDefault() }
												/>
											</a>
										</div>
										<div className="col-12 col-md-6 col-xl-5 offset-xl-1">
											{ variant === 'general' && (
												<img src={ imageURL } className={`img-fluid ${ imageBreakOut === true ? 'breakOut' : '' }`} alt={ imageAlt } />
											)}
											{ variant === 'search' && (
												<img src={ mapImageSrc } className="img-fluid breakOut" alt="Map" />
											)}
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				{ /* Arc for larger screens */ }
				<div className="ctaArc position-absolute w-100 d-none d-md-block">
					<svg width="1600" height="200" viewBox="0 0 1600 200" preserveAspectRatio="none">
					<path d=
					"M0,0v66.7C0,66.7,392,12,792,12s808,54.7,808,54.7V0H0z" 
					fill="#ffffff" />
					</svg>
				</div>
				{ /* Arc for smaller screens */ }
				<div className="ctaArc position-absolute w-100 d-block d-md-none">
					<svg width="1600" height="100" viewBox="0 0 1600 200" preserveAspectRatio="none">
					<path d=
					"M0,0v66.7C0,66.7,392,12,792,12s808,54.7,808,54.7V0H0z" 
					fill="#ffffff" />
					</svg>
				</div>
			</section>
		</div>
	);
}
