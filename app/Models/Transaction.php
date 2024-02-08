<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Penghuni;

class Transaction extends Model
{
    protected $table = 'transaction';
    protected $guarded = [];

    public function getUser() {
        return $this->hasOne(Penghuni::class, 'user_id', 'user_id');
    }
}
