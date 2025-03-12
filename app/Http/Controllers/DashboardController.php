<?php

namespace App\Http\Controllers;

use App\Enums\AddressType;
use App\Enums\CustomerStatus;
use App\Enums\OrderStatus;
use App\Http\Resources\CustomerResource;
use App\Http\Resources\Dashboard\OrderResource;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use App\Traits\ReportTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class DashboardController extends Controller
{
    
    public function index(Request $request)
    {
        $date = $request->input('date', 'all');

        $data = [
            'customersCount' => $this->activeCustomers($date),
            'productsCount' => $this->activeProducts($date),
            'paidOrders' => $this->paidOrders($date),
            'totalIncome' => $this->totalIncome($date),
            'ordersByCountry' => $this->ordersByCountry($date),
            'latestCustomers' => $this->latestCustomers($date),
            'latestOrders' => $this->latestOrders($date),
        ];
        

        
        return Inertia::render('Dashboard', $data);
    }

    public function activeCustomers($date = null)
    {
        $fromDate = $this->getFromDate($date);
        $query = Customer::where('status', CustomerStatus::Active->value);

        if ($fromDate) {
            $query->where('created_at', '>', $fromDate);
        }

        return $query->count();
    }

    public function activeProducts($date = null)
    {
        $fromDate = $this->getFromDate($date);
        $query = Product::where('published', 1);

        if ($fromDate) {
            $query->where('created_at', '>', $fromDate);
        }

        return $query->count();
    }

    public function paidOrders($date = null)
    {
        $fromDate = $this->getFromDate($date);
        $query = Order::where('status', OrderStatus::Paid->value);

        if ($fromDate) {
            $query->where('created_at', '>', $fromDate);
        }

        return $query->count();
    }

    public function totalIncome($date = null)
    {
        $fromDate = $this->getFromDate($date);
        $query = Order::where('status', OrderStatus::Paid->value);

        if ($fromDate) {
            $query->where('created_at', '>', $fromDate);
        }

        return round($query->sum('total_price'));
    }

    public function ordersByCountry($date = null)
    {
        $fromDate = $this->getFromDate($date);

        $query = Order::select(['c.name AS country_name', DB::raw('COUNT(orders.id) AS count')])
            ->join('users', 'orders.created_by', '=', 'users.id')
            ->join('customer_addresses AS a', 'users.id', '=', 'a.customer_id')
            ->join('countries AS c', 'a.country_code', '=', 'c.code')
            ->where('orders.status', OrderStatus::Paid->value)
            ->where('a.type', AddressType::Billing->value)
            ->groupBy('c.name');

        if ($fromDate) {
            $query->where('orders.created_at', '>', $fromDate);
        }

        return $query->get();
    }

    public function latestCustomers($date = null)
    {
        $fromDate = $this->getFromDate($date);

        $query = Customer::select(['customers.user_id', 'customers.first_name', 'customers.last_name', 'u.email', 'customers.phone', 'u.created_at'])
            ->join('users AS u', 'u.id', '=', 'customers.user_id')
            ->where('customers.status', CustomerStatus::Active->value)
            ->orderBy('customers.created_at', 'desc')
            ->limit(5);

        if ($fromDate) {
            $query->where('customers.created_at', '>', $fromDate);
        }

        return CustomerResource::collection($query->get());
    }

    public function latestOrders($date = null)
    {
        $fromDate = $this->getFromDate($date);

        $query = Order::select(['o.id', 'o.total_price', 'o.created_at', DB::raw('COUNT(oi.id) AS items'), 'c.user_id', 'c.first_name', 'c.last_name'])
            ->from('orders AS o')
            ->join('order_items AS oi', 'oi.order_id', '=', 'o.id')
            ->join('customers AS c', 'c.user_id', '=', 'o.created_by')
            ->where('o.status', OrderStatus::Paid->value)
            ->limit(10)
            ->orderBy('o.created_at', 'desc')
            ->groupBy('o.id', 'o.total_price', 'o.created_at', 'c.user_id', 'c.first_name', 'c.last_name');

        if ($fromDate) {
            $query->where('o.created_at', '>', $fromDate);
        }

        return OrderResource::collection($query->get());
    }

    private function getFromDate($date = null)
    {
        if ($date && $date !== 'all') {
            return Carbon::parse($date)->startOfDay();
        }
        return null;
    }
}



