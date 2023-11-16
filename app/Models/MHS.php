<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MHS extends Model
{
    use HasFactory;
    protected $table = 'mahasiswas';
    protected $primaryKey = 'nim';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'nim',
        'nama',
        'alamat',
        'kab_kota',
        'propinsi',
        'angkatan',
        'jalur_masuk',
        'email',
        'handphone',
        'status',
        'foto_mahasiswa',
        'dosen_wali',
        'user_id',
    ];

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function dosenWali()
    {
        return $this->belongsTo(DosenWali::class, 'dosen_wali', 'nip');
    }

    public function irs()
    {
        return $this->hasMany(IRS::class, 'mahasiswa_id', 'nim');
    }

    public function khs()
    {
        return $this->hasMany(KHS::class, 'mahasiswa_id', 'nim');
    }

    public function pkl()
    {
        return $this->hasOne(PKL::class, 'mahasiswa_id', 'nim');
    }

    public function skripsi()
    {
        return $this->hasOne(Skripsi::class, 'mahasiswa_id', 'nim');
    }
}
