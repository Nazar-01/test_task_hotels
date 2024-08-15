<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agency;

class AgencyController extends Controller
{
    public function showAll()
    {
        return view('pages.agency.agencies', [
            'agencies' => Agency::all()
        ]);
    }

    public function getRules($id)
    {
        $agency = Agency::find($id);
        $rules = $agency->rules;

        return view('pages.agency.agency', [
            'agencyName' => $agency->name,
            'rules' => $rules
        ]);
    }
}
