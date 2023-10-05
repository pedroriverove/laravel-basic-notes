<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'email_verified_at',
        'password',
        'is_super_admin',
        'role_id',
        'department_id',
        'remember_token',
    ];

    /**
     * @var string[]
     */
    protected $dates = [
        'last_activity',
        'created_at',
        'updated_at',
        'deleted_at',
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
        'password' => 'hashed',
    ];

    /**
     * Set the user's last activity date.
     *
     * @return void
     */
    public function setLastActivity(): void
    {
        Model::withoutTimestamps(function () {
            $this->last_activity = now();
            $this->save();
        });
    }

    /**
     * @return void
     */
    protected static function boot(): void
    {
        parent::boot();
    }

    /**
     * @return mixed
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * @return mixed
     */
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    /**
     * @return bool
     */
    public function isManager(): bool
    {
        return $this->role->name === 'manager';
    }

    /**
     * @return mixed
     */
    public function isSuperAdmin(): bool
    {
        return $this->is_super_admin;
    }

    /**
     * @return bool
     */
    public function isSupervisor(): bool
    {
        return $this->role->name === 'supervisor';
    }

    /**
     * @return bool
     */
    public function isEmployee(): bool
    {
        return $this->role->name === 'employee';
    }
}
