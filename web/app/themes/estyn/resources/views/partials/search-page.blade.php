{{--
  Search page can be:

  News/blog posts.
  Inspection reports.
  Inspection schedule?
  Improvement resources.

  They may share some of the same search filters,
  but mostly have their own.

  News/blog posts:
  - Type (news/blog)(News Articles is a CPT, blog posts are Posts)
  - Dates (year)
  - [Tags? (blog posts only)]
  - Sort: Publication date, title, type

  Inspection reports:
  - Sector
  - Local authority
  - Sort: Latest updated, publication date, title

  Inspection schedule:
  - Sector
  - Local authority

  Improvement resources:
  - Sector
  - Local authority
  - Tags
  - Updated??
  - Type (Thematic Report, Effective Practice, Annual Report, or Additional Resource)
  - Year
  - Sort: Latest updated, publication date, title, type
  - "Similar Settings to Mine"
    -- Proximity
    -- Number of learners
    -- Language medium
    -- Age range

  Provider search:
  - Sector
  - Local authority
  - Sort: Title

  Inspection Guidance & Frameworks search:
  (post type = estyn_inspguidance)
  - Sector
  - Tags
  - Type ('What and How We Inspect', 'Supplementary Guidance', 'Follow-up', 'Nominee handbook' in English.
         'Beth a sut rydym ni’n ei arolygu', 'Canllawiau atodol', 'Gweithgarwch dilynol', 'Llawlyfr enwebeion' in Welsh)
         (Taxonomy = inspection_guidance_type)
  
  Inspection Questionnaires search:
  (post type = estyn_insp_qu)
  - Sector
  - Tags
  - Categories (taxonomy = inspection_questionnaire_cat)
         
--}}

<div class="searchHero mt-5">
	<div class="container px-md-4 px-xl-5">
		<div class="row">
			<div class="col-12">
				<h1 class="mb-4">{{ get_the_title() }}</h1>
			</div>
		</div>
	</div>
