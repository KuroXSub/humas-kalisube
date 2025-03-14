<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Spatie\Activitylog\LogOptions;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->map(fn (string $name) => Str::of($name)->substr(0, 1))
            ->implode('');
    }

    // Relasi dengan pengaduan yang diajukan oleh user
    public function pengaduan()
    {
        return $this->hasMany(Complaint::class);
    }

    // Relasi dengan pengaduan yang ditangani oleh petugas
    public function pengaduanDitangani()
    {
        return $this->hasMany(Complaint::class, 'petugas_id');
    }

    // Relasi dengan feedback yang diberikan oleh user
    public function feedback()
    {
        return $this->hasMany(Feedback::class);
    }

    public function scopeExcludeAdminsAndPetugas(Builder $query)
    {
        return $query->whereNotIn('role', ['admin', 'petugas']);
    }

    public function scopeMasyarakat(Builder $query)
    {
        return $query->where('role', 'masyarakat');
    }

    public function scopePetugas(Builder $query)
    {
        return $query->where('role', 'petugas');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable();
    }
}
