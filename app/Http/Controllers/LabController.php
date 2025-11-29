<?php

namespace App\Http\Controllers;

use App\Models\Laboratory;
use Illuminate\Contracts\View\View;

class LabController extends Controller
{
    public function index(): View
    {
        $labs = Laboratory::withComputerStats()->get();

        return view('laboratories', compact('labs'));
    }
}
