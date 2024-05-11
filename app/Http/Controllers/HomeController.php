<?php

namespace App\Http\Controllers;

use App\Models\invoice;
use Illuminate\Http\Request;

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


        $paidInvoices = invoice::where('Value_Status', 1)->count();
        $unpaidInvoices = invoice::where('Value_Status', 2)->count();
        $partiallyPaidInvoices = invoice::where('Value_Status', 3)->count();
        $totalInvoices = invoice::count();

        $chartjs1 = app()->chartjs
        ->name('barChartTest')
        ->type('bar')
        ->size(['width' => 600, 'height' => 263])
        ->labels(['Label x', 'Label y'])
        ->datasets([
            [
                "label" => "الفواتير المدفوعة",
                'backgroundColor' => '#20b182',
                'data' => [$paidInvoices]
            ],
            [
                "label" => "الفواتير الغير مدفوعة",
                'backgroundColor' => '#f84d6a',
                'data' => [  $unpaidInvoices]
            ],
            [
                "label" => "الفواتير الغير مدفوعة",
                'backgroundColor' => '#f47e3e',
                'data' => [$partiallyPaidInvoices]
            ]
         ])
         ->options([]);




        $chartjs2 = app()->chartjs
        ->name('pieChartTest')
        ->type('pie')
        ->size(['width' => 600, 'height' => 350])
        ->labels(['الفواتير المدفوعة', 'الفواتير المدفوعة جزئيا', 'الفواتير الغير مدفوعة'])
        ->datasets([
            [
                'backgroundColor' => ['#20b182', '#f47e3e','#f84d6a'],
                'hoverBackgroundColor' => ['#20b182', '#f47e3e','#f84d6a'],
                'data' => [
                    round($paidInvoices /   $totalInvoices, 4) * 100 ,
                    round($partiallyPaidInvoices/ $totalInvoices, 4) * 100,
                    round($unpaidInvoices/ $totalInvoices, 4) * 100]
            ]
        ])
        ->options([]);



        return view('home',compact('chartjs2','chartjs1'));
    }
}
