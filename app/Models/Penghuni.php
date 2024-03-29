<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Gedung;
use App\User;

class Penghuni extends Model
{
    protected $table = 'penghuni';
    protected $guarded = [];

    public function getUser(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    
    public function getGedung(){
        return $this->belongsTo(Gedung::class, 'tower', 'id');
    }
}

