<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barangmasuk extends Model
{
    //use HasFactory;
    protected $table = 'barang_masuk';
    protected $guarded =[];
    protected $casts = [
        'keterangan' => 'array',
    ];
}
