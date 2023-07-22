<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permintaanbarang extends Model
{
    //use HasFactory;

    protected $table = 'request_barang';
    protected $guarded = [];

    protected static function booted()
    {
        static::creating(function ($model) {
            $lastRecord = static::latest()->first();
            $lastNumber = $lastRecord ? intval(substr($lastRecord->kode_req_barang, 3)) : 0;
            $model->kode_req_barang = 'REQ' . ($lastNumber + 1);
        });
    }
}
