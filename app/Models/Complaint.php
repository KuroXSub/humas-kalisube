<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;

class Complaint extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'kategori_pengaduan_id',
        'deskripsi',
        'status',
        'prioritas',
        'tanggapan',
        'petugas_id',
    ];

    // Relasi dengan user yang mengajukan pengaduan
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi dengan kategori pengaduan
    public function kategoriPengaduan()
    {
        return $this->belongsTo(Category::class);
    }

    // Relasi dengan petugas yang menangani pengaduan
    public function petugas()
    {
        return $this->belongsTo(User::class, 'petugas_id');
    }

    // Relasi dengan feedback
    public function feedback(): HasOne
    {
        return $this->hasOne(Feedback::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable();
    }

}
