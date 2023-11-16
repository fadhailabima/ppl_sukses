<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KHS extends Model
{
    protected $table = 'k_h_s';

    protected $fillable = [
        'mahasiswa_id',
        'semester',
        'skssemester',
        'skskumulatif',
        'ipsemester',
        'ipkumulatif',
        'scankhs',
        'isverified'
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(MHS::class, 'mahasiswa_id', 'nim');
    }
}