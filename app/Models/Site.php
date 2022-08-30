<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'url',
        'last_check',
        'status',
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function pages()
    {
        return $this->hasMany(Page::class);
    }

    public function user()
    {
        return $this->belongsToMany(User::class, 'user_sites');
    }
}
