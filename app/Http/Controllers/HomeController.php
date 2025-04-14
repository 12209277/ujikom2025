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
        $totalSalesToday = Sale::whereDate('created_at', Carbon::today())->sum('total_amount');

        return view('home', compact('totalSalesToday'));
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
                    'label' => 'Laba Penjualan 1 Minggu Kebelakang',
                    'data' => [],
                    'borderWidth' => 1
                ]
            ]
        ];
    
        $dates = [];
        foreach ($sales as $sale) {
            $date = $sale->created_at->format('Y-m-d');
            if (!isset($dates[$date])) {
                $dates[$date] = 0;
            }
            $dates[$date] += $sale->total_amount;
        }
    
        foreach ($dates as $date => $total) {
            $chartData['labels'][] = $date;
            $chartData['datasets'][0]['data'][] = $total;
        }
    
        return response()->json($chartData);
    }
}
