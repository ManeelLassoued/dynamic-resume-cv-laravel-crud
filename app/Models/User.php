<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
<<<<<<< HEAD
=======
use Illuminate\Database\Eloquent\Relations\HasMany;
>>>>>>> test2025

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
<<<<<<< HEAD
=======
        'role',
>>>>>>> test2025
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
<<<<<<< HEAD
=======
    protected $guarded = ['id'];


    public function contactInformation(): HasMany
    {
        return $this->hasMany(ContactInformation::class);
    }

    public function education(): HasMany
    {
        return $this->hasMany(Education::class);
    }

    public function experiences(): HasMany
    {
        return $this->hasMany(Experience::class);
    }

    public function interests(): HasMany
    {
        return $this->hasMany(Interests::class);
    }

    public function projects(): HasMany
    {
        return $this->hasMany(Projects::class);
    }

    public function languages(): HasMany
    {
        return $this->hasMany(Languages::class);
    }

    public function skills(): HasMany
    {
        return $this->hasMany(Skills::class);
    }

    public function hasRole($role)
    {
        // Assuming you have a 'role' column in your users table
        return $this->role === $role;
    }
>>>>>>> test2025
}
