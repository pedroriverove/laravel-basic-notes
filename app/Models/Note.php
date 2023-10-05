<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ramsey\Uuid\Uuid;

class Note extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    const STATUS_PENDING = 1;
    const STATUS_IN_PROGRESS = 2;
    const STATUS_FINISHED = 3;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'code',
        'description',
        'observations',
        'status',
        'user_id',
        'department_id',
        'client_id',
        'saved_at',
        'reactivated_at',
    ];

    /**
     * @var string[]
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * Generate a new UUID for the model.
     */
    public function newUniqueId(): string
    {
        return (string) Uuid::uuid4();
    }

    /**
     * Get the columns that should receive a unique identifier.
     *
     * @return array<int, string>
     */
    public function uniqueIds(): array
    {
        return ['code'];
    }

    /**
     * @return mixed
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * @return mixed
     */
    public function client()
    {
        return $this->belongsTo('App\Models\Client');
    }

    /**
     * @return mixed
     */
    public function department()
    {
        return $this->belongsTo('App\Models\Department');
    }
}
