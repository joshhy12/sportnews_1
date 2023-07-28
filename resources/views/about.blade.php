@extends('layouts.home')

@section('content')


<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link href="{{ asset('css/about.css') }}" rel="stylesheet">

<link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">


      <!-- Latest compiled css -->
      <link href="{{ asset('bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Latest compiled JavaScript -->
    <script src="{{ asset('bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center mb-5">
                    <h2 class="heading-section">Contact & Get in Touch</h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="wrapper">
                        <div class="row no-gutters mb-5">
                            <div class="col-md-7">
                                <div class="contact-wrap w-100 p-md-5 p-4">
                                    <h3 class="mb-4">Contact Us</h3>
                                    <div id="form-message-warning" class="mb-4"></div>
                                    <div id="form-message-success" class="mb-4">
                                        @if (session('success'))
                                        <div class="alert alert-success">
                                            {{ session('success') }}
                                        </div>
                                        @endif
                                    </div>
                                    @if (session('success'))
                                        <div class="alert alert-success">
                                            {{ session('success') }}
                                        </div>
                                        @endif

                                    <form method="POST" action="{{ route('contact.submit') }}">
                                        @csrf

                                        <div class="form-group">
                                            <label for="name">{{ __('Full Name') }}</label>
                                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autofocus>
                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="email">{{ __('Email Address') }}</label>
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="subject">{{ __('Subject') }}</label>
                                            <input id="subject" type="text" class="form-control @error('subject') is-invalid @enderror" name="subject" value="{{ old('subject') }}" required>
                                            @error('subject')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="message">{{ __('Message') }}</label>
                                            <textarea id="message" class="form-control @error('message') is-invalid @enderror" name="message" rows="4" required>{{ old('message') }}</textarea>
                                            @error('message')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Send Message') }}
                                        </button>
                                    </form>

                                </div>
                            </div>
                            <div class="col-md-5 d-flex align-items-stretch">
                                <div id="map"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="dbox w-100 text-center">
                                    <div class="icon d-flex align-items-center justify-content-center">
                                        <span class="fa fa-map-marker"></span>
                                    </div>
                                    <div class="text">
                                        <p><span>Address:</span> Arusha , Tanzania</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="dbox w-100 text-center">
                                    <div class="icon d-flex align-items-center justify-content-center">
                                        <span class="fa fa-phone"></span>
                                    </div>
                                    <div class="text">
                                        <p><span>Phone:</span> <a href="tel://0689192753">+255 689 192 753</a></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="dbox w-100 text-center">
                                    <div class="icon d-flex align-items-center justify-content-center">
                                        <span class="fa fa-paper-plane"></span>
                                    </div>
                                    <div class="text">
                                        <p><span>Email:</span> <a href="mailto:joshylucas1@gmail.com">joshylucas1@gmail.com</a></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="dbox w-100 text-center">
                                    <div class="icon d-flex align-items-center justify-content-center">
                                        <span class="fa fa-globe"></span>
                                    </div>
                                    <div class="text">
                                        <p><span>Website</span> <a href="http://127.0.0.1:8000/">Harusi.Online.com</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="{{ asset('JavaScript/jquery.min.js') }}"></script>
    <script src="{{ asset('JavaScript/popper.js') }}"></script>
    <script src="{{ asset('JavaScript/bootstrap.min.js') }}"></script>
    <script src="{{ asset('JavaScript/jquery.validate.min.js') }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCs82Xz_ZGJIDAycEug_-ai_KQRdETi2yY&sensor=false"></script>
    <script src="{{ asset('JavaScript/google-map.js') }}"></script>
    <script src="{{ asset('JavaScript/main.js') }}"></script>



    @endsection
