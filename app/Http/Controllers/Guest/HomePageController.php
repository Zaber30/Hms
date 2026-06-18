<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Doctor;

class HomePageController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View
    {
        $topSpecialists = Doctor::with('user')
            ->orderBy('experience_years', 'desc')
            ->limit(6)
            ->get();

        return view('home', compact('topSpecialists'));
    }
}
