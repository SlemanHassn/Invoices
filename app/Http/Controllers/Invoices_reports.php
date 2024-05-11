<?php

namespace App\Http\Controllers;

use App\Models\invoice;
use App\Models\section;
use Illuminate\Http\Request;

class Invoices_reports extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:تقارير الفواتير', ['only' => ['index','sarech']]);
    }

    public function index(){

        $sections=section::all();
        return view('reports.invoices_report',compact('sections'));
    }

    public function sarech(Request $request){
   
        if($request->radio == 1){
            // بحث بنوع الفاتورة
            if($request->type && $request->start_at == '' &&  $request->end_at == '' )
            {
                //   اذا لم يقم بتحديد تواريخ معينة
                $sections=section::all();

                $type = $request->type;
                if($type != 4){
                    $invoices = invoice::where('Value_Status','=',$request->type)->get();
                }
                else{
                    $invoices = invoice::get();
                }
                return view('reports.invoices_report',compact('sections','type',"invoices"));

            }
            elseif($request->type && $request->start_at &&  $request->end_at){
                $sections=section::all();
                $start_at = date($request->start_at);
                $end_at = date($request->end_at);
                $type = $request->type;

                if($type != 4){
                    $invoices = invoice::whereBetween('invoice_Date',[$start_at,$end_at])->where('Value_Status','=',$request->type)->get();
                }
                else{
                     $invoices = invoice::whereBetween('invoice_Date',[$start_at,$end_at])->get();
                }
                return view('reports.invoices_report',compact('sections','type','start_at','end_at',"invoices"));
            }

        }
        else{
            // بحث برقم الفاتورة
            $invoices = invoice::where('invoice_num','=',$request->invoice_number)->get();
            $sections=section::all();
            $invoice_num = $request->invoice_number;
            return view('reports.invoices_report',compact('sections',"invoices",'invoice_num'));

        }


    }
}
