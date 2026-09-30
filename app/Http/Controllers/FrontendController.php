<?php

namespace App\Http\Controllers;

use App\Models\AboutSection;
use App\Models\Appointment;
use App\Models\Contact;
use App\Models\Facility;
use App\Models\Newsletter;
use App\Models\SchoolClass;
use App\Models\Slider;
use App\Models\Teacher;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        $sliders = Slider::where('is_active', true)->orderBy('order', 'asc')->get();
        $facilities = Facility::where('is_active', true)->orderBy('order', 'asc')->get();
        $about = AboutSection::first();
        $classes = SchoolClass::with('teacher')->where('is_active', true)->orderBy('order', 'asc')->take(6)->get();
        $teachers = Teacher::where('is_active', true)->orderBy('order', 'asc')->take(3)->get();
        $testimonials = Testimonial::where('is_active', true)->orderBy('order', 'asc')->get();

        return view('frontend.index', compact(
            'sliders',
            'facilities',
            'about',
            'classes',
            'teachers',
            'testimonials'
        ));
    }

    public function about()
    {
        $about = AboutSection::first();
        $teachers = Teacher::where('is_active', true)->orderBy('order', 'asc')->take(3)->get();

        return view('frontend.about', compact('about', 'teachers'));
    }

    public function classes()
    {
        $classes = SchoolClass::with('teacher')->where('is_active', true)->orderBy('order', 'asc')->get();
        $testimonials = Testimonial::where('is_active', true)->orderBy('order', 'asc')->get();

        return view('frontend.classes', compact('classes', 'testimonials'));
    }

    public function facilities()
    {
        $facilities = Facility::where('is_active', true)->orderBy('order', 'asc')->get();
        $about = AboutSection::first();

        return view('frontend.facility', compact('facilities', 'about'));
    }

    public function teachers()
    {
        $teachers = Teacher::where('is_active', true)->orderBy('order', 'asc')->get();

        return view('frontend.team', compact('teachers'));
    }

    public function appointment()
    {
        $classes = SchoolClass::where('is_active', true)->orderBy('order', 'asc')->get();

        return view('frontend.appointment', compact('classes'));
    }

    public function submitAppointment(Request $request)
    {
        $validated = $request->validate([
            'guardian_name' => 'required|string|max:255',
            'guardian_email' => 'required|email|max:255',
            'guardian_phone' => 'nullable|string|max:50',
            'child_name' => 'required|string|max:255',
            'child_age' => 'required|string|max:50',
            'class_id' => 'nullable|exists:classes,id',
            'message' => 'nullable|string|max:1000',
        ]);

        Appointment::create($validated);

        return back()->with('success_appointment', 'Thank you! Your appointment request has been submitted successfully.');
    }

    public function testimonials()
    {
        $testimonials = Testimonial::where('is_active', true)->orderBy('order', 'asc')->get();

        return view('frontend.testimonial', compact('testimonials'));
    }

    public function contact()
    {
        return view('frontend.contact');
    }

    public function submitContact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string|max:2000',
        ]);

        Contact::create($validated);

        return back()->with('success_contact', 'Thank you for reaching out! Your message has been sent to school administration.');
    }

    public function submitNewsletter(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|max:255',
        ]);

        Newsletter::updateOrCreate(
            ['email' => $validated['email']],
            ['is_active' => true]
        );

        return back()->with('success_newsletter', 'Thank you for subscribing to our newsletter!');
    }
}
