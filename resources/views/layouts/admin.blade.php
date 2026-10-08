<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>@yield('title', 'Admin Panel') - {{ $settings['site_title'] ?? 'Vigilant International School' }}</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    
    <!-- Favicon -->
    <link href="{{ asset($settings['site_favicon'] ?? 'kider/img/favicon.ico') }}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            --primary: #0c4598;
            --primary-dark: #093472;
            --primary-light: #e8f0fe;
            --secondary: #e31b23;
            --secondary-dark: #be1218;
            --accent: #0e9f4b;
            --sidebar-bg: #0a2240;
            --sidebar-hover: #13335a;
            --sidebar-active: #0c4598;
            --light-bg: #f4f7fc;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--light-bg);
            color: #333;
            min-height: 100vh;
        }

        /* Sidebar Styling */
        #sidebar-wrapper {
            min-height: 100vh;
            width: 260px;
            background: var(--sidebar-bg);
            transition: all 0.3s ease;
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 1000;
            overflow-y: auto;
        }

        #sidebar-wrapper .sidebar-heading {
            padding: 1.25rem 1.5rem;
            font-size: 1.2rem;
            font-weight: 700;
            color: #fff;
            background: rgba(0, 0, 0, 0.2);
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }

        #sidebar-wrapper .sidebar-heading span {
            color: var(--secondary);
        }

        .sidebar-section-title {
            padding: 0.8rem 1.5rem 0.3rem;
            font-size: 0.72rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #8da4aa;
            font-weight: 700;
        }

        .list-group-item-sidebar {
            background: transparent;
            color: #cfdadd;
            border: none;
            padding: 0.75rem 1.5rem;
            display: flex;
            align-items: center;
            font-size: 0.92rem;
            font-weight: 500;
            transition: all 0.2s ease;
            text-decoration: none;
            border-left: 3px solid transparent;
        }

        .list-group-item-sidebar:hover {
            background: var(--sidebar-hover);
            color: #fff;
            padding-left: 1.75rem;
        }

        .list-group-item-sidebar.active {
            background: rgba(12, 69, 152, 0.45);
            color: #fff;
            border-left: 4px solid var(--secondary);
            font-weight: 600;
        }

        .list-group-item-sidebar i {
            width: 24px;
            margin-right: 10px;
            font-size: 1rem;
            color: #9cb3b8;
        }

        .list-group-item-sidebar.active i {
            color: #60a5fa;
        }

        .list-group-item-sidebar.disabled {
            opacity: 0.42;
            cursor: not-allowed !important;
            pointer-events: none;
            color: #718898 !important;
        }

        .list-group-item-sidebar.disabled i {
            color: #556c7a !important;
        }

        .list-group-item-sidebar.disabled:hover {
            background: transparent !important;
            padding-left: 1.5rem !important;
            color: #718898 !important;
        }

        /* Page Content */
        #page-content-wrapper {
            margin-left: 260px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            transition: all 0.3s ease;
        }

        /* Top Navbar */
        .top-navbar {
            background: #fff;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            padding: 0.75rem 1.5rem;
            position: sticky;
            top: 0;
            z-index: 900;
        }

        .content-body {
            padding: 1.75rem 1.5rem;
            flex-grow: 1;
        }

        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.04);
            margin-bottom: 1.5rem;
        }

        .card-header {
            background-color: #fff;
            border-bottom: 1px solid #edf2f7;
            padding: 1.1rem 1.5rem;
            font-weight: 600;
            font-size: 1.05rem;
            border-top-left-radius: 12px !important;
            border-top-right-radius: 12px !important;
        }

        .btn-primary {
            background-color: var(--primary);
            border-color: var(--primary);
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
            border-color: var(--primary-dark);
        }

        .btn-outline-primary {
            color: var(--primary);
            border-color: var(--primary);
        }

        .btn-outline-primary:hover {
            background-color: var(--primary);
            border-color: var(--primary);
            color: #fff;
        }

        @media (max-width: 991.98px) {
            #sidebar-wrapper {
                margin-left: -260px;
            }
            #sidebar-wrapper.toggled {
                margin-left: 0;
            }
            #page-content-wrapper {
                margin-left: 0;
            }
        }
    </style>
    @stack('styles')
