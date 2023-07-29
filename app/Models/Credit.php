<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Credit extends Model
{
    use HasFactory;
    protected $fillable = [
        'amount',
        'bank',
        'interest',
        'client_type',
        'state',
        'client_id',
        'user_id'
    ];
}
