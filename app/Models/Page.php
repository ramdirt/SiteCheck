<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'site_id',
        'name',
        'path'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function checks()
    {
        return $this->hasMany(Check::class);
    }
}
