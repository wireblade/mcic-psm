<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $casts = [
        'dateStart' => 'date',
        'dateEnd' => 'date',
    ];

    protected $fillable = [
        'name',
        'description',
        'latitude',
        'longitude',
        'status',
        'dateStart',
        'dateEnd',
    ];
}
