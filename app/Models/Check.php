<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Check extends Model
{
    use HasFactory;

    protected $fillable = [
        'page_id',
        'check_type_id',
        'cost'
    ];

    public function page() {
        return $this->belongsTo(Page::class);
    }

    public function log() {
        return $this->hasMany(Log::class);
    }

    public function type() {
        return $this->hasOne(CheckType::class);
    }

}
