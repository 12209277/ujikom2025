<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    { 
        return view('home');
    }

    public function chartData()
    {
        $startDate = Carbon::now()->subDays(5);
        $endDate = Carbon::now();

        $sales = Sale::whereBetween('created_at', [$startDate, $endDate])
            ->get();

        $chartData = [
            'labels' => [],
            'datasets' => [
                [
                    'label' => 'Laba Penjualan Minggu Ini',
                    'data' => [],
                    'borderWidth' => 1
                ]
            ]
        ];

        foreach ($sales as $sale) {
            $chartData['labels'][] = $sale->created_at->format('Y-m-d');
            $chartData['datasets'][0]['data'][] = $sale->total_amount;
        }

        return response()->json($chartData);
    }
}
