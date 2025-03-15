<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'city',
        'state',
        'country',
    ];

    public function occupations(): BelongsToMany
    {
        return $this->belongsToMany(Occupation::class);
    }
}
