<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Contact;
use App\Models\Facility;
use App\Models\Gallery;
use App\Models\Newsletter;
use App\Models\SchoolClass;
use App\Models\Slider;
use App\Models\Teacher;
use App\Models\Testimonial;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_classes' => SchoolClass::count(),
            'total_teachers' => Teacher::count(),
            'total_facilities' => Facility::count(),
            'total_testimonials' => Testimonial::count(),
            'total_sliders' => Slider::count(),
            'total_gallery' => Gallery::count(),
            'pending_appointments' => Appointment::where('status', 'pending')->count(),
            'total_appointments' => Appointment::count(),
            'unread_contacts' => Contact::where('is_read', false)->count(),
            'total_contacts' => Contact::count(),
            'total_subscribers' => Newsletter::count(),
        ];

        $recentAppointments = Appointment::with('schoolClass')->latest()->take(6)->get();
        $recentContacts = Contact::latest()->take(6)->get();

        return view('admin.dashboard', compact('stats', 'recentAppointments', 'recentContacts'));
    }
}
