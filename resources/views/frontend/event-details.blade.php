@extends('layouts.frontend')

@section('title', $event->title . ' - Event Album - ' . ($settings['site_title'] ?? 'Vigilant International School'))

@section('content')
    @include('frontend.partials.page-header', ['pageTitle' => 'Event Album', 'breadcrumb' => 'Events'])

    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <!-- Main Content -->
                <div class="col-lg-8">
                    <!-- Event Header Card -->
                    <div class="mb-4">
                        <div class="d-flex flex-wrap align-items-center gap-2 mb-3">
                            <span class="badge bg-primary px-3 py-2 rounded-pill">
                                <i class="fa fa-calendar-day me-1"></i> {{ $event->formatted_date }}
                            </span>
                            @if($event->location)
                            <span class="badge bg-light text-dark border px-3 py-2 rounded-pill">
                                <i class="fa fa-location-dot text-danger me-1"></i> {{ $event->location }}
                            </span>
                            @endif
                            <span class="badge bg-secondary px-3 py-2 rounded-pill">
                                <i class="fa fa-images me-1"></i> {{ $event->images->count() }} Album Photos
                            </span>
                        </div>
                        <h1 class="display-6 fw-bold text-brand-dark mb-3">{{ $event->title }}</h1>
                        @if($event->summary)
                            <p class="lead text-muted fs-6 mb-4">{{ $event->summary }}</p>
                        @endif
                    </div>

                    <!-- Main Cover Image -->
                    <div class="position-relative rounded-4 overflow-hidden shadow-sm mb-4 border">
                        <img src="{{ asset($event->cover_image ?? 'kider/img/carousel-1.jpg') }}" alt="{{ $event->title }}" class="img-fluid w-100" style="max-height: 420px; object-fit: cover;">
                    </div>

                    <!-- Event Description -->
                    @if($event->description)
                    <div class="p-4 bg-white rounded-4 shadow-sm border mb-5">
                        <h4 class="fw-bold text-dark mb-3"><i class="fa fa-circle-info text-primary me-2"></i> About This Celebration</h4>
                        <div class="text-secondary" style="line-height: 1.8; white-space: pre-line;">
                            {{ $event->description }}
                        </div>
                    </div>
                    @endif

                    <!-- Photo Album Gallery Grid -->
                    <div class="mb-5">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div>
                                <h3 class="fw-bold text-brand-dark mb-1">
                                    <i class="fa fa-photo-film text-primary me-2"></i> Event Photo Album
                                </h3>
                                <small class="text-muted">Click any photo to open full-screen album viewer</small>
                            </div>
                            <span class="badge bg-primary-subtle text-primary border px-3 py-2 rounded-pill">
                                {{ $event->images->count() }} Captured Memories
                            </span>
                        </div>

                        @if($event->images->count() > 0)
                        <div class="row g-3" id="albumGallery">
                            @foreach($event->images as $index => $img)
                            <div class="col-6 col-sm-6 col-md-4">
                                <div class="album-photo-card position-relative rounded-3 overflow-hidden shadow-sm border cursor-pointer" 
                                     onclick="openLightbox({{ $index }})"
                                     data-src="{{ asset($img->image) }}"
                                     data-caption="{{ $img->caption ?: $event->title . ' - Photo #' . ($index + 1) }}">
                                    <img src="{{ asset($img->image) }}" alt="{{ $img->caption ?? $event->title }}" class="img-fluid w-100 album-thumbnail" style="height: 180px; object-fit: cover;">
                                    <div class="album-photo-overlay d-flex flex-column align-items-center justify-content-center text-white p-2">
                                        <i class="fa fa-magnifying-glass-plus fs-3 mb-1"></i>
                                        <small class="text-center px-1" style="font-size: 0.72rem;">{{ Str::limit($img->caption, 40) ?: 'View Photo' }}</small>
                                    </div>
                                    <span class="position-absolute bottom-0 start-0 m-2 badge bg-dark bg-opacity-75 text-white" style="font-size: 0.65rem;">
                                        #{{ $index + 1 }}
                                    </span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @else
                        <div class="p-4 bg-light rounded-4 text-center text-muted">
                            <i class="fa fa-images fs-1 text-black-50 mb-2"></i>
                            <p class="mb-0">Additional album photos are being curated for this event. Check back soon!</p>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4">
                    <!-- Recent Events Widget -->
                    <div class="card border-0 shadow-sm rounded-4 mb-4">
                        <div class="card-header bg-white py-3 border-bottom">
                            <h5 class="fw-bold mb-0 text-dark">
                                <i class="fa fa-calendar-days text-primary me-2"></i> Other Events & Albums
                            </h5>
                        </div>
                        <div class="card-body p-3">
                            @forelse($recentEvents as $re)
                            <div class="d-flex align-items-center gap-3 p-2 rounded hover-bg-light transition-all mb-2">
                                <img src="{{ asset($re->cover_image ?? 'kider/img/carousel-1.jpg') }}" alt="{{ $re->title }}" class="rounded shadow-sm" style="width: 70px; height: 60px; object-fit: cover;">
                                <div class="flex-grow-1 overflow-hidden">
                                    <small class="text-primary fw-semibold d-block" style="font-size: 0.72rem;">
                                        <i class="fa fa-calendar-day me-1"></i> {{ $re->formatted_date }}
                                    </small>
                                    <a href="{{ route('events.show', $re->slug) }}" class="text-dark text-decoration-none fw-bold small text-truncate d-block hover-primary">
                                        {{ $re->title }}
                                    </a>
                                    <small class="text-muted" style="font-size: 0.7rem;">
                                        <i class="fa fa-images me-1"></i> {{ $re->images->count() }} Photos
                                    </small>
                                </div>
                            </div>
                            @empty
                            <p class="text-muted small mb-0 p-2">No other events published currently.</p>
                            @endforelse

                            <div class="pt-3 border-top mt-2 text-center">
                                <a href="{{ route('events.index') }}" class="btn btn-outline-primary btn-sm rounded-pill w-100">
                                    View All Events <i class="fa fa-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Book Tour CTA Widget -->
                    <div class="card border-0 shadow-sm rounded-4 bg-primary text-white p-4 text-center">
                        <div class="mb-3">
                            <i class="fa fa-graduation-cap display-4 opacity-75"></i>
                        </div>
                        <h4 class="fw-bold text-white mb-2">Experience Our Campus</h4>
                        <p class="small text-white-50 mb-4">
                            Schedule a personalized school tour and meet our educators to experience our vibrant community firsthand.
                        </p>
                        <a href="{{ route('appointment') }}" class="btn btn-warning rounded-pill fw-bold text-dark px-4 py-2">
                            Book A School Tour <i class="fa fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Lightbox Modal Viewer -->
    <div class="modal fade" id="lightboxModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content bg-dark border-0 rounded-4 overflow-hidden">
                <div class="modal-header border-0 bg-black bg-opacity-50 text-white py-2 px-3">
                    <span id="lightboxCounter" class="badge bg-secondary" style="font-size: 0.75rem;">1 / 1</span>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0 text-center position-relative bg-black d-flex align-items-center justify-content-center" style="min-height: 400px; max-height: 80vh;">
                    <img id="lightboxImg" src="" alt="Album Photo Preview" class="img-fluid" style="max-height: 75vh; object-fit: contain;">
                    
                    <!-- Prev / Next buttons -->
                    <button type="button" class="btn btn-dark bg-opacity-50 text-white position-absolute start-0 top-50 translate-middle-y m-2 rounded-circle d-flex align-items-center justify-content-center" style="width: 44px; height: 44px;" onclick="prevLightbox()">
                        <i class="fa fa-chevron-left"></i>
                    </button>
                    <button type="button" class="btn btn-dark bg-opacity-50 text-white position-absolute end-0 top-50 translate-middle-y m-2 rounded-circle d-flex align-items-center justify-content-center" style="width: 44px; height: 44px;" onclick="nextLightbox()">
                        <i class="fa fa-chevron-right"></i>
                    </button>
                </div>
                <div class="modal-footer border-0 bg-black bg-opacity-50 text-white justify-content-center py-2">
                    <p id="lightboxCaption" class="mb-0 small text-white-50"></p>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
