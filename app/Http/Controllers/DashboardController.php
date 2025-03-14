<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use App\Models\Feedback;
use App\Models\Suggestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Jumlah complaints yang dibuat oleh user
        $totalComplaints = Complaint::where('user_id', $user->id)->count();

        // Jumlah feedback yang telah diberikan oleh user
        $totalFeedbackGiven = Feedback::where('user_id', $user->id)->count();

        // Jumlah complaints yang berstatus 'selesai' dan belum memiliki feedback
        $complaintsWithoutFeedback = Complaint::where('user_id', $user->id)
            ->where('status', 'selesai') // Hanya hitung complaint yang selesai
            ->whereDoesntHave('feedback')
            ->count();

        // Jumlah saran yang telah diberikan oleh user
        $totalSuggestions = Suggestion::where('user_id', $user->id)->count();

        return view('dashboard', compact(
            'totalComplaints',
            'totalFeedbackGiven',
            'complaintsWithoutFeedback',
            'totalSuggestions'
        ));
    }
}