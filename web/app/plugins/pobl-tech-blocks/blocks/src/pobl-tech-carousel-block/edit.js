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
import { PanelBody, SelectControl, TextControl, Button } from '@wordpress/components';
import apiFetch from '@wordpress/api-fetch';
import { useState, useEffect } from '@wordpress/element';
import { v4 as uuidv4 } from 'uuid';
/**
 * Lets webpack process CSS, SASS or SCSS files referenced in JavaScript files.
 * Those files can contain any CSS code that gets applied to the editor.
 *
 * @see https://www.npmjs.com/package/@wordpress/scripts#using-css
 */
import './editor.scss';

/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#edit
 *
 * @return {Element} Element to render.
 */
export default function Edit( { attributes, setAttributes, clientId } ) {
	// Note: postTypeOfPostsToDisplayAsCarouselItems is the rest_base of the post type
	const { carouselId, buttonText, buttonLink, postTypeOfPostsToDisplayAsCarouselItems, heading, numberOfPostsToDisplay, description, postIdsOfPostsToDisplayAsCarouselItems, populateCarouselUsing, chosenImprovementResourceType } = attributes;
    const [postTypes, setPostTypes] = useState([]);
	const [improvementResourceTypes, setImprovementResourceTypes] = useState([]);
	const [posts, setPosts] = useState([]);
	const [allPostsToChooseFrom, setAllPostsToChooseFrom] = useState([]);
	const [selectedPostToAddId, setSelectedPostToAddId] = useState(null);
	const [imageSrcs, setImageSrcs] = useState([]);
	const [scrollLeft, setScrollLeft] = useState(0);
	const scrollDivref = React.createRef();

	async function getMediaSrc(mediaId) {
		const response = await fetch(`/wp-json/wp/v2/media/${mediaId}`);
		const data = await response.json();
		return data.source_url;
	}

	// Function to remove HTML tags
	const stripHtml = html => {
		let doc = new DOMParser().parseFromString(html, 'text/html');
		return doc.body.textContent || "";
	};

	useEffect(() => {
        const fetchImageSrcs = async () => {
            const newImageSrcs = {...imageSrcs};
            for (const post of posts) {
                newImageSrcs[post.id] = await getMediaSrc(post.featured_media);
            }
            setImageSrcs(newImageSrcs);
        };
        fetchImageSrcs();
    }, [posts]);

	useEffect(() => {
		// Output all attributes to the console
		//console.log('Attributes:');
		//console.log(attributes);
		

		// Carousel needs a unique ID
		// If the carouselId attribute doesn't exist, generate a new UUID and set it
		if (!attributes.carouselId) {
			setAttributes({ carouselId: 'pobl-tech-carousel-block-' + uuidv4() });
		}

/* 		if (!attributes.chosenImprovementResourceType) {
			//console.log('Setting chosenImprovementResourceType to all');
			setAttributes({ chosenImprovementResourceType: 'all' });
		} */

		// Get all the post types that support featured images
		// and set them as options in the select box
		apiFetch({ path: '/wp/v2/types?context=edit' }).then((data) => {
			//console.log(data);
			const types = Object.keys(data)
				// Filter out post types that don't support featured images
				.filter(key => data[key].supports && data[key].supports.thumbnail)
				
				.map((key) => {
					return { label: data[key].name, value: data[key].slug, rest_base: data[key].rest_base };
				});

			setPostTypes(types);

		});

		// Fetch all the posts to choose from
		// Note: We only allow posts of types that support featured images, and postTypes is already set (accordingly) at this point
		apiFetch({ path: '/wp/v2/posts' }).then((data) => {
			setAllPostsToChooseFrom(data);
/* 			setAllPostsToChooseFrom(data.filter((post) => {
				return postTypes.some((postType) => {
					return postType.value === post.type;
				});
			})); */
			setSelectedPostToAddId(data[0].id);
		});

	}, []);

	// Utility function to decode HTML entities
	function decodeHtmlEntities(htmlString) {
		const tempElement = document.createElement('div');
		tempElement.innerHTML = htmlString;
		return tempElement.textContent || tempElement.innerText || "";
	}

	function fetchPosts(populateCarouselUsing, postIdsOfPostsToDisplayAsCarouselItems, chosenImprovementResourceType, postTypes) {
		//console.log('Fetching posts');

	//useEffect(() => {
		if (populateCarouselUsing === 'postType') {
			// Fetch the posts of this post type.
			// wp/v2/[post type's "rest_base" value e.g. "posts"]
			//console.log('Post type of posts to display as carousel items: ' + postTypeOfPostsToDisplayAsCarouselItems);
			postTypes.forEach((postType) => {
				if (postType.value === postTypeOfPostsToDisplayAsCarouselItems) {
					if(postTypeOfPostsToDisplayAsCarouselItems === 'estyn_imp_resource' && chosenImprovementResourceType !== 'all') {
						console.log('Fetching estyn_imp_resource posts with improvement resource type: ' + chosenImprovementResourceType);
						
						apiFetch({ path: `/wp/v2/estyn_imp_resource?improvement_resource_type=${chosenImprovementResourceType}` })
							.then((data) => {
								//console.log('Posts = ');
								//console.log(data);

								setPosts(data);
							});
					} else {
						apiFetch({ path: `/wp/v2/${postType.rest_base}` })
							.then((data) => {
								//console.log('Line 132 is setting posts');
								//console.log('Posts = ');
								//console.log(data);

								setPosts(data);
							});
					}

					// Break out of the loop
					return;
				}
			});
		} else if (populateCarouselUsing === 'postIDs') {
			//console.log('Fetching posts using post IDs');
			if(postIdsOfPostsToDisplayAsCarouselItems.length > 0) {
				let postsToAdd = [];
				// Fetch the posts based on the post IDs.
				postIdsOfPostsToDisplayAsCarouselItems.forEach((postId, index) => {
					//apiFetch({ path: `/wp/v2/posts?include=${postIdsOfPostsToDisplayAsCarouselItems.join(',')}` })
					apiFetch({ path: `/wp/v2/posts/${postId}` })
						.then((data) => {
							//setPosts([...posts, data]);
							postsToAdd.push(data);

							if(index === postIdsOfPostsToDisplayAsCarouselItems.length - 1) {
								//console.log('Line 97 is setting posts');
								setPosts(postsToAdd);
							}
						});
				});
			}
		}
	//}, [postTypes]);
	}

	useEffect(() => {
		// Fetch the improvement resource types (taxonomy: improvement_resource_type) terms
		// Because if the user chooses to populate the carousel using the 'estyn_imp_resource' post type,
		// they can also choose which type of improvement resources to display
		apiFetch({ path: '/wp/v2/improvement_resource_type' }).then((data) => {
			let types = data.map((term) => {
				return { label: term.name, value: term.slug, id: term.id };
			});

			// Add an 'any' option
			types.unshift({ label: 'All', value: 'all' });

			//console.log('Improvement resource types:');
			//console.log(types);

			setImprovementResourceTypes(types);
		});
	}, []);

	useEffect(() => {
		//console.log('populateCarouselUsing updated to: ' + populateCarouselUsing);
		if(populateCarouselUsing === 'postIDs') {
			if(postIdsOfPostsToDisplayAsCarouselItems.length > 0) {
				let postsToAdd = [];
				// Fetch the posts based on the post IDs.
				postIdsOfPostsToDisplayAsCarouselItems.forEach((postId, index) => {
					//apiFetch({ path: `/wp/v2/posts?include=${postIdsOfPostsToDisplayAsCarouselItems.join(',')}` })
					apiFetch({ path: `/wp/v2/posts/${postId}` })
						.then((data) => {
							postsToAdd.push(data);

							if(index === postIdsOfPostsToDisplayAsCarouselItems.length - 1) {
								//console.log('Line 157 is setting posts');
								setPosts(postsToAdd);
							}
						});
				});
			}
		}
	}, [populateCarouselUsing]);

	useEffect(() => {
		//console.log('Posts after update:');
		//console.log(posts);
	}, [posts]);

	useEffect(() => {
		//console.log('postTypes updated to:');
		//console.log(postTypes);
	}), [postTypes];

	// Initial fetch of posts
	useEffect(() => {
		fetchPosts(populateCarouselUsing, postIdsOfPostsToDisplayAsCarouselItems, chosenImprovementResourceType, postTypes);
	}, [postTypes]);



	useEffect(() => {
		fetchPosts(populateCarouselUsing, postIdsOfPostsToDisplayAsCarouselItems, chosenImprovementResourceType, postTypes);
	}, [chosenImprovementResourceType, postTypeOfPostsToDisplayAsCarouselItems, populateCarouselUsing, postIdsOfPostsToDisplayAsCarouselItems]);


/* 	class ScrollDiv extends React.Component {
		constructor(props) {
			super(props);
			this.state = { scrollLeft: props.scrollLeft, content: props.content, className: props.className };
			this.divRef = React.createRef(); // Create a ref
		}

		componentDidMount() {
			this.divRef.current.scrollLeft = this.state.scrollLeft; // Set scrollLeft when component mounts
		}

 		componentDidUpdate(prevProps) {
			if (prevProps.scrollLeft !== this.props.scrollLeft) {
				this.setState({ scrollLeft: this.props.scrollLeft }, () => {
					this.divRef.current.scrollLeft = this.state.scrollLeft; // Update scrollLeft when props.scrollLeft changes
				});
			}
		}

		shouldComponentUpdate(nextProps, nextState) {
			// Only re-render if something other than scrollLeft has changed
			return (
				this.state.content !== nextState.content ||
				this.state.className !== nextState.className ||
				this.props.content !== nextProps.content ||
				this.props.className !== nextProps.className
			);
		}

		render() {
			const { content, className } = this.state;
			const actualContent = typeof content === 'function' ? content() : content;
			return (
				<div className={className} ref={this.divRef}>
					{actualContent}
				</div>
			)
		}
	} */



	

	useEffect(() => {
		//console.log('scrollLeft updated to: ' + scrollLeft);

		// If scrollLeft is equal or greater than scrollDivRef.current.scrollWidth - scrollDivRef.current.clientWidth, set scrollLeft to scrollDivRef.current.scrollWidth - scrollDivRef.current.clientWidth
		if(scrollDivref.current.scrollWidth - scrollDivref.current.clientWidth <= scrollLeft) {
			setScrollLeft(scrollDivref.current.scrollWidth - scrollDivref.current.clientWidth);
		} else if(scrollLeft < 0) {
			setScrollLeft(0);
		}

		scrollDivref.current.scrollLeft = scrollLeft;
	}, [scrollLeft]);

    return (
        <div { ...useBlockProps() }>
            <InspectorControls>
                <PanelBody title={ __( 'Carousel Settings', 'pobl-tech-carousel-block' ) }>
                    { __( 'Carousel Settings', 'pobl-tech-carousel-block' ) }
					<SelectControl
						label="Populate carousel using"
						value={ populateCarouselUsing }
						options={ [
							{ label: 'Choose posts', value: 'postIDs' },
							{ label: 'From post type', value: 'postType' },
						] }
						onChange={ ( value ) => setAttributes( { populateCarouselUsing: value } ) }
					/>
					{
						populateCarouselUsing === 'postType' && (
							<>
							<SelectControl
								label="Post Type of posts to display as carousel items"
								value={postTypeOfPostsToDisplayAsCarouselItems}
								options={postTypes}
								onChange={(value) => setAttributes({ postTypeOfPostsToDisplayAsCarouselItems: value })}
							/>
							{postTypeOfPostsToDisplayAsCarouselItems === 'estyn_imp_resource' && (
								<SelectControl
								label="Improvement Resource Type"
								value={chosenImprovementResourceType}
								options={improvementResourceTypes}
								onChange={(value) => setAttributes({ chosenImprovementResourceType: value })}
								/>
							)}
							</>
						)
					}
{/* 					<TextControl
						label="Post IDs"
						value={ postIdsOfPostsToDisplayAsCarouselItems.join(',') }
						//onChange={ ( value ) => setAttributes( { postIdsOfPostsToDisplayAsCarouselItems: value.split(',') } ) }
						onChange={ () => {} }
					/> */}
					<TextControl
						label="Button Text"
						value={ buttonText }
						onChange={ ( buttonText ) => setAttributes( { buttonText } ) }
					/>
					{ populateCarouselUsing === 'postIDs' && (
						<TextControl
							label="Button Link (if choosing posts)"
							value={ buttonLink }
							onChange={ ( buttonLink ) => setAttributes( { buttonLink } ) }
						/>
					)}
                </PanelBody>
            </InspectorControls>
            <div className="p-1">
				<section className="slideMenu py-5">
					<div className="px-5">
						<div className="row align-items-end mb-2">
							<div className="col-12 col-md-6">
								<RichText
									tagName="h2"
									value={ heading }
									onChange={ ( heading ) => setAttributes( { heading } ) }
									className="mb-0"
								/>
							</div>
							<div className="col-12 col-md-6">
								<div className="d-flex justify-content-end">
									<a className="btn btn-primary">{ buttonText }</a>
								</div>
							</div>
						</div>
						<div className="row align-items-end">
							<div className="col-12 col-md-6">
								<RichText
									tagName="p"
									value={ description }
									onChange={ ( description ) => setAttributes( { description } ) }
								/>
							</div>
							<div className="col-12 col-md-6 d-flex justify-content-between justify-content-md-end mb-3">
								{/*<a className="btn btn-outline-primary">All resources</a>*/}
								<div className="d-flex justify-content-end">
									{/*<a id={carouselId + "-slideLeft"} className="btn btn-link fs-5 text-white text-decoration-none">&lt;<i className="fa-sharp fa-solid fa-arrow-left"></i></a>
									<a id={carouselId + "-slideRight"} className="btn btn-link fs-5 text-white text-decoration-none">&gt;<i className="fa-sharp fa-solid fa-arrow-right"></i></a>*/}
									<Button
										label="Slide left"
										text="<"
										variant='primary'
										className='pobl-tech-carousel-slide-left-button fs-5 py-1 px-3 me-2'
										onClick={ () => {
											setScrollLeft(scrollLeft - 500);
											//
										} }
									/>
									<Button
										label="Slide right"
										text=">"
										variant='primary'
										className='pobl-tech-carousel-slide-right-button fs-5 py-1 px-3'
										onClick={ () => {
											setScrollLeft(scrollLeft + 500);
										} }
									/>
								</div>
							</div>
						</div>
					</div>
					<div ref={ scrollDivref } className="w-100 overflow-auto my-3 pb-4 pb-md-5 pobl-tech-carousel-block-slider" id={carouselId + "-scrollCont"}>
					{/*<ScrollDiv content={ () => (*/}
						<div className="ps-5">
							<div className="row">
								<div className="d-flex flex-row flex-nowrap px-0">
									{posts.map((post, index) => {
										//console.log('Post:');
										//console.log(post);
										let excerpt = stripHtml(post.excerpt.rendered);
										excerpt = excerpt.length > 200 ? excerpt.substring(0, 200) + "..." : excerpt;

										return (
											<div key={index} className="carousel-item-container">
												<div className="card me-4 h-100">
													<div className="slideCardBody">
														<img src={imageSrcs[post.id]} />
													</div>
													<div className="card-footer py-4 px-0">
														<h4 className="mb-0">{decodeHtmlEntities(post.title.rendered)}</h4>
														<p>{excerpt}</p>
													</div>
												</div>
												{populateCarouselUsing === 'postIDs' && (
													<Button
														label="Remove"
														text="X"
														variant='primary'
														className='pobl-tech-carousel-remove-post-button fs-5 py-1 px-3'
														onClick={ () => {
															const postsCopy = [...posts];
															postsCopy.splice(index, 1);
															setPosts(postsCopy);

															const postIdsCopy = [...postIdsOfPostsToDisplayAsCarouselItems];
															postIdsCopy.splice(index, 1);
															setAttributes({ postIdsOfPostsToDisplayAsCarouselItems: postIdsCopy });
														} }
													/>
												)}
											</div>
										);
									})}
								</div>
							</div>
						</div>
					{/*)} className="w-100 overflow-auto my-3 pb-4 pb-md-5 pobl-tech-carousel-block-slider" scrollLeft={scrollLeft} />*/}
					</div>
					<div className="container px-md-4 px-xl-5">
						{populateCarouselUsing === 'postIDs' && (
							<div className="row mt-5 justify-content-center">
								<div className="col-12 col-sm-4">
									<p>Choose a post to add as a carousel item:</p>
									<SelectControl
										label=""
										options={ allPostsToChooseFrom.map((post) => {
											return { label: post.title.rendered, value: post.id };
										}) }
										onChange={ ( value ) => {
											// Add the selected post to the posts array
											//const postToAdd = allPostsToChooseFrom.find((post) => post.id == value);
											//setPosts([...posts, postToAdd]);
											//setAttributes({ postIdsOfPostsToDisplayAsCarouselItems: [...postIdsOfPostsToDisplayAsCarouselItems, postToAdd.id] });

											setSelectedPostToAddId(value);
										} }
									/>
									<Button
										label="Add"
										text="Add"
										variant='primary'
										onClick={ () => {
											// Add the post (selected in the select box) to the posts array
											const postToAdd = allPostsToChooseFrom.find((post) => post.id == selectedPostToAddId);
											//console.log('Add button is setting posts');
											setPosts([...posts, postToAdd]);
											setAttributes({ postIdsOfPostsToDisplayAsCarouselItems: [...postIdsOfPostsToDisplayAsCarouselItems, postToAdd.id] });
											setScrollLeft(5000); // Scroll to the end
										} }
									/>
								</div>
							</div>
						)}
					</div>
				</section>
            </div>
        </div>
    );
}
