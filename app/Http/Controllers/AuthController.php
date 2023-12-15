<?php

namespace App\Http\Controllers;

use App\Models\Overview;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function dashboard() {
        $data = [
            'overview' => Overview::find(1),
        ];
        return view('dashboard', $data);
    }
}
