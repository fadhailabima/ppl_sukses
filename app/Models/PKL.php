<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PKL extends Model
{
    use HasFactory;
    protected $fillable = [
        'semester',
        'mahasiswa_id',
        'instansi',
        'nilai_pkl',
        'dosenpengampu',
        'scanpkl',
        'isverified'
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(MHS::class, 'mahasiswa_id', 'nim');
    }
}