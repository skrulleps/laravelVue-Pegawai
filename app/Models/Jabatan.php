<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jabatan extends Model
{
    use HasFactory;

    protected $table = 'jabatan';
    protected $fillable = [
        'nama_jabatan', 'id_eselon'
    ];
    
    public function eselon()
    {
        return $this->belongsTo(Eselon::class, 'id_eselon');
    }

}
