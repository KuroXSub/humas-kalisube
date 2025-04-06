<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EncryptedFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'original_name',
        'encrypted_path',
        'file_type',
        'key_hash',
        'user_id',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->file) && empty($model->encrypted_path)) {
                throw new \Exception("Tidak ada file yang terlampir");
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
