<?php

namespace App\Http\Controllers;

use App\Models\invoice;
use App\Models\section;
use Illuminate\Http\Request;

class customers_reports extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:تقارير العملاء', ['only' => ['index','sarech']]);
    }

    public function index(){

        $sections=section::all();
        return view('reports.customers_report',compact('sections'));
    }




     public function sarech(Request $request){
    // Section category start_at end_at

        if($request->Section   && $request->category &&  $request->start_at == ''  &&  $request->end_at == '' )
            {
                //   اذا لم يقم بتحديد تواريخ معينة
                $sections=section::all();

                $Section = $request->Section;
                $category = $request->category;
                $invoices = invoice::where('section_id','=',$request->Section)->where('category','=',$request->category)->get();
                return view('reports.customers_report',compact('sections','Section','category',"invoices"));

            }
            elseif($request->Section   && $request->category &&  $request->start_at  &&  $request->end_at){
                $sections=section::all();
                $Section = $request->Section;
                $category = $request->category;
                $start_at = date($request->start_at);
                $end_at = date($request->end_at);

                $invoices = invoice::whereBetween('invoice_Date',[$start_at,$end_at])->where('section_id','=',$request->Section)->where('category','=',$request->category)->get();
                return view('reports.customers_report',compact('sections','Section','category','start_at','end_at',"invoices"));
            }
        }
}
