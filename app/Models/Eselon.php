<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Eselon extends Model
{
    use HasFactory;

    protected $table = 'eselon';
    protected $fillable = [
        'nama_eselon',
    ];


}
