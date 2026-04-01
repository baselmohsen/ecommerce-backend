<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class DashboardController extends Controller
{
    public function index(){

        Gate::authorize('dashboard.view');

            $usersCount = User::count();
            $ordersCount = Order::count();
            $productsCount = Product::count();
            $categorysCount = Category::count();
            $totalRevenue = Order::sum('total');

            $latestOrders = Order::latest()->take(5)->get();
            
            $monthlyOrders = Order::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('month')
            ->pluck('count', 'month');

        // Monthly revenue
        $monthlyRevenue = Order::selectRaw('MONTH(created_at) as month, SUM(total) as revenue')
            ->groupBy('month')
            ->pluck('revenue', 'month');

          $topProducts = OrderItem::selectRaw('product_id, SUM(quantity) as quantity')
    ->with('product:id,name')
    ->groupBy('product_id')
    ->get()
    ->map(fn($item) => [
        'name' => $item->product->name,
        'quantity' => $item->quantity
    ])
    ->sortByDesc('quantity')
    ->take(20)
    ->values() // reindex
    ->all(); // convert collection to array


            return view('admin.dashboard', compact(
                'usersCount',
                'ordersCount',
                'productsCount',
                'categorysCount',
                'totalRevenue',
                'topProducts',
                'monthlyOrders',
                'monthlyRevenue',
            ));
    }
}
