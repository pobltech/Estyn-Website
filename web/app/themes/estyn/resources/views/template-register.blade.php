{{--
    Template name: Register
--}}
@extends('layouts.app')
@section('content')

    @include('partials.page-header', [
        'title' => $title ?? get_the_title(),
        'subtitle' => $subtitle ?? null,
        'readTime' => $readTime ?? null,
        'shareLinkURL' => $shareLinkURL ?? '#',
        'date' => $date ?? null
    ])

    <div class="w-100 register-for-updates">
        <div class="container px-md-4 px-xl-5">
            <div class="row d-flex justify-content-center">
                <div class="col-12 col-lg-10 col-xl-8">
                    <div class="row">
                        <div class="col-12">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ultrices nisl et risus tristique, et ornare eros vulputate. Vivamus justo sem, elementum congue nisl ut, elementum tristique neque. In dolor ante, pellentesque eget posuere non, dapibus in enim. Maecenas non porta ipsum, id lobortis ante. Morbi mattis vel libero sed fringilla. Curabitur convallis quis leo non auctor. Vestibulum varius laoreet pretium. Nam vehicula ipsum vitae ex gravida tincidunt. </p>
                            <hr>
                            <h3>Manage your newsletter subscriptions</h3>
                            <p>Select the newsletter(s) to which you want to subscribe.</p>
                            <form>
                                <div class="row">
                                    <div class="col-12 col-md-6 mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Email address</label>
                                    <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                                    </div>
                                    <div class="col-12 col-md-6 mb-3">
                                    <label for="firstName" class="form-label">First name</label>
                                    <input type="text" class="form-control" id="firstName">
                                    </div>
                                    <div class="col-12 col-md-6 mb-3">
                                    <label for="lastName" class="form-label">Last name</label>
                                    <input type="text" class="form-control" id="lastName">
                                    </div>
                                    <div class="col-12 mb-3">
                                        <p><strong>What are you interested in hearing about?</strong></p>
                                        <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Adult learning in the community
                                        </label>
                                        </div>
                                        <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                                        <label class="form-check-label" for="flexCheckChecked">
                                            Further education
                                        </label>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection