<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skripsi extends Model
{
    protected $fillable = [
        'mahasiswa_id',
        'semester',
        'tglsidang',
        'dosenpembimbing',
        'scansidang',
        'isverified'
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(MHS::class, 'mahasiswa_id', 'nim');
    }
}