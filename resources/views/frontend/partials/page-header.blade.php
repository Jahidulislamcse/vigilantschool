<!-- Page Header Start -->
<div class="container-xxl py-5 page-header position-relative mb-5">
    <div class="container py-5">
        <h1 class="display-2 text-white animated slideInDown mb-4">{{ $pageTitle ?? 'Page' }}</h1>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb">
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
