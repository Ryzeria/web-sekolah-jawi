<?php

namespace App\Models;

use App\Models\Enums\UserRole;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Auth\Passwords\CanResetPassword as CanResetPasswordTrait;

/**
 * App\Models\User
 *
 * @property string $id
 * @property string $id_sekolah
 * @property string $nama_sekolah
 * @property string $email_sekolah
 * @property string $alamat
 * @property string $nomor_telepon
 * @property ?string $link_sekolah
 * @property UserRole $role
 * @property \Illuminate\Support\Carbon $created_at
 */
class User extends Authenticatable implements CanResetPassword
{
    use HasFactory, HasUuids, Notifiable, CanResetPasswordTrait;

    /**
     * The name of the "updated at" column.
     * Set to null since the 'users' table doesn't have an 'updated_at' column.
     *
     * @var string|null
     */
    const UPDATED_AT = null;
    public $incrementing = false;
    protected $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_sekolah',
        'nama_sekolah',
        'email_sekolah',
        'alamat',
        'nomor_telepon',
        'link_sekolah',
        'password',
        'remember_token',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',      // Automatically hashes passwords on set.
            'role' => UserRole::class,   // Casts the 'role' column to our UserRole Enum.
        ];
    }
    /**
     * Get the e-mail address where password reset links are sent.
     *
     * @return string
     */
    public function getEmailForPasswordReset()
    {
        return $this->email_sekolah;
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        // If you need a custom notification, you can create one and use it here.
        // For now, we rely on Laravel's default. The key part is that the Notifiable
        // trait will use getEmailForPasswordReset() to get the correct email address.
        $this->notify(new \Illuminate\Auth\Notifications\ResetPassword($token));
    }
}
