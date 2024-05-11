<?php

namespace App\Http\Controllers;

use App\Models\invoice;
use App\Models\invoice_attachments;
use App\Models\invoices_details;
use Illuminate\Http\Request;

class InvoicesDetailsController extends Controller
{public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:عرض فاتورة', ['only' => ['getdetails']]);
    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(invoices_details $invoices_details)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(invoices_details $invoices_details)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, invoices_details $invoices_details)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(invoices_details $invoices_details)
    {
        //
    }
        public function getdetails($id)
    {
        $invoices= invoice::findOrfail($id);
        $details = invoices_details::get()->where("id_Invoice",$id);
        $attachments=invoice_attachments::get()->where("invoice_id",$id);
        return view('invoices.invoice_details',compact('invoices','details',"attachments"));
    }

}
