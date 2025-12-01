<?php

namespace App\Http\Controllers;

use App\Models\Computer;
use App\Models\Laboratory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ComputerController extends Controller
{
    private static $compModelNamePattern = '/^(?:[A-Z0-9][^ ]*(?: [A-Z0-9][^ ]*)*)?$/';

    public function index(): View
    {
        $computers = Computer::getComputersWithLab();
        $laboratories = Laboratory::select('id', 'name')->get();

        return view('computers', compact('computers', 'laboratories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate(
            [
                'comp_name' => ['alpha_num'],
                'comp_model' => ['required', 'regex:'.self::$compModelNamePattern],
                'comp_lab' => ['nullable', 'exists:laboratories,id'],
            ],
            [
                'comp_name.alpha_num' => 'Computer name cannot contain spaces or special characters!',
                'comp_model.regex' => 'Computer model must start with either an uppercase letter or a number!',
                'comp_lab.exists' => 'Laboratory not found!',
            ]);

        Computer::create([
            'name' => $validated['comp_name'],
            'model' => $validated['comp_model'],
            'lab_id' => $validated['comp_lab'],
        ]);

        return redirect()->route('computers');
    }

    public function update(Request $request, Computer $computer): RedirectResponse
    {
        $validated = $request->validate(
            [
                'comp_name' => ['alpha_num'],
                'comp_model' => ['regex:'.self::$compModelNamePattern],
                'comp_lab' => ['nullable', 'exists:laboratories,id'],
                'comp_status' => ['in:Active,Inactive,Maintenance'],
            ],
            [
                'comp_name.alpha_num' => 'Computer name cannot contain spaces or special characters!',
                'comp_lab.exists' => 'Laboratory not found!',
                'comp_status' => 'Invalid status!',
            ]);

        $computer->update([
            'name' => $validated['comp_name'] ?? $computer->name,
            'model' => $validated['comp_model'] ?? $computer->model,
            'lab_id' => $validated['comp_lab'] ?? $computer->lab_id,
            'status' => $validated['comp_status'] ?? $computer->status,
        ]);

        return redirect()->back()->with('success', $computer->name.' has been updated!');
    }

    public function destroy(Computer $computer): RedirectResponse
    {
        $computer->delete();

        return redirect()->route('computers')->with('success', $computer->name.' has been deleted');
    }
}
