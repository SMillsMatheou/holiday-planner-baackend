<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'description',
        'from_date',
        'to_date',
        'user_id'
    ];
}
