<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;
    protected $fillable = [
        'block',
        'lot',
        'surface',
        'price',
        'location_id',
        'type_id',
        'state',
        'created_at',
        'updated_at'
    ];
}
