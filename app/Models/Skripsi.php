<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skripsi extends Model
{
    protected $fillable = [
        'userid',
        'semester',
        'tglsidang',
        'dosenpembimbing',
        'scansidang',
        'isverified'
    ];

    public function User()
    {
        return $this->belongsTo(User::class);
    }
}