<style>
    .album-photo-card {
        cursor: pointer;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .album-photo-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 24px rgba(12, 69, 152, 0.15) !important;
    }
    .album-thumbnail {
        transition: transform 0.4s ease;
    }
    .album-photo-card:hover .album-thumbnail {
        transform: scale(1.08);
    }
    .album-photo-overlay {
        position: absolute;
        inset: 0;
        background: rgba(10, 34, 64, 0.65);
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    .album-photo-card:hover .album-photo-overlay {
        opacity: 1;
    }
    .hover-bg-light:hover {
        background-color: #f8fafc;
    }
    .hover-primary:hover {
        color: #0c4598 !important;
    }
</style>
@endpush

@push('scripts')
<script>
    const albumPhotos = [
        @foreach($event->images as $img)
        {
            src: "{{ asset($img->image) }}",
            caption: "{{ addslashes($img->caption ?: $event->title . ' - Photo #' . ($loop->iteration)) }}"
        },
        @endforeach
    ];

    let currentIndex = 0;
    let lightboxModalInstance = null;

    function openLightbox(index) {
        if (!albumPhotos.length) return;
        currentIndex = index;
        updateLightboxContent();

        const modalEl = document.getElementById('lightboxModal');
        if (!lightboxModalInstance) {
            lightboxModalInstance = new bootstrap.Modal(modalEl);
        }
        lightboxModalInstance.show();
    }

    function updateLightboxContent() {
        const item = albumPhotos[currentIndex];
        document.getElementById('lightboxImg').src = item.src;
        document.getElementById('lightboxCaption').textContent = item.caption;
        document.getElementById('lightboxCounter').textContent = (currentIndex + 1) + ' / ' + albumPhotos.length;
    }

    function nextLightbox() {
        if (!albumPhotos.length) return;
        currentIndex = (currentIndex + 1) % albumPhotos.length;
        updateLightboxContent();
    }

    function prevLightbox() {
        if (!albumPhotos.length) return;
        currentIndex = (currentIndex - 1 + albumPhotos.length) % albumPhotos.length;
        updateLightboxContent();
    }

    // Keyboard navigation (ArrowLeft / ArrowRight / Escape)
    document.addEventListener('keydown', function(e) {
        const modalEl = document.getElementById('lightboxModal');
        if (modalEl && modalEl.classList.contains('show')) {
            if (e.key === 'ArrowRight') nextLightbox();
            if (e.key === 'ArrowLeft') prevLightbox();
        }
    });
</script>
@endpush
