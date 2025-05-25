<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model {
    protected $fillable = [
        'user_id', 'title', 'slug', 'content', 'media', 'is_published'
    ];

    public function user() {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    
}

