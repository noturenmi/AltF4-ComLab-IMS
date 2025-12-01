<?php

namespace App\Http\Controllers;

use App\Models\Laboratory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LabController extends Controller
{
    private static $labNamePattern = '/^(?:[A-Z0-9][^ ]*(?: [A-Z0-9][^ ]*)*)?$/';

    public function index(): View
    {
        $laboratories = Laboratory::withComputerStats()->get();

        return view('laboratories', compact('laboratories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate(
            [
                'lab_name' => ['required', 'min:3', 'regex:'.self::$labNamePattern],
            ], [
                'lab_name.required' => 'Please enter a name for the new laboratory!',
                'lab_name.min' => 'Lab Name must be at least 3 characters long!',
                'lab_name.regex' => 'Lab Names must start with an uppercase letter or a digit!',
            ]);

        Laboratory::create(['name' => $validated['lab_name']]);

        return redirect()->route('laboratories');
    }

    public function edit(Laboratory $laboratory): View
    {
        $labComputers = $laboratory->computers()->get();
        $laboratories = Laboratory::select('id', 'name')->get();

        return view('laboratory', compact('laboratory', 'labComputers', 'laboratories'));
    }

    public function update(Request $request, Laboratory $laboratory): RedirectResponse
    {
        $validated = $request->validate(
            [
                'lab_name' => ['sometimes', 'min:3', 'regex:'.self::$labNamePattern],
                'lab_status' => ['sometimes', 'in:Available,Occupied,Maintenance'],
            ], [
                'lab_name.min' => 'Lab Name must be at least 3 characters long!',
                'lab_name.regex' => 'Lab Names must start with an uppercase letter or a digit!',

                'lab_status.in' => 'Invalid Laboratory Status!',
            ]);

        $updateData = [
            'name' => $validated['lab_name'] ?? $laboratory->name,
            'status' => $validated['lab_status'] ?? $laboratory->status,
        ];

        $laboratory->update($updateData);

        return redirect()->back()->with('success', $laboratory->name.' has been updated!');
    }

    public function destroy(Laboratory $laboratory): RedirectResponse
    {
        $laboratory->delete();

        return redirect()->route('laboratories')->with('success', $laboratory->name.' has been deleted!');
    }
}
