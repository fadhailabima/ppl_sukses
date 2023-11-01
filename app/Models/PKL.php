<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PKL extends Model
{
    use HasFactory;
    protected $fillable = [
        'semester',
        'userid',
        'instansi',
        'dosenpengampu',
        'scanpkl',
        'isverified'
    ];

    public function User()
    {
        return $this->belongsTo(User::class);
    }
}