</div>
<section class="searchBody mb-5">
	<div class="container px-md-4 px-xl-5">
		<div class="row">
			<!-- Search filter -->
			<div class="searchFilter col-12 col-md-4">
				<div class="row">
					<div class="col-12 col-md-11">

						<div id="search-box-container" class="input-group mb-4">
						  <input type="text" class="form-control" placeholder="" aria-label="Search filter" aria-describedby="searchFilter" value="{{ !empty($_GET['search']) ? $_GET['search'] : '' }}">
						  <button class="btn btn-primary" type="button" id="searchFilter"><i class="fa-sharp fa-solid fa-magnifying-glass"></i></button>
						</div>

            <button class="btn btn-outline-info d-md-none" data-bs-toggle="collapse" data-bs-target="#search-filters">{{ __('Filter results', 'sage' ) }}</button>
            <hr class="d-md-none">

            <div class="search-filters collapse d-md-block pb-5" id="search-filters">
              <h3>{{ __('Filters', 'sage') }}</h3>
              <div class="accordion accordion-flush pb-5 pb-sm-0" id="accordionFlushExample">
                @if(isset($isNewsAndBlog) && $isNewsAndBlog)
                  <div class="accordion-item">
                      <h2 class="accordion-header" id="flush-headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                          {{ __('Type', 'sage') }}
                        </button>
                      </h2>
                      <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="postType" id="flexCheckNewsAndBlog" checked>
                            <label class="form-check-label" for="flexCheckNewsAndBlog">
                              {{ __('All', 'sage') }}
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="postType" value="estyn_newsarticle" id="flexCheckNews">
                            <label class="form-check-label" for="flexCheckNews">
                              {{ __('News article', 'sage') }}
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="postType" value="post" id="flexCheckBlog">
                            <label class="form-check-label" for="flexCheckBlog">
                              {{ __('Blog post', 'sage') }}
                            </label>
                          </div>
                        </div>
                      </div>
                  </div>
                  <div class="accordion-item">
                      <h2 class="accordion-header" id="flush-headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                          {{ __('Dates', 'sage') }}
                        </button>
                      </h2>
                      <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="year" id="flexCheckYearDefault" checked>
                            <label class="form-check-label" for="flexCheckYearDefault">
                              {{ __('Any year', 'sage') }}
                            </label>
                          </div>
                          @for ($i = 2013; $i <= intval(date('Y')); $i++)
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="year" value="{{ $i }}" id="flexCheckYear{{ $i }}">
                              <label class="form-check-label" for="flexCheckYear{{ $i }}">
                                {{ $i }}
                              </label>
                            </div>
                          @endfor
                        </div>
                      </div>
                  </div>
                @else
                <div class="accordion-item">
                  <h2 class="accordion-header" id="flush-heading-sector">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse-sector" aria-expanded="false" aria-controls="flush-collapse-sector">
                      {{ __('Sector', 'sage') }}
                    </button>
                  </h2>
                  <div id="flush-collapse-sector" class="accordion-collapse collapse" aria-labelledby="flush-heading-sector" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="sector" value="any" id="flexCheckSector-any" checked>
                        <label class="form-check-label" for="flexCheckSector-any">
                          {{ __('Any sector', 'sage') }}
                        </label>
                      </div>
                      @foreach($sectors as $sector)
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="sector" value="{{ $sector->slug }}" id="flexCheckSector-{{ $sector->slug }}" {{ (!empty($_GET['sector'])) && (strtolower($_GET['sector']) == strtolower($sector->name)) ? 'checked' : '' }}>
                          <label class="form-check-label" for="flexCheckSector-{{ $sector->slug }}">
                            {{ $sector->name }}
                          </label>
                        </div>
                      @endforeach
                    </div>
                  </div>
                </div>
                @if(empty($isInspectionGuidanceSearch) && empty($isInspectionQuestionnairesSearch))
                <div class="accordion-item">
                  <h2 class="accordion-header" id="flush-headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                      {{ __('Local authority', 'sage') }}
                    </button>
                  </h2>
                  <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="localAuthority" value="Any" id="flexCheckLocalAuthority-any" checked>
                        <label class="form-check-label" for="flexCheckLocalAuthority-any">
                          {{ __('Any local authority', 'sage') }}
                        </label>
                      </div>
                      @foreach($localAuthorities as $localAuthority)
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="localAuthority" value="{{ $localAuthority->slug }}" id="flexCheckLocalAuthority-{{ $localAuthority->slug }}">
                          <label class="form-check-label" for="flexCheckLocalAuthority-{{ $localAuthority->slug }}">
                            {{ $localAuthority->name }}
                          </label>
                        </div>
                      @endforeach
                    </div>
                  </div>
                </div>
                @endif
                @if((!empty($isImprovementResourcesSearch) || (!empty($isInspectionGuidanceSearch))) && !empty($tags))
                <div class="accordion-item">
                  <h2 class="accordion-header" id="flush-headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                      {{ __('Tags', 'sage') }}
                    </button>
                  </h2>
                  <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                      <div class="tag-search-container">
                        <div class="form-group">
                            <input type="text" class="form-control" id="searchTags" placeholder="{{ __('Search tags', 'sage') }}">
                            <div id="tagList" class="tag-list">
                                @foreach($tags as $tag)
                                    <div class="form-check">
                                      <input class="form-check-input" type="checkbox" id="flexCheckTags-{{ $tag->slug }}" value="{{ $tag->slug }}" name="tags[]" {{ (!empty($_GET['tag'])) && (strtolower($_GET['tag']) == strtolower($tag->name)) ? 'checked' : '' }}>
                                      <label class="form-check-label" for="flexCheckTags-{{ $tag->slug }}">
                                          {{ $tag->name }}
                                      </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                      </div>
                      {{--@foreach($tags as $tag)
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" value="{{ $tag->slug }}" name="tags[]" {{ (!empty($_GET['tag'])) && (strtolower($_GET['tag']) == strtolower($tag->name)) ? 'checked' : '' }}>
                          <label class="form-check-label" for="flexCheckTags-{{ $tag->slug }}">
                            {{ $tag->name }}
                          </label>
                        </div>
                      @endforeach--}}
                    </div>
                  </div>
                </div>
                @endif
                @if(isset($isImprovementResourcesSearch) && $isImprovementResourcesSearch && isset($improvementResourceTypes) && !empty($improvementResourceTypes))
                  <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingFour">
                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
                        {{ __('Type', 'sage') }}
                      </button>
                    </h2>
                    <div id="flush-collapseFour" class="accordion-collapse collapse" aria-labelledby="flush-headingFour" data-bs-parent="#accordionFlushExample">
                      <div class="accordion-body">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="improvement_resource_type" value="any" id="flexCheckType-any" checked>
                          <label class="form-check-label" for="flexCheckType-any">
                            {{ __('Any type', 'sage') }}
                          </label>
                        </div>
                        @foreach($improvementResourceTypes as $improvementResourceType)
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="improvement_resource_type" value="{{ $improvementResourceType->slug }}" id="flexCheckType-{{ $improvementResourceType->slug }}" {{ (!empty($_GET['type'])) && (strtolower($_GET['type']) == strtolower($improvementResourceType->name)) ? 'checked' : '' }}>
                            <label class="form-check-label" for="flexCheckType-{{ $improvementResourceType->slug }}">
                              {{ $improvementResourceType->name }}
                            </label>
                          </div>
                        @endforeach
                      </div>
                    </div>
                  </div>
                  <div class="accordion-item">
                      <h2 class="accordion-header" id="flush-headingFive">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFive" aria-expanded="false" aria-controls="flush-collapseFive">
                          {{ __('Year', 'sage') }}
                        </button>
                      </h2>
                      <div id="flush-collapseFive" class="accordion-collapse collapse" aria-labelledby="flush-headingFive" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                          <div class="row">
                            <div class="col">
                              <label for="yearFrom">{{ __('From', 'sage') }}</label>
                              <select class="form-select" name="yearFrom" id="yearFrom">
                                @for ($i = 2005; $i <= intval(date('Y')); $i++)
                                  <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                              </select>
                            </div>
                            <div class="col">
                              <label for="yearTo">{{ __('To', 'sage') }}</label>
                              <select class="form-select" name="yearTo" id="yearTo">
                                @for ($i = 2005; $i <= intval(date('Y')); $i++)
                                  <option value="{{ $i }}" {{ $i == intval(date('Y')) ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                              </select>
                            </div>
                          </div>
                          {{--<div class="form-check">
                            <input class="form-check-input" type="radio" name="year" id="flexCheckYearDefault" checked>
                            <label class="form-check-label" for="flexCheckYearDefault">
                              {{ __('Any year', 'sage') }}
                            </label>
                          </div>
                          @for ($i = 2005; $i <= intval(date('Y')); $i++)
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="year" value="{{ $i }}" id="flexCheckYear{{ $i }}">
                              <label class="form-check-label" for="flexCheckYear{{ $i }}">
                                {{ $i }}
                              </label>
                            </div>
                          @endfor--}}
                        </div>
                      </div>
                  </div>
                @endif
                @if( (!empty($isInspectionGuidanceSearch)) && (!empty($inspectionGuidanceTypes)) )
                  <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingFour">
                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
                        {{ __('Type', 'sage') }}
                      </button>
                    </h2>
                    <div id="flush-collapseFour" class="accordion-collapse collapse" aria-labelledby="flush-headingFour" data-bs-parent="#accordionFlushExample">
                      <div class="accordion-body">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="improvement_resource_type" value="any" id="flexCheckType-any" checked>
                          <label class="form-check-label" for="flexCheckType-any">
                            {{ __('Any type', 'sage') }}
                          </label>
                        </div>
                        @foreach($inspectionGuidanceTypes as $inspectionGuidanceType)
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="improvement_resource_type" value="{{ $inspectionGuidanceType->slug }}" id="flexCheckType-{{ $inspectionGuidanceType->slug }}">
                            <label class="form-check-label" for="flexCheckType-{{ $inspectionGuidanceType->slug }}">
                              {{ $inspectionGuidanceType->name }}
                            </label>
                          </div>
                        @endforeach
                      </div>
                    </div>
                  </div>
                  <div class="accordion-item">
                      <h2 class="accordion-header" id="flush-headingFive">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFive" aria-expanded="false" aria-controls="flush-collapseFive">
                          {{ __('Year', 'sage') }}
                        </button>
                      </h2>
                      <div id="flush-collapseFive" class="accordion-collapse collapse" aria-labelledby="flush-headingFive" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="year" id="flexCheckYearDefault" checked>
                            <label class="form-check-label" for="flexCheckYearDefault">
                              {{ __('Any year', 'sage') }}
                            </label>
                          </div>
                          @for ($i = 2005; $i <= intval(date('Y')); $i++)
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="year" value="{{ $i }}" id="flexCheckYear{{ $i }}">
                              <label class="form-check-label" for="flexCheckYear{{ $i }}">
                                {{ $i }}
                              </label>
                            </div>
                          @endfor
                        </div>
                      </div>
                  </div>
                @endif
                @if( (!empty($isInspectionQuestionnairesSearch)) && (!empty($inspectionQuestionnaireCategories)) )
                  <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingFour">
                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
                        {{ __('Category', 'sage') }}
                      </button>
                    </h2>
                    <div id="flush-collapseFour" class="accordion-collapse collapse" aria-labelledby="flush-headingFour" data-bs-parent="#accordionFlushExample">
                      <div class="accordion-body">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="inspection_questionnaire_cat" value="any" id="flexCheckCategory-any" checked>
                          <label class="form-check-label" for="flexCheckCategory-any">
                            {{ __('Any category', 'sage') }}
                          </label>
                        </div>
                        @foreach($inspectionQuestionnaireCategories as $inspectionQuestionnaireCategory)
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="inspection_questionnaire_cat" value="{{ $inspectionQuestionnaireCategory->slug }}" id="flexCheckCategory-{{ $inspectionQuestionnaireCategory->slug }}">
                            <label class="form-check-label" for="flexCheckCategory-{{ $inspectionQuestionnaireCategory->slug }}">
                              {{ $inspectionQuestionnaireCategory->name }}
                            </label>
                          </div>
                        @endforeach
                      </div>
                    </div>
                  </div>
                  <div class="accordion-item">
                      <h2 class="accordion-header" id="flush-headingFive">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFive" aria-expanded="false" aria-controls="flush-collapseFive">
                          {{ __('Year', 'sage') }}
                        </button>
                      </h2>
                      <div id="flush-collapseFive" class="accordion-collapse collapse" aria-labelledby="flush-headingFive" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="year" id="flexCheckYearDefault" checked>
                            <label class="form-check-label" for="flexCheckYearDefault">
                              {{ __('Any year', 'sage') }}
                            </label>
                          </div>
                          @for ($i = 2005; $i <= intval(date('Y')); $i++)
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="year" value="{{ $i }}" id="flexCheckYear{{ $i }}">
                              <label class="form-check-label" for="flexCheckYear{{ $i }}">
                                {{ $i }}
                              </label>
                            </div>
                          @endfor
                        </div>
                      </div>
                  </div>
                @endif
                @endif
              </div>
            
            @if(!empty($isImprovementResourcesSearch))
              <h4 class="pt-4">{{ __('Similar Settings to Mine', 'sage') }}</h4>
              <div class="search-filters accordion accordion-flush" id="accordionFlushExample">
                <div class="accordion-item">
                  <h2 class="accordion-header" id="flush-headingProximity">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseProximity" aria-expanded="false" aria-controls="flush-collapseProximity">
                      {{ __('Proximity', 'sage') }}
                    </button>
                  </h2>
                  <div id="flush-collapseProximity" class="accordion-collapse collapse" aria-labelledby="flush-headingProximity" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                      <div class="form-input mb-2">
                        <label for="proximityPostcode" class="form-label">{{ __('Postcode', 'sage') }}:</label>
                        <input type="text" class="form-control proximityPostcode" id="proximityPostcode" name="proximityPostcode" placeholder="{{ __('Enter a postcode', 'sage') }}">
                      </div>

                      <div class="form-input mb-2">
                        <label for="proximityRange" class="form-label">{{ __('Search radius', 'sage') }}:</label>
                        <select class="form-select proximity-range" name="proximity" id="proximityRange">
                          <option value="0-0.1">{{ __('This area only', 'sage') }}</option>
                          <option value="0-0.25">{{ __('Within 1/4 mile', 'sage') }}</option>
                          <option value="0-0.5">{{ __('Within 1/2 mile', 'sage') }}</option>
                          <option value="0-1">{{ __('Within 1 mile', 'sage') }}</option>
                          <option value="0-3">{{ __('Within 3 miles', 'sage') }}</option>
                          <option value="0-5">{{ __('Within 5 miles', 'sage') }}</option>
                          <option value="0-10">{{ __('Within 10 miles', 'sage') }}</option>
                          <option value="0-15">{{ __('Within 15 miles', 'sage') }}</option>
                          <option value="0-20">{{ __('Within 20 miles', 'sage') }}</option>
                          <option value="0-30">{{ __('Within 30 miles', 'sage') }}</option>
                          <option value="0-40">{{ __('Within 40 miles', 'sage') }}</option>
                        </select>
                      </div>
     
                      {{--@for($i = 10; $i < 250; $i += 10)
                        <div class="form-check">
                          <input class="form-check-input proximity-range"  type="radio" name="proximity" value="0-{{ $i }}" id="flexCheckProximity-0-{{ $i }}">
                          <label class="form-check-label" for="flexCheckProximity-0-{{ $i }}">
                            0-{{ $i }} {{ __('miles', 'sage') }}
                          </label>
                        </div>
                      @endfor--}}

                    </div>
                  </div>
                </div>
                {{--<div class="accordion-item">
                  <h2 class="accordion-header" id="flush-headingLearners">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseLearners" aria-expanded="false" aria-controls="flush-collapseLearners">
                      {{ __('Number of learners', 'sage') }}
                    </button>
                  </h2>
                  <div id="flush-collapseLearners" class="accordion-collapse collapse" aria-labelledby="flush-headingLearners" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="learners" value="any" id="flexCheckLearners-any" checked>
                        <label class="form-check-label" for="flexCheckLearners-any">
                          {{ __('Any number of learners', 'sage') }}
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="learners" value="0-50" id="flexCheckLearners-0-50">
                        <label class="form-check-label" for="flexCheckLearners-0-50">
                          {{ __('0-50', 'sage') }}
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="learners" value="50-100" id="flexCheckLearners-50-100">
                        <label class="form-check-label" for="flexCheckLearners-50-100">
                          {{ __('50-100', 'sage') }}
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="learners" value="100-200" id="flexCheckLearners-100-200">
                        <label class="form-check-label" for="flexCheckLearners-100-200">
                          {{ __('100-200', 'sage') }}
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="learners" value="200-500" id="flexCheckLearners-200-500">
                        <label class="form-check-label" for="flexCheckLearners-200-500">
                          {{ __('200-500', 'sage') }}
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="learners" value="500-1000" id="flexCheckLearners-500-1000">
                        <label class="form-check-label" for="flexCheckLearners-500-1000">
                          {{ __('500-1000', 'sage') }}
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="learners" value="1000+" id="flexCheckLearners-1000-plus">
                        <label class="form-check-label" for="flexCheckLearners-1000-plus">
                          {{ __('1000+', 'sage') }}
                        </label>
                      </div>
                    </div>
                  </div>
                </div>--}}
                <div class="accordion-item">
                  <h2 class="accordion-header" id="flush-headingLanguageMedium">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseLanguageMedium" aria-expanded="false" aria-controls="flush-collapseLanguageMedium">
                      {{ __('Language medium', 'sage') }}
                    </button>
                  </h2>
                  <div id="flush-collapseLanguageMedium" class="accordion-collapse collapse" aria-labelledby="flush-headingLanguageMedium" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="languageMedium" value="any" id="flexCheckLanguageMedium-any" checked>
                        <label class="form-check-label" for="flexCheckLanguageMedium-any">
                          {{ __('Any language medium', 'sage') }}
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="languageMedium" value="Welsh" id="flexCheckLanguageMedium-welsh">
                        <label class="form-check-label" for="flexCheckLanguageMedium-welsh">
                          {{ __('Welsh', 'sage') }}
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="languageMedium" value="English" id="flexCheckLanguageMedium-english">
                        <label class="form-check-label" for="flexCheckLanguageMedium-english">
                          {{ __('English', 'sage') }}
                        </label>
                      </div>
                    </div>
                  </div>
                </div>
                {{--<div class="accordion-item">
                  <h2 class="accordion-header" id="flush-headingAgeRange">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseAgeRange" aria-expanded="false" aria-controls="flush-collapseAgeRange">
                      {{ __('Age range', 'sage') }}
                    </button>
                  </h2>
                  <div id="flush-collapseAgeRange" class="accordion-collapse collapse" aria-labelledby="flush-headingAgeRange" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="ageRange" value="any" id="flexCheckAgeRange-any" checked>
                        <label class="form-check-label" for="flexCheckAgeRange-any">
                          {{ __('Any age range', 'sage') }}
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="ageRange" value="0-3" id="flexCheckAgeRange-0-3">
                        <label class="form-check-label" for="flexCheckAgeRange-0-3">
                          {{ __('0-3', 'sage') }}
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="ageRange" value="3-11" id="flexCheckAgeRange-3-11">
                        <label class="form-check-label" for="flexCheckAgeRange-3-11">
                          {{ __('3-11', 'sage') }}
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="ageRange" value="11-16" id="flexCheckAgeRange-11-16">
                        <label class="form-check-label" for="flexCheckAgeRange-11-16">
                          {{ __('11-16', 'sage') }}
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="ageRange" value="16-18" id="flexCheckAgeRange-16-18">
                        <label class="form-check-label" for="flexCheckAgeRange-16-18">
                          {{ __('16-18', 'sage') }}
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="ageRange" value="18-21" id="flexCheckAgeRange-18-21">
                        <label class="form-check-label" for="flexCheckAgeRange-18-21">
                          {{ __('18-21', 'sage') }}
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="ageRange" value="21+" id="flexCheckAgeRange-21-plus">
                        <label class="form-check-label" for="flexCheckAgeRange-21-plus">
                          {{ __('21+', 'sage') }}
                        </label>
                      </div>                      
                    </div>
                  </div>
                </div>--}}
              </div>
            
            @endif
            </div>
					</div>
				</div>
			</div>
			<!-- Search Results -->
      @php
        $isNewsAndBlog = isset($isNewsAndBlog) ? $isNewsAndBlog : false;
        $isInspectionReportsSearch = isset($isInspectionReportsSearch) ? $isInspectionReportsSearch : false;
        $isInspectionScheduleSearch = isset($isInspectionScheduleSearch) ? $isInspectionScheduleSearch : false;

        $isProviderSearch = isset($isProviderSearch) ? $isProviderSearch : false;

        $isImprovementResourcesSearch = isset($isImprovementResourcesSearch) ? $isImprovementResourcesSearch : false;

        $isInspectionGuidanceSearch = isset($isInspectionGuidanceSearch) ? $isInspectionGuidanceSearch : false;

        $isInspectionQuestionnairesSearch = isset($isInspectionQuestionnairesSearch) ? $isInspectionQuestionnairesSearch : false;

        $searchQuery = null;
        $searchArgs = null;

        if(isset($_GET['paged'])) {
          $searchArgs['paged'] = intval($_GET['paged']);
        }

        if($isNewsAndBlog) {
          $searchArgs = [
            'post_type' => ['estyn_newsarticle', 'post'],
            'posts_per_page' => 10,
            'orderby' => 'meta_value',
            'meta_key' => 'last_updated',
            'order' => 'DESC'
          ];

          // If there's a Wordpress search query in the URL then add it to the search args
          if(isset($_GET['search'])) {
            $searchArgs['s'] = trim($_GET['search']);
          }
        } elseif($isImprovementResourcesSearch) {
          $searchArgs = [
            'post_type' => 'estyn_imp_resource',
            'posts_per_page' => 10,
            'orderby' => 'meta_value',
            'meta_key' => 'last_updated',
            'order' => 'DESC'
          ];

          // If there's a Wordpress search query in the URL then add it to the search args
          if(isset($_GET['search'])) {
            $searchArgs['s'] = trim($_GET['search']);
          }

          // Sectors
          if(isset($_GET['sector']) && $_GET['sector'] != 'any') {
            $searchArgs['tax_query'] = [
              [
                'taxonomy' => 'sector',
                'field' => 'slug',
                'terms' => $_GET['sector']
              ]
            ];
          }

          // Local authorities
          if(isset($_GET['localAuthority']) && $_GET['localAuthority'] != 'Any') {
            $searchArgs['tax_query'] = [
              [
                'taxonomy' => 'local_authority',
                'field' => 'slug',
                'terms' => $_GET['localAuthority']
              ]
            ];
          }

          // Tags
          if(isset($_GET['tag']) && !empty($_GET['tag'])) {
            $searchArgs['tax_query'] = [
              [
                'taxonomy' => 'post_tag',
                'field' => 'slug',
                'terms' => $_GET['tag']
              ]
            ];
          }

          // Improvement resource type
          if(isset($_GET['improvement_resource_type']) && $_GET['improvement_resource_type'] != 'any') {
            $searchArgs['tax_query'] = [
              [
                'taxonomy' => 'improvement_resource_type',
                'field' => 'slug',
                'terms' => $_GET['improvement_resource_type']
              ]
            ];
          }

          // Year
          if(isset($_GET['year']) && $_GET['year'] != 'any') {
            $searchArgs['date_query'] = [
              [
                'year' => $_GET['year']
              ]
            ];
          }

        } elseif($isInspectionGuidanceSearch) {
          $searchArgs = [
            'post_type' => 'estyn_inspguidance',
            'posts_per_page' => 10,
            'order' => 'DESC'
          ];

          // If there's a Wordpress search query in the URL then add it to the search args
          if(isset($_GET['search'])) {
            $searchArgs['s'] = trim($_GET['search']);
          }

          // Sector
          if(isset($_GET['sector']) && $_GET['sector'] != 'any') {
            $searchArgs['tax_query'] = [
              [
                'taxonomy' => 'sector',
                'field' => 'slug',
                'terms' => $_GET['sector']
              ]
            ];
          }

          // Tags
          if(isset($_GET['tag']) && !empty($_GET['tag'])) {
            $searchArgs['tax_query'] = [
              [
                'taxonomy' => 'post_tag',
                'field' => 'slug',
                'terms' => $_GET['tag']
              ]
            ];
          }

          // Inspection guidance type
          if(isset($_GET['inspection_guidance_type']) && $_GET['inspection_guidance_type'] != 'any') {
            $searchArgs['tax_query'] = [
              [
                'taxonomy' => 'inspection_guidance_type',
                'field' => 'slug',
                'terms' => $_GET['inspection_guidance_type']
              ]
            ];
          }
        } elseif($isInspectionQuestionnairesSearch) {
          $searchArgs = [
            'post_type' => 'estyn_insp_qu',
            'posts_per_page' => 10,
            'order' => 'DESC'
          ];

          // If there's a Wordpress search query in the URL then add it to the search args
          if(isset($_GET['search'])) {
            $searchArgs['s'] = trim($_GET['search']);
          }

          // Sector
          if(isset($_GET['sector']) && $_GET['sector'] != 'any') {
            $searchArgs['tax_query'] = [
              [
                'taxonomy' => 'sector',
                'field' => 'slug',
                'terms' => $_GET['sector']
              ]
            ];
          }

          // Tags
          if(isset($_GET['tag']) && !empty($_GET['tag'])) {
            $searchArgs['tax_query'] = [
              [
                'taxonomy' => 'post_tag',
                'field' => 'slug',
                'terms' => $_GET['tag']
              ]
            ];
          }

          // Categories
          if(isset($_GET['inspection_questionnaire_cat']) && $_GET['inspection_questionnaire_cat'] != 'any') {
            $searchArgs['tax_query'] = [
              [
                'taxonomy' => 'inspection_questionnaire_cat',
                'field' => 'slug',
                'terms' => $_GET['inspection_questionnaire_cat']
              ]
            ];
          }
        } elseif($isInspectionReportsSearch) {
          $searchArgs = [
            'post_type' => 'estyn_inspectionrpt',
            'posts_per_page' => 10,
            'orderby' => 'meta_value',
            'meta_key' => 'inspection_date',
          ];

          // If there's a Wordpress search query in the URL then add it to the search args
          if(isset($_GET['search'])) {
            $searchArgs['s'] = trim($_GET['search']);
          }

          // Sector
          if(isset($_GET['sector']) && $_GET['sector'] != 'any') {
            $searchArgs['tax_query'] = [
              [
                'taxonomy' => 'sector',
                'field' => 'slug',
                'terms' => $_GET['sector']
              ]
            ];
          }

          // Local authority
          if(isset($_GET['localAuthority']) && $_GET['localAuthority'] != 'Any') {
            $searchArgs['tax_query'] = [
              [
                'taxonomy' => 'local_authority',
                'field' => 'slug',
                'terms' => $_GET['localAuthority']
              ]
            ];
          }
        } elseif($isProviderSearch) {
          $searchArgs = [
            'post_type' => 'estyn_eduprovider',
            'posts_per_page' => 10,
            'orderby' => 'title',
          ];
        } elseif($isInspectionScheduleSearch) {
          // In this case we need to get all the providers (eduproviders),
          // for which the get_field('next_scheduled_inspection_date')
          // or get_post_meta(get_the_ID(), 'next_visit_date_old_db', true)
          // is not empty and is a date that's today or later,
          // and order them by the next scheduled inspection date
          $searchArgs = [
            'post_type' => 'estyn_eduprovider',
            'posts_per_page' => 10,
            'meta_query' => [
              'relation' => 'OR',
              [
                'key' => 'next_scheduled_inspection_date',
                'value' => date('Y-m-d'),
                'compare' => '>=',
                'type' => 'DATE'
              ],
              [
                'key' => 'next_visit_date_old_db',
                'value' => date('Y-m-d'),
                'compare' => '>=',
                'type' => 'DATE'
              ]
            ],
            'orderby' => 'meta_value',
            'meta_key' => 'next_scheduled_inspection_date',
            'order' => 'ASC'
          ];
        }

        /*if(!empty($searchArgs)) {
          $searchQuery = new WP_Query($searchArgs);
        }*/
      @endphp
			<div class="searchResultsMain col-12 col-md-8">
				<div class="row">
					<div class="col-12">
						<div class="d-flex align-items-center align-items-md-start justify-content-between">
							<span><span class="search-results-number">{{ (!empty($searchQuery)) && $searchQuery->have_posts() ? $searchQuery->found_posts : '0' }}</span> {{ __('result/s', 'sage') }}</span>
              <span class="d-flex align-items-center">
                @if(empty($isProviderSearch) && empty($isInspectionScheduleSearch))
                  <label class="text-nowrap me-3" for="sort-by">{{ __('Sort by', 'sage') }}</label>
                  <select id="sort-by" class="form-select">
                    @if((!isset($isNewsAndBlog) || !$isNewsAndBlog) && (!isset($isProviderSearch) || !$isProviderSearch) && (!isset($isInspectionScheduleSearch) || !$isInspectionScheduleSearch) && !(isset($isInspectionReportsSearch)) )
                      <option value="lastUpdated">{{ __('Latest updated', 'sage') }}</option>
                    @endif
                    @if(!isset($isProviderSearch) || !$isProviderSearch)
                      <option value="date">{{ __('Publication date', 'sage') }}</option>
                    @endif
                    @if(isset($isInspectionReportsSearch) && $isInspectionReportsSearch)
                      <option value="lastUpdated">{{ __('Latest updated', 'sage') }}</option>
                    @endif
                    <option value="title">{{ __('Title', 'sage') }}</option>
                    @if((isset($isImprovementResourcesSearch) && $isImprovementResourcesSearch) || (isset($isNewsAndBlog) && $isNewsAndBlog))
                      <option value="type">{{ __('Type', 'sage') }}</option>
                    @endif
                  </select>
                @endif
              </span>
						</div>
						<hr class="hrGreen my-3">
					</div>
					<div class="col-12 position-relative">
            <div class="search-results-loading-indicator-container d-flex justify-content-center">
              <div class="search-results-loading-indicator spinner-border text-primary" role="status">
                <span class="visually-hidden">{{ __('Loading', 'sage') }}...</span>
              </div>
            </div>
            <div id="search-results-container">
              <div id="search-results">
                <div class="list-group list-group-flush resourceList">
                  @if(!empty($searchQuery))
                    @php
                      $items = [];
                    @endphp
                    @if($searchQuery->have_posts())
                      @while($searchQuery->have_posts())
                        @php
                          $searchQuery->the_post();

                          $reportFileURL = null;//$firstPDFAttachment = null; // Used for inspection reports

                          // If the post type is 'estyn_inspectionrpt',
                          // and the post doesn't have any attachments that is/are PDFs,
                          // then skip this post
                          if(get_post_type() == 'estyn_inspectionrpt') {
                            global $post;
                            $reportFileURL = App\getInspectionReportFileURL($post);

                            if(empty($reportFileURL)) {
                              continue; // Skip this post
                            }
                          }

                          $postTypeName = (get_post_type_object(get_post_type()))->labels->singular_name;
                          if($postTypeName == __('Post', 'sage')) {
                            $postTypeName = __('Blog post', 'sage');
                          }

                          $postTypeName = ucfirst(strtolower($postTypeName));

                          if($isInspectionReportsSearch) {
                            $items[] = [
                              'linkURL' => $reportFileURL, //wp_get_attachment_url($firstPDFAttachment->ID), // We will have skipped this post if there are no PDF attachments
                              'superText' => __('Inspection report', 'sage'),
                              'superDate' => get_the_date('d/m/Y'),
                              'title' => get_the_title(),
                            ];
                          }elseif($isInspectionScheduleSearch) {
                            $items[] = [ // Provider stuff
                              'linkURL' => get_the_permalink(),
                              'superText' => __('Upcoming inspection', 'sage'),
                              'superDate' => get_field('next_scheduled_inspection_date') ? get_field('next_scheduled_inspection_date') : get_post_meta(get_the_ID(), 'next_visit_date_old_db', true),
                              'title' => get_the_title()
                            ];
                          } else {
                            $items[] = [
                              'linkURL' => get_the_permalink(),
                              'superText' => $postTypeName,
                              'superDate' => get_the_date('d/m/Y'),
                              'title' => get_the_title()
                            ];
                          }
                        @endphp
                      @endwhile

                      @php
                        wp_reset_postdata();
                      @endphp
                    @endif

                    @if(!empty($items))
                      @include('components.resource-list', [
                        'items' => $items
                      ])
                    @else
                      <p>{{ __('No results found', 'sage') }}</p>
                    @endif
                  @else
                  {{--@if(isset($isNewsAndBlog) && $isNewsAndBlog)
                                    @include('components.resource-list', [
                                        'items' => [
                                            [
                                                'linkURL' => '#',
                                                'superText' => 'News article',
                                                'superDate' => '24/01/2024',
                                                'title' => 'Improving teaching through an emphasis on professional learning'
                                            ],
                                            [
                                                'linkURL' => '#',
                                                'superText' => 'News article',
                                                'superDate' => '24/01/2024',
                                                'title' => 'Improving attendance in secondary schools'
                                            ],
                                            [
                                                'linkURL' => '#',
                                                'superText' => 'News article',
                                                'superDate' => '24/01/2024',
                                                'title' => 'Improving attendance in secondary schools - training materials'
                                            ],
                                            [
                                                'linkURL' => '#',
                                                'superText' => 'News article',
                                                'superDate' => '24/01/2024',
                                                'title' => 'Developing early communication skills with predominantly pre verbal pupils'
                                            ],
                                            [
                                                'linkURL' => '#',
                                                'superText' => 'News article',
                                                'superDate' => '24/01/2024',
                                                'title' => 'Motivating pupils to speak Welsh'
                                            ],
                                            [
                                                'linkURL' => '#',
                                                'superText' => 'News article',
                                                'superDate' => '24/01/2024',
                                                'title' => 'Developing a programme to provide targeted support for vulnerable learners to improve their attendance'
                                            ]
                                        ]
                                    ])
                                @elseif(isset($isInspectionReportsSearch) && $isInspectionReportsSearch)
                                    @include('components.resource-list', [
                                        'items' => [
                                            [
                                                'linkURL' => '#',
                                                'superText' => 'Inspection report',
                                                'superDate' => '24/01/2024',
                                                'title' => 'Cardiff High School'
                                            ],
                                            [
                                                'linkURL' => '#',
                                                'superText' => 'Inspection report',
                                                'superDate' => '21/03/2023',
                                                'title' => 'Cwmbran High School'
                                            ]
                                        ]
                                    ])
                                @elseif(isset($isInspectionScheduleSearch) && $isInspectionScheduleSearch)
                                  @include('components.resource-list', [
                                    'items' => [
                                      [
                                        'linkURL' => '#',
                                        'superText' => 'Upcoming inspection',
                                        'superDate' => '05/11/2024',
                                        'title' => 'Cardiff High School'
                                      ],
                                      [
                                        'linkURL' => '#',
                                        'superText' => 'Upcoming inspection',
                                        'superDate' => '15/12/2024',
                                        'title' => 'Cwmbran High School'
                                      ]
                                    ]
                                  ])
                                @else
                                @include('components.resource-list', [
                                    'items' => [
                                        [
                                            'linkURL' => '#',
                                            'superText' => 'Effective practice',
                                            'superDate' => '24/01/2024',
                                            'title' => 'Improving teaching through an emphasis on professional learning'
                                        ],
                                        [
                                            'linkURL' => '#',
                                            'superText' => 'Effective practice',
                                            'superDate' => '24/01/2024',
                                            'title' => 'Improving attendance in secondary schools'
                                        ],
                                        [
                                            'linkURL' => '#',
                                            'superText' => 'Effective practice',
                                            'superDate' => '24/01/2024',
                                            'title' => 'Improving attendance in secondary schools - training materials'
                                        ],
                                        [
                                            'linkURL' => '#',
                                            'superText' => 'Effective practice',
                                            'superDate' => '24/01/2024',
                                            'title' => 'Developing early communication skills with predominantly pre verbal pupils'
                                        ],
                                        [
                                            'linkURL' => '#',
                                            'superText' => 'Effective practice',
                                            'superDate' => '24/01/2024',
                                            'title' => 'Motivating pupils to speak Welsh'
                                        ],
                                        [
                                            'linkURL' => '#',
                                            'superText' => 'Effective practice',
                                            'superDate' => '24/01/2024',
                                            'title' => 'Developing a programme to provide targeted support for vulnerable learners to improve their attendance'
                                        ]
                                    ]
                                ])
                                @endif--}}
                              @endif
                </div>
              </div>
            </div>
            <div class="d-flex justify-content-between mt-3">
              <button class="search-results-prev-button btn btn-outline-primary">{{ __('Previous', 'sage') }}</button>
              <button class="search-results-next-button btn btn-outline-primary">{{ __('Next', 'sage') }}</button>
            </div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@push('scripts')
	<script>
		(function($) {
			let searchBoxTypingTimer = setTimeout(function() {}, 0);
			const searchBoxTypingInterval = 500;
      let currentPage = 1;

      let postcodeBoxTypingTimer = setTimeout(function() {}, 0);
      const postcodeBoxTypingInterval = searchBoxTypingInterval;

			$(document).ready(function() {
				hideSearchResultsLoadingIndicator();

				$(".search-filters input:not([type='text']), .search-filters select").on("change", function() {
          if($(this).hasClass('proximity-range') && $("#proximityPostcode").val().trim() == "") {
            // Add Bootstrap error class/es to the postcode input
            $("#proximityPostcode").addClass('is-invalid');
            return;
          }
          $("#proximityPostcode").removeClass('is-invalid');
          
          currentPage = 1;
					applyFilters();
				});

				$("#search-box-container input[type='text']").on("keydown keyup", function(key) {
					if(key.keyCode === 13) {
						clearTimeout(searchBoxTypingTimer);

						applyFilters();

						return;
					}
				});

				$("#search-box-container input[type='text']").on("input", function() {
					clearTimeout(searchBoxTypingTimer);

					searchBoxTypingTimer = setTimeout(function() {
            currentPage = 1;
						applyFilters();
					}, searchBoxTypingInterval);
				});

				$("#search-box-container button").on("click", function() {
          currentPage = 1;
					applyFilters();
				});

				$("#sort-by").on("change", function() {
					applyFilters();
				});

        $(".search-filters .proximityPostcode").on("input", function() {
          clearTimeout(postcodeBoxTypingTimer);

          if($(this).val().trim() != "") {
            $("#proximityPostcode").removeClass('is-invalid');
          }

          const self = $(this); // Preserve the context

          postcodeBoxTypingTimer = setTimeout(() => { // Use arrow function
            //if($("#flexCheckProximity-any").is(":checked") || self.val().trim() === "" || self.val().trim().length < 3) {
            if(self.val().trim() === "" || self.val().trim().length < 3) {
              return;
            }
            applyFilters();
          }, postcodeBoxTypingInterval);
        });

        $("#searchTags").on("keyup", function(key) {
          filterTags();
        });

        @if(!empty($searchArgs))
          applyFilters(true);
        @endif
			});

			function applyFilters(firstApply = false) {
				clearTimeout(searchBoxTypingTimer);
				showSearchResultsLoadingIndicator();

        if(!firstApply) {
          // Set the height of the search results container to the current height of the search results,
          // to help prevent the page from jumping/flashing
          $("#search-results-container").css('height', $("#search-results").height() + 'px');
        }

				$("#search-results").fadeOut(250, function() {
					let searchFilters = getSearchFilters();
          // Add a 'language' key and value to the searchFilters object
          searchFilters.language = "{{ pll_current_language() }}";
          //console.log('Language: ' + searchFilters.language);
          searchFilters.paged = currentPage;

					$.ajax({
						url: estyn.resources_search_rest_url,
						type: "GET",
						data: searchFilters,
						beforeSend: function(xhr) {
							xhr.setRequestHeader('X-WP-Nonce', estyn.nonce);
						},
						success: function(response) {
							//console.log(response);
							
								$("#search-results").html(response.html);
								$("#search-results").fadeIn(250, function() {
                  $("#search-results-container").css('height', 'auto');
                });
								$(".search-results-number").text(response.totalPosts);

                $(".search-results-prev-button, .search-results-next-button").off("click").hide();
                if(response.totalPosts > 10) {
                  if(response.prevPage) {
                    $(".search-results-prev-button").on("click", function() {
                      currentPage = response.prevPage;
                      applyFilters();
                    }).show();
                  }
                  if(response.nextPage) {
                    $(".search-results-next-button").on("click", function() {
                      currentPage = response.nextPage;
                      applyFilters();
                    }).show();
                  }
                }

							
							
							hideSearchResultsLoadingIndicator();
						}
					});
				});
			}

      @if(isset($isNewsAndBlog) && $isNewsAndBlog)        
			function getSearchFilters() {
				let postType = "";
				if($("#flexCheckNews").is(":checked")) {
					postType = $("#flexCheckNews").val();
				} else if($("#flexCheckBlog").is(":checked")) {
					postType = $("#flexCheckBlog").val();
				}

				let sort = $("#sort-by").val();
				
				return {
					postType: postType,
          // year: $("#flush-collapseTwo input:checked").val(),
					yearFrom: $("#yearFrom").val(),
          yearTo: $("#yearTo").val(),
					searchText: $("#search-box-container input[type='text']").val().trim(),
					sort: sort
				};
			}
      @elseif(isset($isInspectionReportsSearch) && $isInspectionReportsSearch)
      function getSearchFilters() {
        return {
          postType: "estyn_inspectionrpt",
          sector: $("#flush-collapse-sector input:checked").val(),
          localAuthority: $("#flush-collapseTwo input:checked").val(),
          searchText: $("#search-box-container input[type='text']").val().trim(),
          sort: $("#sort-by").val()
        };
      }

      @elseif(isset($isInspectionScheduleSearch) && $isInspectionScheduleSearch)
      function getSearchFilters() {
        return {
          postType: "estyn_eduprovider",
          sector: $("#flush-collapse-sector input:checked").val(),
          localAuthority: $("#flush-collapseTwo input:checked").val(),
          searchText: $("#search-box-container input[type='text']").val().trim(),
          inspectionSchedule: true
        };
      }

      @elseif(isset($isInspectionGuidanceSearch) && $isInspectionGuidanceSearch)
      function getSearchFilters() {
        return {
          postType: "estyn_inspguidance",
          sector: $("#flush-collapse-sector input:checked").val(),
          searchText: $("#search-box-container input[type='text']").val().trim(),
          sort: $("#sort-by").val(),
          tags: $("#flush-collapseThree input:checked").map(function() {
            return $(this).val();
          }).get(),
          inspectionGuidanceType: $("#flush-collapseFour input:checked").val()
        };
      }

      @elseif(isset($isInspectionQuestionnairesSearch) && $isInspectionQuestionnairesSearch)
      function getSearchFilters() {
        return {
          postType: "estyn_insp_qu",
          sector: $("#flush-collapse-sector input:checked").val(),
          searchText: $("#search-box-container input[type='text']").val().trim(),
          sort: $("#sort-by").val(),
          tags: $("#flush-collapseThree input:checked").map(function() {
            return $(this).val();
          }).get(),
          inspectionQuestionnaireCategory: $("#flush-collapseFour input:checked").val()
        };
      }

      @elseif(isset($isProviderSearch) && $isProviderSearch)
      function getSearchFilters() {
        return {
          postType: "estyn_eduprovider",
          sector: $("#flush-collapse-sector input:checked").val(),
          localAuthority: $("#flush-collapseTwo input:checked").val(),
          searchText: $("#search-box-container input[type='text']").val().trim()
        };
      }
      @elseif(isset($isImprovementResourcesSearch) && $isImprovementResourcesSearch)
      function getSearchFilters() {
        return {
          postType: "estyn_imp_resource",
          sector: $("#flush-collapse-sector input:checked").val(),
          localAuthority: $("#flush-collapseTwo input:checked").val(),
          searchText: $("#search-box-container input[type='text']").val().trim(),
          sort: $("#sort-by").val(),
          tags: $("#flush-collapseThree input:checked").map(function() {
            return $(this).val();
          }).get(),
          improvementResourceType: $("#flush-collapseFour input:checked").val(),
          // year: $("#flush-collapseTwo input:checked").val(),
					yearFrom: $("#yearFrom").val(),
          yearTo: $("#yearTo").val(),
          //numLearners: $("#flush-collapseLearners input:checked").val(),
          languageMedium: $("#flush-collapseLanguageMedium input:checked").val(),
          //ageRange: $("#flush-collapseAgeRange input:checked").val(),
          //proximity: $("#flush-collapseProximity input:checked").val(),
          proximity: $("#proximityRange").val(),
          proximityPostcode: $("#flush-collapseProximity input[type='text']").val().trim()
        };
      }
      @endif

			function hideSearchResultsLoadingIndicator() {
				$(".search-results-loading-indicator-container").animate({
					opacity: 0
				}, 1000);
			}

			function showSearchResultsLoadingIndicator() {
				$(".search-results-loading-indicator-container").animate({
					opacity: 1
				}, 250);
			}

      function filterTags() {
          var input, filter, tagList, tags, label, i, txtValue;
          input = document.getElementById('searchTags');
          filter = input.value.toUpperCase();
          tagList = document.getElementById("tagList");
          tags = tagList.getElementsByClassName('form-check');

          for (i = 0; i < tags.length; i++) {
              label = tags[i].getElementsByTagName("label")[0];
              txtValue = label.textContent || label.innerText;
              if (txtValue.toUpperCase().indexOf(filter) > -1) {
                  tags[i].style.display = "";
              } else {
                  tags[i].style.display = "none";
              }
          }
      }
		})(jQuery);
	</script>
@endpush