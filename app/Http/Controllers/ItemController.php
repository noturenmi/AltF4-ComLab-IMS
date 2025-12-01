<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    private static $itemNamePattern = '/^(?:[A-Z0-9][^ ]*(?: [A-Z0-9][^ ]*)*)?$/';

    public function index(): View
    {
        $items = Item::with('category:id,name')->get();
        $categories = Category::select('id', 'name')->get();

        return view('items', compact('items', 'categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate(
            [
                'item_name' => ['required', 'min:3', 'regex:'.self::$itemNamePattern],
                'item_quantity' => ['required', 'numeric'],
                'item_cat' => ['required', 'exists:categories,id'],
            ],
            [
                'item_name.required' => 'Item name is required!',
                'item_name.min' => 'Item name must be at least 3 characters long!',
                'item_name.regex' => 'Item name must start with either an uppercase letter or a number!',

                'item_quantity.required' => 'Quantity is required!',
                'item_quantity.numeric' => 'Quantity must be numerical!',

                'item_cat.required' => 'Category is required!',
                'item_cat.exists' => 'Category not found!',
            ]
        );

        Item::create([
            'name' => $validated['item_name'],
            'quantity' => $validated['item_quantity'],
            'category_id' => $validated['item_cat'],
        ]);

        return redirect()->back()->with('success', $validated['item_name'].' has been created!');
    }

    public function update(Item $item, Request $request): RedirectResponse
    {
        $validated = $request->validate(
            [
                'item_name' => ['min:3', 'regex:'.self::$itemNamePattern],
                'item_quantity' => ['numeric'],
                'item_cat' => ['exists:categories,id'],
            ],
            [
                'item_name.min' => 'Item name must be at least 3 characters long!',
                'item_name.regex' => 'Item name must start with either an uppercase letter or a number!',

                'item_quantity.numeric' => 'Quantity must be numerical!',

                'item_cat.exists' => 'Category not found!',
            ]
        );

        $item->update([
            'name' => $validated['item_name'] ?? $item->name,
            'quantity' => $validated['item_quantity'] ?? $item->quantity,
            'category_id' => $validated['item_cat'] ?? $item->category_id,
        ]);

        return redirect()->back()->with('success', $item->name.' has been updated!');
    }

    public function destroy(Item $item): RedirectResponse
    {
        $item->delete();

        return redirect()->back()->with('success', $item->name.' has been deleted');
    }
}
