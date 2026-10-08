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

    public function export(Request $request)
    {
        $status = $request->query('status');
        $query = Appointment::with('schoolClass')->latest();

        if ($status && in_array($status, ['pending', 'contacted', 'approved', 'cancelled'])) {
            $query->where('status', $status);
        }

        $appointments = $query->get();

        $filename = 'admissions_bookings_' . date('Y-m-d_His') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        ];

        $callback = function () use ($appointments) {
            $file = fopen('php://output', 'w');
            // Add UTF-8 BOM for Excel compatibility
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));

            fputcsv($file, [
                'ID',
                'Guardian Name',
                'Guardian Email',
                'Guardian Phone',
                'Child Name',
                'Child Age',
                'Interested Program',
                'Status',
                'Guardian Notes',
                'Admin Follow-up Notes',
                'Submission Date'
            ]);

            foreach ($appointments as $item) {
                fputcsv($file, [
                    $item->id,
                    $item->guardian_name,
                    $item->guardian_email,
                    $item->guardian_phone,
                    $item->child_name,
                    $item->child_age,
                    $item->schoolClass ? $item->schoolClass->title : 'General Inquiry',
                    strtoupper($item->status),
                    $item->message,
                    $item->admin_notes,
                    $item->created_at->format('Y-m-d H:i:s'),
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
