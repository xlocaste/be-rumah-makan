<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $table = "menu";

    protected $fillable = [
        'nama',
        'kategori',
        'stok',
        'rumah_makan_id',
    ];

    public function rumah_makan()
    {
        return $this->belongsTo(RumahMakan::class);
    }
}
