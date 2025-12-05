<?php

namespace App\Http\Controllers;

use App\Models\Computer;
use App\Models\Laboratory;
use App\Models\Transaction;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComputerController extends Controller
{
    private static $compModelNamePattern = '/^(?:[A-Z0-9-][^ ]*(?: [A-Z0-9-][^ ]*)*)?$/';

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
                'comp_name' => ['alpha_dash'],
                'comp_model' => ['required', 'regex:'.self::$compModelNamePattern],
                'comp_lab' => ['nullable', 'exists:laboratories,id'],
            ],
            [
                'comp_name.alpha_dash' => 'Computer name can only contain letters, numbers, underscores and hyphens!',
                'comp_model.regex' => 'Computer model must start with either an uppercase letter or a number!',
                'comp_lab.exists' => 'Laboratory not found!',
            ]);

        $computer = Computer::with('laboratory')->create([
            'name' => $validated['comp_name'],
            'model' => $validated['comp_model'],
            'lab_id' => $validated['comp_lab'],
        ]);

        if (! empty($computer->laboratory)) {
            Transaction::logCreate(Auth::user(), $computer->laboratory, $computer);
        } else {
            Transaction::logCreate(Auth::user(), $computer);
        }

        return redirect()->back()->with('success', $computer->name.' has been created!');
    }

    public function update(Request $request, Computer $computer): RedirectResponse
    {
        $validated = $request->validate(
            [
                'comp_name' => ['alpha_dash'],
                'comp_model' => ['regex:'.self::$compModelNamePattern],
                'comp_lab' => ['nullable', 'exists:laboratories,id'],
                'comp_status' => ['in:Active,Inactive,Maintenance'],
            ],
            [
                'comp_name.alpha_dash' => 'Computer name can only contain letters, numbers, underscores and hyphens!',
                'comp_lab.exists' => 'Laboratory not found!',
                'comp_status' => 'Invalid status!',
            ]);

        $updated = $computer->update([
            'name' => $validated['comp_name'] ?? $computer->name,
            'model' => $validated['comp_model'] ?? $computer->model,
            'lab_id' => $validated['comp_lab'] ?? null,
            'status' => $validated['comp_status'] ?? $computer->status,
        ]);

        $updatedComp = $computer->fresh()->load('laboratory');

        if ($updated && $computer->wasChanged('lab_id')) {
            Transaction::logUpdate(Auth::user(), $updatedComp->laboratory, $updatedComp);
        } else {
            Transaction::logUpdate(Auth::user(), $updatedComp);
        }

        return redirect()->back()->with('success', $computer->name.' has been updated!');
    }

    public function destroy(Computer $computer): RedirectResponse
    {
        $computer->delete();

        Transaction::logDelete(Auth::user(), $computer);

        return redirect()->back()->with('success', $computer->name.' has been deleted');
    }
}
