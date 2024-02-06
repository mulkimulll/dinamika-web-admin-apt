<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Penghuni;
use App\User;

class Kendaraan extends Model
{
    protected $table = 'kendaraan';
    protected $guarded = [];

    public function getUser(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function getPenghuni(){
        return $this->hasOne(Penghuni::class, 'user_id', 'user_id');
    }
}
