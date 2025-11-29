<?php

namespace App\Http\Controllers;

use App\Models\Computer;

class ComputerController extends Controller
{
    public function index()
    {
        $computers = Computer::getComputersWithLab();

        return view('computers', compact('computers'));
    }
}
