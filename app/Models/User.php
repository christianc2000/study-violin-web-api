<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'lastname',
        'gender',
        'birth_date',
        'address',
        'image',
        'email',
        'password'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
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
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];
    public function getAgeAttribute()
    {
        if (!$this->birth_date) {
            return null; // Retornar null si no hay fecha de nacimiento
        }

        // Crear un objeto Carbon para la fecha de nacimiento y la fecha actual
        $birthDate = Carbon::parse($this->birth_date);
        $now = Carbon::now();

        // Calcular la diferencia en años
        return $now->diffInYears($birthDate);
    }
    public function profesor()
    {
        return $this->hasOne(Profesor::class, 'id');
    }
    public function estudiante()
    {
        return $this->hasOne(Estudiante::class, 'id');
    }
    public function tutor()
    {
        return $this->hasOne(Tutor::class, 'id');
    }
}
