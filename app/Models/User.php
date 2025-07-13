<?php

namespace App\Models;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\HasAvatar; // <-- PENTING: Import interface ini
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Storage; // Import Storage facade

class User extends Authenticatable implements HasAvatar // <-- PENTING: Implementasikan interface ini
{
    use HasFactory, Notifiable, HasRoles; // <-- Hapus HasAvatar dari sini, karena sudah diimplementasikan di atas

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        'avatar',
        'github',
        'instagram',
        'about',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the URL for the user's Filament avatar.
     * Ini adalah metode yang dipanggil oleh Filament.
     *
     * @return string|null
     */
    public function getFilamentAvatarUrl(): ?string
    {
        // Ini akan secara otomatis memanggil accessor getAvatarUrlAttribute()
        // jika Anda mengakses $this->avatar_url
        return $this->avatar_url;
    }

    /**
     * Accessor untuk mendapatkan URL avatar.
     * Ini akan dipanggil ketika Anda mengakses $user->avatar_url.
     *
     * @return string|null
     */
    public function getAvatarUrlAttribute(): ?string
    {
        // Jika kolom 'avatar' ada dan memiliki nilai
        if ($this->avatar) {
            // Gunakan Storage facade untuk mendapatkan URL publik dari file
            // Pastikan Anda sudah menjalankan 'php artisan storage:link'
            return Storage::url($this->avatar);
        }

        // Jika tidak ada avatar, kembalikan null atau URL placeholder default
        // Filament akan menampilkan inisial jika ini null
        return null;
    }
}
