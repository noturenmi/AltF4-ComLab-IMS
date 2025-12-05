<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    private static $icons = [
        'Asterisk' => 'asterisk',
        'Ban' => 'ban',
        'Battery' => 'battery',
        'Bookmarks' => 'bookmarks',
        'Box' => 'box',
        'Camera' => 'camera',
        'CPU' => 'cpu',
        'Diagram' => 'diagram3',
        'File' => 'file-earmark',
        'Files' => 'files',
        'Floppy Disk' => 'floppy',
        'Folder' => 'folder',
        'HDD' => 'hdd',
        'HDD Rack' => 'hdd-rack',
        'Keyboard' => 'keyboard',
        'Lightning' => 'lightning-charge',
        'Magnifying Glass' => 'search',
        'Monitor' => 'display',
        'Mouse' => 'mouse',
        'Modem' => 'modem',
        'PC' => 'pc',
        'PC & Monitor' => 'pc-display',
        'Plug' => 'plug',
        'Printer' => 'printer',
        'Projector' => 'projector',
        'Router' => 'router',
        'SD Card' => 'sd-card',
        'Server' => 'server',
        'SIM Card' => 'sim',
        'Sliders' => 'sliders2',
        'Speaker' => 'speaker',
        'Television' => 'tv',
        'USB Drive' => 'usb-drive',
        'USB Plug' => 'usb-plug',
        'Wrench' => 'wrench',
    ];

    private static $colors = [
        'Blue' => '2B7FFF', // #2B7FFF
        'Cyan' => '1AC6FF', // #1AC6FF
        'Red' => 'F20024', // #F20024
        'Green' => '00C951', // #00C951
        'Purple' => 'AD46FF', // #AD46FF
        'Orange' => 'FF751A', // #FF751A
        'Yellow' => 'FFD123', // #FFD123
        'Teal' => '00D4AA', // #00D4AA
        'Pink' => 'FF4AAB', // #FF4AAB
        'Lime' => '7FFF2B', // #7FFF2B
    ];

    public function index(): View
    {
        $categories = Category::withTotalQuantity()->get();
        $icons = self::$icons;
        $colors = self::$colors;

        return view('categories', compact('categories', 'icons', 'colors'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate(
            [
                'cat_name' => ['required', 'min:3'],
                'cat_desc' => ['nullable', 'max:200'],
                'cat_icon' => ['nullable'],
                'cat_color' => ['nullable'],
            ], [
                'cat_name.required' => 'Category name is required!',
                'cat_name.min' => 'Category name must be at least 3 characters long!',

                'cat_desc.max' => 'Category description is limited to 200 characters!',
            ]);

        $category = Category::create([
            'name' => $validated['cat_name'],
            'description' => $validated['cat_desc'],
            'icon' => $validated['cat_icon'],
            'color' => $validated['cat_color'],
        ]);

        Transaction::logCreate(Auth::user(), $category);

        return redirect()->back()->with('success', $validated['cat_name'].' has been created!');
    }

    public function edit(Category $category): View
    {
        $items = $category->items()->get();
        $categories = Category::select('id', 'name')->get();
        $icons = self::$icons;
        $colors = self::$colors;

        return view('category', compact('category', 'items', 'categories', 'icons', 'colors'));
    }

    public function update(Request $request, Category $category): RedirectResponse
    {

        $validated = $request->validate(
            [
                'cat_name' => ['min:3'],
                'cat_desc' => ['max:200'],
                'cat_icon' => ['string'],
                'cat_color' => ['string', 'min:6'],
            ], [
                'cat_name.min' => 'Category name must be at least 3 characters long!',
                'cat_desc.max' => 'Category description is limited to 200 characters!',
            ]);

        $updated = $category->update([
            'name' => $validated['cat_name'] ?? $category->name,
            'description' => $validated['cat_desc'] ?? $category->description,
            'icon' => $validated['cat_icon'] ?? $category->icon,
            'color' => $validated['cat_color'] ?? $category->color,
        ]);

        if ($updated) {
            Transaction::logUpdate(Auth::user(), $category->fresh());
        }

        return redirect()->back()->with('success', $category->name.' has been updated!');
    }

    public function destroy(Category $category): RedirectResponse
    {
        $category->delete();

        Transaction::logDelete(Auth::user(), $category);

        return redirect()->back()->with('success', $category->name.' has been deleted!');
    }
}
