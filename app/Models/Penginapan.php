<?php

namespace App\Models;


use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use App\Traits\KeyUUID;

class Penginapan extends Authenticatable
{

    use HasApiTokens, KeyUUID;

    protected $primaryKey = 'uuid';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $table = 'penginapans';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid',
        'nama',
        'alamat',
        'tanggal_checkin',
        'tanggal_checkout',
        'harga_permalam'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'tanggal_checkin' => 'datetime',
        'tanggal_checkout' => 'datetime',
        'uuid' => 'string'
    ];
}
