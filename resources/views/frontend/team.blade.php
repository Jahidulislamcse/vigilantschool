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
                <div class="col-6 col-md-6 col-lg-4 d-flex">
                    <div class="team-item w-100">
                        <div class="team-header-backdrop"></div>
                        <div class="team-avatar-wrap">
                            <img class="img-fluid team-photo" src="{{ asset($teacher->photo ?? 'kider/img/team-1.jpg') }}" alt="{{ $teacher->name }}">
                            <span class="team-verified-badge" title="Certified Educator"><i class="fas fa-check"></i></span>
                        </div>
                        <div class="team-text">
                            <h3 class="team-name">{{ $teacher->name }}</h3>
                            <div class="team-designation-wrap">
                                <span class="team-designation-badge">{{ $teacher->designation }}</span>
                            </div>
                            @if(!empty($teacher->bio))
                                <div class="team-bio-box">
                                    <i class="fas fa-quote-left team-quote-icon"></i>
                                    <p class="team-bio">{{ $teacher->bio }}</p>
                                </div>
                            @endif
                            @if($teacher->facebook_url || $teacher->twitter_url || $teacher->instagram_url)
                            <div class="team-social d-flex align-items-center justify-content-center">
                                @if($teacher->facebook_url)
                                    <a class="btn btn-square team-social-btn team-social-fb" href="{{ $teacher->facebook_url }}" target="_blank" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                                @endif
                                @if($teacher->twitter_url)
                                    <a class="btn btn-square team-social-btn team-social-tw" href="{{ $teacher->twitter_url }}" target="_blank" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                                @endif
                                @if($teacher->instagram_url)
                                    <a class="btn btn-square team-social-btn team-social-ig" href="{{ $teacher->instagram_url }}" target="_blank" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                                @endif
                            </div>
                            @endif
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
