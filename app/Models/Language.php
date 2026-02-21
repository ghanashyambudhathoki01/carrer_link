<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'name', 'proficiency',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
