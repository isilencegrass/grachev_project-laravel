<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posts extends Model {
    use HasFactory;
    protected $fillable = [
        'user_id', 'title', 'slug', 'content', 'media', 'is_published'
    ];

    protected $casts = [
        'liked_users' => 'array',
    ];

    public function user() {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    
}

