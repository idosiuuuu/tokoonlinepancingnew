<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Customer;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // View::composer('*', function ($view) {
        // $order = null;

        // if (Auth::check()) {
        //     $customer = Customer::where('user_id', Auth::id())->first();
        //     if ($customer) {
        //         $order = Order::where('customer_id', $customer->id)
        //             ->whereIn('status', ['pending'])
        //             ->with('orderItems.produk')
        //             ->first();
        //     }
        // }

        // $view->with('order', $order);
        // });
    }
}
