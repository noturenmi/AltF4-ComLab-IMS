<?php

namespace App\Http\Controllers;

use App\Models\Computer;
use App\Models\Laboratory;
use Illuminate\Http\Request;

class ComputerController extends Controller
{
    private static $compModelNamePattern = '/^(?:[A-Z0-9][^ ]*(?: [A-Z0-9][^ ]*)*)?$/';

    public function index()
    {
        $computers = Computer::getComputersWithLab();
        $laboratories = Laboratory::select('id', 'name')->get();

        return view('computers', compact('computers', 'laboratories'));
    }

    public function newComp(Request $request)
    {
        $validated = $request->validate(
            [
                'comp_name' => ['alpha_num'],
                'comp_model' => ['regex:'.self::$compModelNamePattern],
                'comp_lab' => ['nullable', 'exists:laboratories,id'],
            ],
            [
                'comp_name.alpha_num' => 'Computer name cannot contain spaces or special characters!',
                'comp_lab.exists' => 'Laboratory not found!',
            ]);

        Computer::create([
            'name' => $validated['comp_name'],
            'model' => $validated['comp_model'],
            'lab_id' => $validated['comp_lab'],
        ]);

        return redirect()->route('computers');
    }

    public function patchComp(int $id, Request $request)
    {
        $computer = Computer::find($id);

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

        $updateData = [
            'name' => $validated['comp_name'] ?? $computer->name,
            'model' => $validated['comp_model'] ?? $computer->model,
            'lab_id' => $validated['comp_lab'] ?? $computer->lab_id,
            'status' => $validated['comp_status'] ?? $computer->status,
        ];

        $computer->update($updateData);

        return redirect()->back()->with('success', 'Computer details have been updated!');
    }

    public function deleteComp(int $id)
    {
        $computer = Computer::find($id);
        $computer->delete();

        return redirect()->route('computers');
    }
}
