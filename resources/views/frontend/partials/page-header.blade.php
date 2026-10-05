<!-- Page Header Start -->
<div class="container-xxl py-3 py-md-5 page-header position-relative mb-3 mb-md-5">
    <div class="container py-2 py-md-4">
        <h1 class="display-3 text-white page-header-title mb-2 mb-md-3">{{ $pageTitle ?? 'Page' }}</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                @if(isset($parentTitle) && isset($parentUrl))
                    <li class="breadcrumb-item"><a href="{{ $parentUrl }}">{{ $parentTitle }}</a></li>
                @endif
                <li class="breadcrumb-item text-white active" aria-current="page">{{ $pageTitle ?? 'Page' }}</li>
            </ol>
        </nav>
    </div>
</div>
<!-- Page Header End -->
