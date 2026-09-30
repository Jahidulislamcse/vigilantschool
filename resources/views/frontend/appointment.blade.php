@extends('layouts.frontend')

@section('title', 'Make An Appointment - ' . ($settings['site_title'] ?? 'Kider'))

@section('content')
    @include('frontend.partials.page-header', ['pageTitle' => 'Admissions Appointment', 'breadcrumb' => 'Appointment'])

    <!-- Appointment Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="bg-light rounded">
                <div class="row g-0">
                    <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                        <div class="h-100 d-flex flex-column justify-content-center p-4 p-md-5">
                            <h1 class="mb-4">Book A School Tour / Appointment</h1>
                            <p class="mb-4 text-muted">Complete the quick form below and our admissions team will contact you within 24 hours to schedule your campus walkthrough.</p>
                            
                            @if(session('success_appointment'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <i class="fa fa-check-circle me-2"></i>{{ session('success_appointment') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            @if($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <ul class="mb-0 ps-3">
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            <form action="{{ route('appointment.submit') }}" method="POST">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-sm-6">
                                        <div class="form-floating">
                                            <input type="text" name="guardian_name" class="form-control border-0" id="gname" placeholder="Guardian Name" value="{{ old('guardian_name') }}" required>
                                            <label for="gname">Guardian Name *</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-floating">
                                            <input type="email" name="guardian_email" class="form-control border-0" id="gmail" placeholder="Guardian Email" value="{{ old('guardian_email') }}" required>
                                            <label for="gmail">Guardian Email *</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-floating">
                                            <input type="text" name="guardian_phone" class="form-control border-0" id="gphone" placeholder="Phone Number" value="{{ old('guardian_phone') }}">
                                            <label for="gphone">Phone Number</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-floating">
                                            <input type="text" name="child_name" class="form-control border-0" id="cname" placeholder="Child Name" value="{{ old('child_name') }}" required>
                                            <label for="cname">Child Name *</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-floating">
                                            <input type="text" name="child_age" class="form-control border-0" id="cage" placeholder="Child Age" value="{{ old('child_age') }}" required>
                                            <label for="cage">Child Age *</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-floating">
                                            <select name="class_id" class="form-select border-0" id="class_select">
                                                <option value="">Select Interested Class</option>
                                                @foreach($classes as $c)
                                                    <option value="{{ $c->id }}" {{ old('class_id') == $c->id ? 'selected' : '' }}>{{ $c->title }} ({{ $c->age_range }})</option>
                                                @endforeach
                                            </select>
                                            <label for="class_select">Program / Class</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <textarea name="message" class="form-control border-0" placeholder="Leave a message here" id="message" style="height: 100px">{{ old('message') }}</textarea>
                                            <label for="message">Message / Notes</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button class="btn btn-primary w-100 py-3" type="submit">Submit Appointment Request</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s" style="min-height: 400px;">
                        <div class="position-relative h-100">
                            <img class="position-absolute w-100 h-100 rounded" src="{{ asset('kider/img/appointment.jpg') }}" style="object-fit: cover;" alt="Appointment">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Appointment End -->
@endsection
