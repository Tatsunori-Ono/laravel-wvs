<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;

use Illuminate\Database\Eloquent\Casts\Attribute;

class User extends Authenticatable implements FilamentUser, MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'role',
        'warwick_id',
        'email',
        'password',
        'profile_photo_path',
        'google2fa_secret',
        'is_enable_google2fa',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'google2fa_secret',
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
            'is_enable_google2fa' => 'boolean',
        ];
    }

    protected function google2faSecret(): Attribute {
        return new Attribute(
            get: fn ($value) => decrypt($value),
            set: fn ($value) => encrypt($value),
        );
    }

    public function canAccessPanel(Panel $panel): bool
    {
        if ($panel->getId() === config('filament.id')) {
            return $this->role === 'admin';
        }

        return true;
    }

    public function favorites()
    {
        return $this->belongsToMany(EquipmentItem::class, 'favorites', 'user_id', 'equipment_item_id')->withTimestamps();
    }

}
