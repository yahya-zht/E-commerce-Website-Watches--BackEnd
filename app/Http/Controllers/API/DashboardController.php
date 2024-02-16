<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Customer;
 use App\Models\Order;
use App\Models\Product;
 use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
 use Carbon\Carbon;     
class DashboardController extends Controller
{
    public function index(){
        // function getOrderCountForToday(){
            $ProductsCount = Product::count();
            $CustomersCount = Customer::count();
            $currentDate = now()->toDateString(); // Get the current date in YYYY-MM-DD format
            $orderCountDay = Order::whereDate('created_at', $currentDate)->count();
            $yesterday = Carbon::yesterday()->toDateString(); // Get the date of yesterday in YYYY-MM-DD format
            $orderCountYesterday = Order::whereDate('created_at', $yesterday)->count();
            // $orderCountYesterday = Order::whereDate('created_at', $currentDate)->count();
            $orderCountWeek = DB::table('orders')->whereRaw('YEAR(created_at) = YEAR(CURDATE())')->whereRaw('WEEK(created_at) = WEEK(CURDATE())')->count();
            $orderCountMonth = DB::table('orders')->whereRaw('YEAR(created_at) = YEAR(CURDATE())')->whereRaw('MONTH(created_at) = MONTH(CURDATE())')->count();
            $orderCountYear = DB::table('orders')->whereRaw('YEAR(created_at) = YEAR(CURDATE())')->count();
            $orderCountAllTime = DB::table('orders')->count();
            $EarningsDay= Order::whereDate('created_at', $currentDate)->sum('Total_Price');
            $EarningsYesterday = Order::whereDate('created_at', $yesterday)->sum('Total_Price');
            $EarningsWeek=DB::table('orders')
                ->whereRaw('YEAR(created_at) = YEAR(CURDATE())')
                ->whereRaw('WEEK(created_at) = WEEK(CURDATE())')
                ->sum('Total_Price');
            $EarningsMonth=DB::table('orders')
                ->whereRaw('YEAR(created_at) = YEAR(CURDATE())')
                ->whereRaw('MONTH(created_at) = MONTH(CURDATE())')
                ->sum('Total_Price');
            $EarningsYear=DB::table('orders')
                ->whereRaw('YEAR(created_at) = YEAR(CURDATE())')
                ->sum('Total_Price');
            $EarningsAllTime= DB::table('orders')->sum('Total_Price');

            $Orders=([

                'OrdersDay'=>$orderCountDay,
                'OrdersYesterday'=>$orderCountYesterday,
                'OrdersWeek'=>$orderCountWeek,
                'OrdersMonth'=>$orderCountMonth,
                'OrdersYear'=>$orderCountYear,
                'OrdersTotal'=>$orderCountAllTime,
                'EarningsDay'=>$EarningsDay,
                'EarningsYesterday'=>$EarningsYesterday,
                'EarningsWeek'=>$EarningsWeek,
                'EarningsMonth'=>$EarningsMonth,
                'EarningsYear'=>$EarningsYear,
                'EarningsTotal'=>$EarningsAllTime,
            ]);
            $Counts=([
                'ProductsCount'=>$ProductsCount,
                'CustomerCount'=>$CustomersCount,
            ]);
            // $Count=([
            //     'ProductsCount'=>$ProductsCount,
            //     'CustomerCount'=>$CustomersCount,
            // ]);
                $TopSelling = Product::select('products.id','products.Ref', 'products.Name', 'products.Image_Product', 'products.Price_Sale',
                        DB::raw('SUM(order_product.Quantity) AS Quantity'),
                        DB::raw('(products.Price_Sale * SUM(order_product.Quantity)) AS Total'))
                    ->join('order_product', 'products.id', '=', 'order_product.Product_id')
                    ->join('orders', 'orders.id', '=', 'order_product.Order_id')
                    ->whereRaw('WEEK(orders.created_at) = WEEK(CURDATE())')
                    ->groupBy('products.id','products.Ref', 'products.Name', 'products.Image_Product', 'products.Price_Sale')
                    ->orderByDesc('Quantity')
                    ->limit(3)
                    ->get();
            return response()->json(['Orders'=>$Orders,'Counts'=>$Counts,'TopSelling'=>$TopSelling]);
    }
}
