/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-block-editor/#useblockprops
 */
import { useBlockProps, RichText } from '@wordpress/block-editor';

/**
 * The save function defines the way in which the different attributes should
 * be combined into the final markup, which is then serialized by the block
 * editor into `post_content`.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#save
 *
 * @return {Element} Element to render.
 */
export default function save( { attributes } ) {
	const blockProps = useBlockProps.save();
	const { heading, text, buttonText, buttonURL, imageURL, imageAlt, containerClasses, imageBreakOut } = attributes;

	return (
		<section className="cta position-relative w-100">
			<div className="container py-5 px-md-4 px-xl-5">
				<div className="row d-flex justify justify-content-center">
					<div className="col-12 col-md-10">
						<div className="card card-cta">
							<div className="card-body my-5 mx-4">
								<div className="row">
									<div className="col-12 col-md-6 mb-4 mb-md-0">
										<RichText.Content tagName="h2" value={ heading } />
										<RichText.Content tagName="p" value={ text } />
										<a href={ buttonURL } className="btn btn-primary">{ buttonText }</a>
									</div>
									<div className="col-12 col-md-6 col-xl-5 offset-xl-1">
										<img src={ imageURL } className="img-fluid" alt={ imageAlt } />
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			{/* Arc for larger screens */}
			<div className="ctaArc position-absolute w-100 d-none d-md-block">
				<svg width="1600" height="200" viewBox="0 0 1600 200" preserveAspectRatio="none">
				<path d=
				"M0,0v66.7C0,66.7,392,12,792,12s808,54.7,808,54.7V0H0z" 
				fill="#ffffff" />
				</svg>
			</div>
			{/* Arc for smaller screens */}
			<div className="ctaArc position-absolute w-100 d-block d-md-none">
				<svg width="1600" height="100" viewBox="0 0 1600 200" preserveAspectRatio="none">
				<path d=
				"M0,0v66.7C0,66.7,392,12,792,12s808,54.7,808,54.7V0H0z" 
				fill="#ffffff" />
				</svg>
			</div>
		</section>
	);
}
