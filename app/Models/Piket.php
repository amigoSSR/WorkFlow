<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Piket extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'day',
        'week_type',
        'zone',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
