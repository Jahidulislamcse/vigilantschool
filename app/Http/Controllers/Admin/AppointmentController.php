<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->query('status');
        $query = Appointment::with('schoolClass')->latest();

        if ($status && in_array($status, ['pending', 'contacted', 'approved', 'cancelled'])) {
            $query->where('status', $status);
        }

        $appointments = $query->paginate(15)->withQueryString();

        return view('admin.appointments.index', compact('appointments', 'status'));
    }

    public function show(Appointment $appointment)
    {
        $appointment->load('schoolClass');
        return view('admin.appointments.show', compact('appointment'));
    }

    public function updateStatus(Request $request, Appointment $appointment)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,contacted,approved,cancelled',
            'admin_notes' => 'nullable|string',
        ]);

        $appointment->update($validated);

        return back()->with('success', 'Appointment status updated successfully!');
    }

    public function destroy(Appointment $appointment)
    {
        $appointment->delete();

        return redirect()->route('admin.appointments.index')
            ->with('success', 'Appointment record deleted successfully!');
    }
}
