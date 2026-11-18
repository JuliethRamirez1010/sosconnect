<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = ['number', 'floor', 'beds'];

    protected function casts(): array
    {
        return ['beds' => 'array'];
    }
}
