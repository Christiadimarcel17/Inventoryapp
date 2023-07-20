<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Databarang extends Model
{
    // use HasFactory;
    protected $table = 'barang';
    protected $guarded = [];

    protected static function booted()
    {
        static::creating(function ($model) {
            $lastRecord = static::latest()->first();
            $lastNumber = $lastRecord ? intval(substr($lastRecord->kode_barang, 1)) : 0;
            $model->kode_barang = 'B' . ($lastNumber + 1);
        });
    }
}
