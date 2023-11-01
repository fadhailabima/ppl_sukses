<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IRS extends Model
{
    protected $table = 'irs';

    protected $fillable = [
        'userid',
        'semester',
        'jmlsks',
        'scansks',
        'isverified'
    ];

    public function User()
    {
        return $this->belongsTo(User::class);
    }
}