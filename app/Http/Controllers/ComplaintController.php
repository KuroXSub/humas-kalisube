<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Complaint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComplaintController extends Controller
{
    public function index(Request $request)
    {
        // Ambil query pencarian, filter, dan pengurutan dari request
        $search = $request->input('search');
        $status = $request->input('status');
        $sort = $request->input('sort', 'latest'); // Default sorting: latest

        // Query dasar
        $complaints = Complaint::where('user_id', Auth::id())
            ->when($search, function ($query, $search) {
                return $query->where(function ($q) use ($search) {
                    $q->where('deskripsi', 'like', '%' . $search . '%')
                      ->orWhereHas('kategoriPengaduan', function ($q) use ($search) {
                          $q->where('nama_kategori', 'like', '%' . $search . '%');
                      });
                });
            })
            ->when($status, function ($query, $status) {
                return $query->where('status', $status);
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

        return view('complaints.index', compact('complaints'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('complaints.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori_pengaduan_id' => 'required|exists:categories,id',
            'deskripsi' => 'required',
        ]);

        Complaint::create([
            'user_id' => Auth::id(),
            'kategori_pengaduan_id' => $request->kategori_pengaduan_id,
            'deskripsi' => $request->deskripsi,
            'prioritas' => 'rendah', // Prioritas diisi otomatis
        ]);

        return redirect()->route('complaints.index')->with('success', 'Pengaduan berhasil dibuat.');
    }

    public function show(Complaint $complaint)
    {
        return view('complaints.show', compact('complaint'));
    }

    public function edit(Complaint $complaint)
    {
    // Cek apakah status complaint adalah "selesai"
    if ($complaint->status === 'selesai') {
        return redirect()->route('complaints.index')->with('error', 'Pengaduan yang sudah selesai tidak dapat diubah.');
    }

    $categories = Category::all();
    return view('complaints.edit', compact('complaint', 'categories'));
    }

    public function update(Request $request, Complaint $complaint)
    {
    // Cek apakah status complaint adalah "selesai"
    if ($complaint->status === 'selesai') {
        return redirect()->route('complaints.index')->with('error', 'Pengaduan yang sudah selesai tidak dapat diubah.');
    }

    $request->validate([
        'kategori_pengaduan_id' => 'required|exists:categories,id',
        'deskripsi' => 'required',
    ]);

    $complaint->update([
        'kategori_pengaduan_id' => $request->kategori_pengaduan_id,
        'deskripsi' => $request->deskripsi,
    ]);

    return redirect()->route('complaints.index')->with('success', 'Pengaduan berhasil diperbarui.');
    }

    public function destroy(Complaint $complaint)
    {
    // Cek apakah status complaint adalah "selesai"
    if ($complaint->status === 'selesai') {
        return redirect()->route('complaints.index')->with('error', 'Pengaduan yang sudah selesai tidak dapat dihapus.');
    }

    $complaint->delete();
    return redirect()->route('complaints.index')->with('success', 'Pengaduan berhasil dihapus.');
    }
}