<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penghuni extends Model
{
    protected $table = 'penghuni';
    protected $guarded = [];

    public function getUser(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}

