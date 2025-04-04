<?php

namespace App\Models;

use App\Models\Scopes\AnonymousComplaintScope;
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
        'user_hash',
        'kategori_pengaduan_id',
        'deskripsi',
        'status',
        'prioritas',
        'tanggapan',
        'petugas_id',
    ];

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

    protected $appends = ['hashed_user'];

    // Otomatis generate hash saat membuat complaint
    protected static function booted()
    {
        static::creating(function ($complaint) {
            $complaint->user_hash = static::generateUserHash($complaint->user_id);
        });

        static::updating(function ($complaint) {
            if ($complaint->isDirty('user_id')) {
                $complaint->user_hash = Complaint::generateUserHash($complaint->user_id);
            }
        });
    }

    public static function generateUserHash($userId)
    {
        return substr(hash_hmac('sha256', $userId, config('app.key')), 0, 12);
    }

    public function getHashedUserAttribute()
    {
        return 'User-' . $this->user_hash;
    }
}
