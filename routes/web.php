<?php

use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AppointmentController as AdminAppointmentController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FacilityController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\NewsletterController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SchoolClassController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\FrontendController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Storage Asset Fallback (Ensures cPanel Image Serving Works 100%)
|--------------------------------------------------------------------------
*/
Route::get('storage/{path}', function (string $path) {
    $filePath = storage_path('app/public/' . $path);
    if (!file_exists($filePath)) {
        abort(404);
    }
    return response()->file($filePath, [
        'Cache-Control' => 'public, max-age=31536000',
    ]);
})->where('path', '.*')->name('storage.file');

/*
|--------------------------------------------------------------------------
| Public Visitor Routes (Kider Theme)
|--------------------------------------------------------------------------
*/
Route::get('/', [FrontendController::class, 'index'])->name('home');
Route::get('/about', [FrontendController::class, 'about'])->name('about');
Route::get('/classes', [FrontendController::class, 'classes'])->name('classes');
Route::get('/facilities', [FrontendController::class, 'facilities'])->name('facilities');
Route::get('/team', [FrontendController::class, 'teachers'])->name('team');
Route::get('/appointment', [FrontendController::class, 'appointment'])->name('appointment');
Route::post('/appointment', [FrontendController::class, 'submitAppointment'])->name('appointment.submit');
Route::get('/testimonials', [FrontendController::class, 'testimonials'])->name('testimonials');
Route::get('/contact', [FrontendController::class, 'contact'])->name('contact');
Route::post('/contact', [FrontendController::class, 'submitContact'])->name('contact.submit');
Route::post('/newsletter', [FrontendController::class, 'submitNewsletter'])->name('newsletter.submit');
Route::get('/sitemap.xml', [FrontendController::class, 'sitemap'])->name('sitemap');
Route::get('/robots.txt', [FrontendController::class, 'robots'])->name('robots');

/*
|--------------------------------------------------------------------------
| Admin Authentication & Fallback Login Routes
|--------------------------------------------------------------------------
*/
Route::get('/login', fn () => redirect()->route('admin.login'))->name('login');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('login.submit');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
});

/*
|--------------------------------------------------------------------------
| Admin Panel Protected Routes
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index']);
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Site Settings
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');

    // Hero Carousel Sliders
    Route::resource('sliders', SliderController::class)->except(['show']);

    // School Facilities
    Route::resource('facilities', FacilityController::class)->except(['show']);

    // About Us & CTA Banner
    Route::get('/about', [AboutController::class, 'index'])->name('about.index');
    Route::post('/about', [AboutController::class, 'update'])->name('about.update');

    // Teachers & Faculty
    Route::resource('teachers', TeacherController::class)->except(['show']);

    // Classes & Programs
    Route::resource('classes', SchoolClassController::class)->except(['show']);

    // Appointments / Admissions
    Route::get('/appointments/export', [AdminAppointmentController::class, 'export'])->name('appointments.export');
    Route::resource('appointments', AdminAppointmentController::class)->only(['index', 'show', 'destroy']);
    Route::put('/appointments/{appointment}/status', [AdminAppointmentController::class, 'updateStatus'])->name('appointments.status');

    // Testimonials
    Route::resource('testimonials', TestimonialController::class)->except(['show']);

    // Contact Inquiries
    Route::resource('contacts', AdminContactController::class)->only(['index', 'show', 'destroy']);
    Route::post('/contacts/{contact}/reply', [AdminContactController::class, 'reply'])->name('contacts.reply');

    // Photo Gallery
    Route::resource('galleries', GalleryController::class)->only(['index', 'store', 'destroy']);

    // Newsletter Subscribers
    Route::get('/newsletters/export', [NewsletterController::class, 'export'])->name('newsletters.export');
    Route::resource('newsletters', NewsletterController::class)->only(['index', 'destroy']);

    // Admin Profile & Password Settings
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});
