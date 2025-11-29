<?php

namespace App\Http\Controllers;

use App\Models\Computer;
use App\Models\Item;
use App\Models\Laboratory;
use App\Models\Transaction;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        $itemCount = Item::count();
        $compCount = Computer::count();
        $labCount = Laboratory::count();
        $lowStockCount = Item::getLowStock()->count();
        $transTodayCount = Transaction::getTransactionsToday()->count();

        return view('dashboard', compact('itemCount', 'compCount', 'labCount', 'lowStockCount', 'transTodayCount'));
    }
}
