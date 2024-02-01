<?php

namespace App\Http\Controllers\Parkir;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ParkirController extends Controller
{
    public function index() {
        return view('Parkir.index');
    }
}
