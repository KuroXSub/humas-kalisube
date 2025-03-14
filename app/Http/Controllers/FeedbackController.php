<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'complaint_id' => 'required|exists:complaints,id',
            'komentar' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        // Cek apakah feedback sudah pernah dikirim untuk pengaduan ini
        $complaint = Complaint::findOrFail($request->complaint_id);
        if ($complaint->feedback) {
            return redirect()->route('complaints.show', $request->complaint_id)->with('error', 'Anda sudah memberikan feedback untuk pengaduan ini.');
        }

        // Simpan feedback baru
        Feedback::create([
            'complaint_id' => $request->complaint_id,
            'user_id' => Auth::id(),
            'komentar' => $request->komentar,
            'rating' => $request->rating,
        ]);

        return redirect()->route('complaints.show', $request->complaint_id)->with('success', 'Feedback berhasil dikirim.');
    }
}
