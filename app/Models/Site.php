<?php

namespace App\Models;

use Database\Factories\SiteFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Site extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'url',
        'status',
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    protected static function newFactory()
    {
        return SiteFactory::new();
    }

    public function user()
    {
        return $this->belongsToMany(User::class, 'user_sites');
    }
}