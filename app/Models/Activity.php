<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function participants(): HasMany {
        return $this->hasMany(ActivityParticipant::class);
    }
}
