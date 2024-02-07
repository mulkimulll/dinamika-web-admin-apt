<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Penghuni;
use App\Models\Kendaraan;

class Gedung extends Model
{
    protected $table = 'gedung';
    protected $guarded = [];

    public function getPenghuni() {
        return $this->hasMany(Penghuni::class, 'tower', 'id');
    }
}
