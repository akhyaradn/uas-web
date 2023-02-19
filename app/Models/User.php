<?php

namespace App\Models;


use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use App\Traits\KeyUUID;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class User extends Authenticatable
{

    use HasApiTokens, KeyUUID;

    protected $primaryKey = 'uuid';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid',
        'name',
        'username',
        'password',
        'address',
        'phone_number',
        'is_admin',
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'uuid' => 'string'
    ];

    public const INACTIVE = 0;
    public const ACTIVE = 1;
    public const ADMIN = 0;
    public const USER = 1;

    public const AUTH_TOKEN = 'auth_token';
}
