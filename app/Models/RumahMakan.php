<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RumahMakan extends Model
{
    use HasFactory;

    protected $table = "rumah_makan";

    protected $fillable = [
        'nama',
        'alamat',
        'jam_buka',
        'jam_tutup',
        'status',
    ];
}
