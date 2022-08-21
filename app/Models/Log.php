<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;

    protected $fillable = [
        'log_time',
        'check_id',
        'status',
        'speed'
    ];

    public function check() {
        return $this->belongsTo(Check::class);
    }
}
