<?php

namespace App\Http\Controllers;

use App\Models\Suggestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuggestionController extends Controller
{
    /**
     * Menampilkan daftar saran yang dibuat oleh pengguna yang sedang login.
     */
    public function index(Request $request)
    {
        // Ambil query pencarian, filter, dan pengurutan dari request
        $search = $request->input('search');
        $sort = $request->input('sort', 'latest'); // Default sorting: latest

        // Query dasar
        $suggestions = Suggestion::where('user_id', Auth::id())
            ->when($search, function ($query, $search) {
                return $query->where(function ($q) use ($search) {
                    $q->where('judul', 'like', '%' . $search . '%')
                      ->orWhere('deskripsi', 'like', '%' . $search . '%');
                });
            })
            ->when($sort, function ($query, $sort) {
                if ($sort === 'asc') {
                    return $query->orderBy('created_at', 'asc');
                } elseif ($sort === 'desc') {
                    return $query->orderBy('created_at', 'desc');
                } else {
                    return $query->latest();
                }
            })
            ->paginate(10) // Paginasi dengan 10 item per halaman
            ->withQueryString();

        return view('suggestions.index', compact('suggestions'));
    }

    /**
     * Menampilkan form untuk membuat saran baru.
     */
    public function create()
    {
        return view('suggestions.create');
    }

    /**
     * Menyimpan saran baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
        ]);

        Suggestion::create([
            'user_id' => Auth::id(),
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('suggestions.index')->with('success', 'Saran berhasil dibuat.');
    }

    /**
     * Menampilkan detail saran.
     */
    public function show(Suggestion $suggestion)
    {
        // Pastikan saran hanya bisa dilihat oleh pemiliknya
        if ($suggestion->user_id !== Auth::id()) {
            return redirect()->route('suggestions.index')->with('error', 'Anda tidak memiliki akses ke saran ini.');
        }

        return view('suggestions.show', compact('suggestion'));
    }

    /**
     * Menampilkan form untuk mengedit saran.
     */
    public function edit(Suggestion $suggestion)
    {
        // Pastikan saran hanya bisa diedit oleh pemiliknya
        if ($suggestion->user_id !== Auth::id()) {
            return redirect()->route('suggestions.index')->with('error', 'Anda tidak memiliki akses untuk mengedit saran ini.');
        }

        return view('suggestions.edit', compact('suggestion'));
    }

    /**
     * Memperbarui saran di database.
     */
    public function update(Request $request, Suggestion $suggestion)
    {
        // Pastikan saran hanya bisa diperbarui oleh pemiliknya
        if ($suggestion->user_id !== Auth::id()) {
            return redirect()->route('suggestions.index')->with('error', 'Anda tidak memiliki akses untuk memperbarui saran ini.');
        }

        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
        ]);

        $suggestion->update([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('suggestions.index')->with('success', 'Saran berhasil diperbarui.');
    }

    /**
     * Menghapus saran dari database.
     */
    public function destroy(Suggestion $suggestion)
    {
        $suggestion->delete();
        return redirect()->route('suggestions.index')->with('success', 'Saran berhasil dihapus.');
    }
}