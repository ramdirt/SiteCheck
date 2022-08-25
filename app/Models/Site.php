<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'url'
    ];

    public function pages() {
        return $this->hasMany(Page::class);
    }

    public function user() {
        return $this->belongsToMany(User::class, 'user_sites');
    }
}
