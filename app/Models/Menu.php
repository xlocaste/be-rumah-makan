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
        'rumah_makan_id',
    ];

    public function RumahMakan()
    {
        return $this->belongsTo(RumahMakan::class);
    }
}