</head>
<body>

<div class="d-flex" id="wrapper">
    <!-- Sidebar -->
    <div id="sidebar-wrapper">
        <div class="sidebar-heading d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                @if(!empty($settings['site_logo']))
                    <img src="{{ asset($settings['site_logo']) }}" alt="Logo" class="me-2 rounded bg-white p-1" style="height: 38px; width: 38px; object-fit: contain;">
                @else
                    <i class="fa fa-graduation-cap text-primary me-2 fs-4"></i>
                @endif
                <div>
                    <div style="font-size: 0.95rem; font-weight: 700; line-height: 1.2;">{{ $settings['site_title'] ?? 'Vigilant School' }}</div>
                    <small class="text-white-50 fs-6 fw-normal">Control Panel</small>
                </div>
            </div>
        </div>

        <div class="py-2">
            <a href="{{ route('home') }}" target="_blank" class="list-group-item-sidebar text-warning mb-2 bg-dark bg-opacity-25">
                <i class="fa fa-external-link-alt text-warning"></i>
                <span>View Website</span>
            </a>

            <div class="sidebar-section-title">Navigation</div>
            <a href="{{ route('admin.dashboard') }}" class="list-group-item-sidebar {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fa fa-gauge-high"></i>
                <span>Dashboard</span>
            </a>

            <div class="sidebar-section-title">Admissions & Inquiries</div>
            <a href="{{ route('admin.appointments.index') }}" class="list-group-item-sidebar {{ request()->routeIs('admin.appointments.*') ? 'active' : '' }}">
                <i class="fa fa-calendar-check"></i>
                <span>Tour Bookings</span>
                @php $pendingAppointments = \App\Models\Appointment::where('status', 'pending')->count(); @endphp
                @if($pendingAppointments > 0)
                    <span class="badge bg-danger rounded-pill ms-auto small">{{ $pendingAppointments }}</span>
                @endif
            </a>
            <a href="{{ route('admin.contacts.index') }}" class="list-group-item-sidebar {{ request()->routeIs('admin.contacts.*') ? 'active' : '' }}">
                <i class="fa fa-envelope"></i>
                <span>Contact Inquiries</span>
                @php $unreadContacts = \App\Models\Contact::where('is_read', false)->count(); @endphp
                @if($unreadContacts > 0)
                    <span class="badge bg-danger rounded-pill ms-auto small">{{ $unreadContacts }}</span>
                @endif
            </a>
            <a href="{{ route('admin.newsletters.index') }}" class="list-group-item-sidebar {{ request()->routeIs('admin.newsletters.*') ? 'active' : '' }}">
                <i class="fa fa-newspaper"></i>
                <span>Subscribers</span>
            </a>

            <div class="sidebar-section-title">Academics & Faculty</div>
            <a href="{{ route('admin.classes.index') }}" class="list-group-item-sidebar {{ request()->routeIs('admin.classes.*') ? 'active' : '' }}">
                <i class="fa fa-graduation-cap"></i>
                <span>Classes & Programs</span>
            </a>
            <a href="{{ route('admin.teachers.index') }}" class="list-group-item-sidebar {{ request()->routeIs('admin.teachers.*') ? 'active' : '' }}">
                <i class="fa fa-chalkboard-user"></i>
                <span>Teachers & Staff</span>
            </a>

            <div class="sidebar-section-title">Content & Brand</div>
            <a href="{{ route('admin.sliders.index') }}" class="list-group-item-sidebar {{ request()->routeIs('admin.sliders.*') ? 'active' : '' }}">
                <i class="fa fa-images"></i>
                <span>Hero Sliders</span>
            </a>
            <a href="{{ route('admin.facilities.index') }}" class="list-group-item-sidebar {{ request()->routeIs('admin.facilities.*') ? 'active' : '' }}">
                <i class="fa fa-school-flag"></i>
                <span>School Facilities</span>
            </a>
            <a href="{{ route('admin.about.index') }}" class="list-group-item-sidebar {{ request()->routeIs('admin.about.*') ? 'active' : '' }}">
                <i class="fa fa-circle-info"></i>
                <span>About & Mission</span>
            </a>
            <a href="{{ route('admin.testimonials.index') }}" class="list-group-item-sidebar {{ request()->routeIs('admin.testimonials.*') ? 'active' : '' }}">
                <i class="fa fa-comments"></i>
                <span>Parent Reviews</span>
            </a>
            <a href="{{ route('admin.galleries.index') }}" class="list-group-item-sidebar {{ request()->routeIs('admin.galleries.*') ? 'active' : '' }}">
                <i class="fa fa-photo-film"></i>
                <span>Photo Gallery</span>
            </a>
            <a href="{{ route('admin.settings.index') }}" class="list-group-item-sidebar {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                <i class="fa fa-sliders"></i>
                <span>School Settings</span>
            </a>
        </div>
    </div>

    <!-- Page Content Wrapper -->
    <div id="page-content-wrapper">
        <!-- Top Navbar -->
        <nav class="top-navbar d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <button class="btn btn-outline-secondary btn-sm me-3 d-lg-none" id="sidebarToggle">
                    <i class="fa fa-bars"></i>
                </button>
                <div class="d-flex align-items-center">
                    <h5 class="mb-0 fw-semibold text-dark">@yield('page-title', 'Dashboard')</h5>
                </div>
            </div>

            <div class="d-flex align-items-center gap-3">
                <a href="{{ route('home') }}" target="_blank" class="btn btn-sm btn-outline-primary rounded-pill px-3 d-none d-sm-inline-flex align-items-center">
                    <i class="fa fa-arrow-up-right-from-square me-1"></i> View Website
                </a>

                <div class="dropdown">
                    <button class="btn btn-light rounded-pill dropdown-toggle d-flex align-items-center px-3 py-1 border" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px; font-weight: 600;">
                            {{ substr(auth()->user()->name ?? 'Admin', 0, 1) }}
                        </div>
                        <span class="fw-medium text-dark">{{ auth()->user()->name ?? 'Administrator' }}</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2">
                        <li>
                            <div class="px-3 py-2 border-bottom">
                                <p class="mb-0 fw-bold">{{ auth()->user()->name ?? 'Administrator' }}</p>
                                <small class="text-muted">{{ auth()->user()->email ?? 'admin@vigilantschool.com' }}</small>
                            </div>
                        </li>
                        <li><a class="dropdown-item py-2" href="{{ route('admin.settings.index') }}"><i class="fa fa-sliders me-2 text-muted"></i> School Settings</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form action="{{ route('admin.logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger py-2">
                                    <i class="fa fa-arrow-right-from-bracket me-2"></i> Log Out
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Main Content Area -->
        <main class="content-body">
            <!-- Flash Message Alerts -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
                    <div class="d-flex align-items-center">
                        <i class="fa fa-circle-check fs-5 me-2"></i>
                        <div><strong>Success!</strong> {{ session('success') }}</div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm" role="alert">
                    <div class="d-flex align-items-center">
                        <i class="fa fa-circle-exclamation fs-5 me-2"></i>
                        <div><strong>Error!</strong> {{ session('error') }}</div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(isset($errors) && $errors->any())
                <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm" role="alert">
                    <div class="d-flex align-items-start">
                        <i class="fa fa-circle-exclamation fs-5 me-2 mt-1"></i>
                        <div>
                            <strong>Please fix the following issues:</strong>
                            <ul class="mb-0 mt-1 ps-3">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="bg-white border-top py-3 px-4 text-center text-muted small mt-auto">
            &copy; {{ date('Y') }} <strong>{{ $settings['site_title'] ?? 'Vigilant International School' }}</strong> - Management System.
        </footer>
    </div>
</div>

<!-- Bootstrap 5 JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toggleBtn = document.getElementById('sidebarToggle');
        if (toggleBtn) {
            toggleBtn.addEventListener('click', function () {
                document.getElementById('sidebar-wrapper').classList.toggle('toggled');
            });
        }
    });
</script>
@stack('scripts')
</body>
</html>
