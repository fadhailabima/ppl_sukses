<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KHS extends Model
{
    protected $table = 'k_h_s';

    protected $fillable = [
        'userid',
        'semester',
        'skssemester',
        'skskumulatif',
        'ipsemester',
        'ipkumulatif',
        'scankhs',
        'isverified'
    ];

    public function User()
    {
        return $this->belongsTo(User::class);
    }
}