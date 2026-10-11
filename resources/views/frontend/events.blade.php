@extends('layouts.frontend')

@section('title', 'School Events & Photo Albums - ' . ($settings['site_title'] ?? 'Vigilant International School'))

@section('content')
    @include('frontend.partials.page-header', ['pageTitle' => 'School Events & Albums', 'breadcrumb' => 'Events'])

    <!-- Events Section Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto mb-5" style="max-width: 650px;">
                <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-3 py-2 rounded-pill mb-2 font-weight-bold">
                    <i class="fa fa-camera-retro me-1"></i> School Memories & Celebrations
                </span>
                <h1 class="mb-3 text-brand-dark">Our Events & Photo Albums</h1>
                <p class="text-muted">Relive the memorable moments, sports meets, academic exhibitions, and vibrant cultural galas that enrich our students' journeys.</p>
            </div>

            <div class="row g-4">
                @forelse($events as $event)
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden event-album-card transition-all">
                        <!-- Cover Image with Badges -->
                        <div class="position-relative overflow-hidden event-cover-wrap">
                            <a href="{{ route('events.show', $event->slug) }}">
                                <img class="img-fluid w-100 event-cover-img" src="{{ asset($event->cover_image ?? 'kider/img/carousel-1.jpg') }}" alt="{{ $event->title }}" style="height: 230px; object-fit: cover;">
                            </a>
                            <div class="position-absolute top-0 start-0 m-3">
                                <span class="badge bg-dark bg-opacity-75 text-white px-3 py-2 rounded-pill small shadow-sm backdrop-blur">
                                    <i class="fa fa-calendar-day me-1 text-warning"></i> {{ $event->formatted_date }}
                                </span>
                            </div>
                            <div class="position-absolute top-0 end-0 m-3">
                                <span class="badge bg-primary text-white px-3 py-2 rounded-pill small shadow-sm">
                                    <i class="fa fa-images me-1"></i> {{ $event->images->count() }} Photos
                                </span>
                            </div>
                        </div>

                        <!-- Card Body -->
                        <div class="card-body p-4 d-flex flex-column">
                            @if($event->location)
                            <div class="small text-muted mb-2">
                                <i class="fa fa-location-dot text-danger me-1"></i> {{ $event->location }}
                            </div>
                            @endif

                            <h5 class="card-title fw-bold mb-2">
                                <a href="{{ route('events.show', $event->slug) }}" class="text-dark text-decoration-none hover-primary">
                                    {{ $event->title }}
                                </a>
                            </h5>

                            <p class="card-text text-muted small flex-grow-1 mb-4" style="line-height: 1.6;">
                                {{ Str::limit($event->summary ?: $event->description, 110) }}
                            </p>

                            <!-- Button -->
                            <div class="mt-auto pt-2 border-top d-flex align-items-center justify-content-between">
                                <span class="small fw-semibold text-primary">
                                    <i class="fa fa-photo-film me-1"></i> View Album
                                </span>
                                <a href="{{ route('events.show', $event->slug) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3 py-1">
                                    Explore <i class="fa fa-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center py-5">
                    <div class="p-5 bg-light rounded-4">
                        <i class="fa fa-calendar-days text-muted fs-1 mb-3"></i>
                        <h4 class="text-dark">No Events Published Yet</h4>
                        <p class="text-muted">Stay tuned! Exciting school celebrations, sports galas, and exhibitions will be posted here soon.</p>
                        <a href="{{ route('home') }}" class="btn btn-primary rounded-pill px-4">Back to Home</a>
                    </div>
                </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($events->hasPages())
            <div class="d-flex justify-content-center mt-5">
                {{ $events->links() }}
            </div>
            @endif
        </div>
    </div>
    <!-- Events Section End -->
@endsection

@push('styles')
<style>
    .event-album-card {
        background: #ffffff;
        border: 1px solid rgba(12, 69, 152, 0.08) !important;
        transition: transform 0.35s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.35s ease, border-color 0.35s ease;
    }
    .event-album-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 18px 36px rgba(12, 69, 152, 0.12) !important;
        border-color: rgba(12, 69, 152, 0.25) !important;
    }
    .event-cover-wrap {
        position: relative;
    }
    .event-cover-img {
        transition: transform 0.45s ease;
    }
    .event-album-card:hover .event-cover-img {
        transform: scale(1.05);
    }
    .hover-primary {
        transition: color 0.25s ease;
    }
    .hover-primary:hover {
        color: #0c4598 !important;
    }
    .backdrop-blur {
        backdrop-filter: blur(4px);
    }
</style>
@endpush
