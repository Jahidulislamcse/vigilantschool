@extends('layouts.frontend')

@section('title', 'Teachers & Staff - ' . ($settings['site_title'] ?? 'Kider'))

@section('content')
    @include('frontend.partials.page-header', ['pageTitle' => 'Teachers', 'breadcrumb' => 'Teachers'])

    <!-- Team Start -->
    @if(isset($teachers) && $teachers->count() > 0)
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto mb-5" style="max-width: 600px;">
                <h1 class="mb-3">Our Dedicated Educators</h1>
                <p>Passionate, caring, and certified educators devoted to nurturing your child's innate curiosity and personal growth.</p>
            </div>
            <div class="row g-4">
                @foreach($teachers as $index => $teacher)
                <div class="col-lg-4 col-md-6">
                    <div class="team-item position-relative">
                        <img class="img-fluid rounded-circle w-75" style="height: 250px; width: 250px !important; object-fit: cover;" src="{{ asset($teacher->photo ?? 'kider/img/team-1.jpg') }}" alt="{{ $teacher->name }}">
                        <div class="team-text">
                            <h3>{{ $teacher->name }}</h3>
                            <p>{{ $teacher->designation }}</p>
                            <div class="d-flex align-items-center">
                                @if($teacher->facebook_url)
                                    <a class="btn btn-square btn-primary mx-1" href="{{ $teacher->facebook_url }}" target="_blank"><i class="fab fa-facebook-f"></i></a>
                                @endif
                                @if($teacher->twitter_url)
                                    <a class="btn btn-square btn-primary mx-1" href="{{ $teacher->twitter_url }}" target="_blank"><i class="fab fa-twitter"></i></a>
                                @endif
                                @if($teacher->instagram_url)
                                    <a class="btn btn-square btn-primary mx-1" href="{{ $teacher->instagram_url }}" target="_blank"><i class="fab fa-instagram"></i></a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif
    <!-- Team End -->
@endsection
