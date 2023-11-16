<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IRS extends Model
{
    protected $table = 'irs';

    protected $fillable = [
        'mahasiswa_id',
        'semester',
        'jmlsks',
        'scansks',
        'isverified'
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(MHS::class, 'mahasiswa_id', 'nim');
    }
}