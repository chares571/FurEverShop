<?php

namespace App\Livewire\Admin;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Livewire\Component;

class DashboardPage extends Component
{
    public function render()
    {
        return view('livewire.admin.dashboard-page', [
            'metrics' => [
                'products' => Product::count(),
                'orders' => Order::count(),
                'users' => User::where('role', User::ROLE_USER)->count(),
                'revenue' => Order::sum('total_price'),
            ],
            'recentOrders' => Order::query()->with('user')->latest()->take(5)->get(),
            'lowStockProducts' => Product::query()->where('stock', '<=', 5)->orderBy('stock')->take(5)->get(),
        ])->layout('layouts.admin', [
            'title' => 'Admin Dashboard | FurEver',
        ]);
    }
}
