<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Url extends Model
{
    protected $fillable = [
        'original_url',
        'short_url',
        'user_id',
        'clicks'
    ];

    public function user(){

        return $this->belongsTo(User::class);
    }
}
