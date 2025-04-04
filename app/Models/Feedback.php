<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Illuminate\Support\Facades\Hash;

class Feedback extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'complaint_id',
        'user_id',
        'user_hash',
        'komentar',
        'rating',
    ];

    // Relasi dengan pengaduan
    public function complaint()
    {
        return $this->belongsTo(Complaint::class);
    }

    // Relasi dengan user yang memberikan feedback
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable();
    }

    protected $appends = ['hashed_user'];

    protected static function booted()
    {
        static::creating(function ($feedback) {
            $feedback->user_hash = static::generateUserHash($feedback->user_id);
        });

        static::updating(function ($feedback) {
            if ($feedback->isDirty('user_id')) {
                $feedback->user_hash = static::generateUserHash($feedback->user_id);
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
