<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotel;

class HomeController extends Controller
{
    public function index()
    {
        return view('pages.index', [
            'hotels' => Hotel::all()
        ]);
    }
}
