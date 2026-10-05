@extends('layouts.frontend')

@section('title', 'Teachers & Staff - ' . ($settings['site_title'] ?? 'Kider'))

@section('content')
    @include('frontend.partials.page-header', ['pageTitle' => 'Teachers', 'breadcrumb' => 'Teachers'])

    <!-- Team Start -->
    @if(isset($teachers) && $teachers->count() > 0)
    <div class="container-xxl py-4 py-md-5">
        <div class="container">
            <div class="text-center mx-auto mb-4 mb-md-5" style="max-width: 600px;">
                <span class="badge bg-primary-subtle text-primary border px-3 py-2 rounded-pill mb-2 font-weight-bold">Academic Faculty</span>
                <h1 class="mb-3">Our Dedicated Educators</h1>
                <p class="text-muted">Passionate, caring, and certified educators devoted to nurturing your child's innate curiosity and personal growth.</p>
            </div>
            <div class="row g-2 g-md-3 g-lg-4">
                @foreach($teachers as $index => $teacher)
                <div class="col-6 col-md-6 col-lg-4">
                    <div class="team-item">
                        <img class="img-fluid team-photo" src="{{ asset($teacher->photo ?? 'kider/img/team-1.jpg') }}" alt="{{ $teacher->name }}">
                        <div class="team-text">
                            <h3>{{ $teacher->name }}</h3>
                            <p class="team-designation">{{ $teacher->designation }}</p>
                            <div class="d-flex align-items-center justify-content-center">
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
