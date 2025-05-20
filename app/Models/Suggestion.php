<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Illuminate\Support\Facades\Hash;

class Suggestion extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'user_hash',
        'judul',
        'deskripsi',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $appends = ['hashed_user'];

    protected static function booted()
    {
        static::creating(function ($suggestion) {
            $suggestion->user_hash = static::generateUserHash($suggestion->user_id);
        });

        static::updating(function ($suggestion) {
            if ($suggestion->isDirty('user_id')) {
                $suggestion->user_hash = static::generateUserHash($suggestion->user_id);
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
