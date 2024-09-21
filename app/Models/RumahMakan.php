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

    public function getStatusAttribute()
    {
        $currentTime = Carbon::now()->format('H:i');
        $jamBuka = $this->jam_buka->format('H:i');
        $jamTutup = $this->jam_tutup->format('H:i');

        if ($currentTime >= $jamBuka && $currentTime <= $jamTutup) {
            return 'Buka';
        } elseif ($currentTime < $jamBuka) {
            return 'Tutup Sementara';
        } else {
            return 'Tutup';
        }
    }
}
