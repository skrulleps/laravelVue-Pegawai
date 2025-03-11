<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Pegawai extends Model
{
    use HasFactory;

    protected $table = 'pegawai';
    protected $primaryKey = 'id_pegawai';
    protected $fillable = [
        'nip', 'nama', 'tempat_lahir', 'tgl_lahir', 'id_kelamin',
        'alamat', 'id_agama', 'id_unit', 'tempat_tugas', 'no_hp', 'npwp', 'foto'
    ];

    public function kelamin()
{
    return $this->belongsTo(Kelamin::class, 'id_kelamin', 'id_jenKel');
}


    public function agama()
    {
        return $this->belongsTo(Agama::class, 'id_agama', 'id_agama');
    }

    public function unitKerja()
    {
        return $this->belongsTo(UnitKerja::class, 'id_unit', 'id_unitKerja');
    }
}
