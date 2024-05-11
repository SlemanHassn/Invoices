<?php

namespace App\Http\Controllers;

use App\Exports\InvoicesExport;
use App\Models\category;
use App\Models\invoice;
use App\Models\invoice_attachments;
use App\Models\invoices_details;
use App\Models\section;
use App\Models\User;
use App\Notifications\add_invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class InvoiceController extends Controller
{

     public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:قائمة الفواتير', ['only' => ['index']]);
        $this->middleware('permission:الفواتير المدفوعة', ['only' => ['paid']]);
        $this->middleware('permission:الفواتير الغير مدفوعة', ['only' => ['unpaid']]);
        $this->middleware('permission:الفواتير المدفوعة جزئيا', ['only' => ['somepaid']]);
        $this->middleware('permission:إضافة فاتورة', ['only' => ['create','store']]);
        $this->middleware('permission:تعديل فاتورة', ['only' => ['edit','update']]);
        $this->middleware('permission:نقل الى الارشيف', ['only' => ['destroy']]);
        $this->middleware('permission:استعادة فاتورة', ['only' => ['retrached']]);
        $this->middleware('permission:الارشيف', ['only' => ['trached']]);
        $this->middleware('permission:حذف فاتورة', ['only' => ['delete']]);
        $this->middleware('permission:حالة الدفع', ['only' => ['status','updateStatus']]);
        $this->middleware('permission:طباعة فاتورة', ['only' => ['print']]);
        $this->middleware('permission:تصدير اكسيل', ['only' => ['export']]);
    }

    public function index()
        {
            $invoices = invoice::all()->sortByDesc('id');
            return view('invoices.invoices',compact('invoices'));
        }
    public function paid()
        {
            $invoices = invoice::all()->where('Value_Status',1)->sortByDesc('id');
            return view('invoices.invoices',compact('invoices'));
        }
    public function unpaid()
        {
            $invoices = invoice::all()->where('Value_Status',2)->sortByDesc('id');
            return view('invoices.invoices',compact('invoices'));
        }
    public function somepaid()
        {
            $invoices = invoice::all()->where('Value_Status',3)->sortByDesc('id');
            return view('invoices.invoices',compact('invoices'));
        }


    public function create()
        {
            $sections= section::all();
                    return view('invoices.add_invoice',compact('sections'));
        }


    public function store(Request $request)
        {
                invoice::create([
                'invoice_num'       =>$request->invoice_num,
                'invoice_Date'      =>$request->invoice_Date,
                'due_Date'          =>$request->due_Date,
                'category'          =>$request->category    ,
                'section_id'        =>$request->Section,
                'Amount_collection' =>$request->Amount_collection,
                'Amount_Commission' =>$request->Amount_Commission,
                'Discount'          =>$request->Discount,
                'Value_VAT'         =>$request->Value_VAT,
                'Rate_VAT'          =>$request->Rate_VAT,
                'Total'             =>$request->Total,
                'Value_Status'      =>'2',
                'note'              =>$request->note,
            ]);
            $invoice_id =invoice::latest()->first()->id;
            invoices_details::create([
                'id_Invoice'       =>$invoice_id,
                'invoice_number'   =>$request->invoice_num,
                'category'         =>$request->category    ,
                'section_id'       =>$request->Section,
                'Value_Status'     =>'2',
                'Payment_Date'     =>$request->Payment_Date,
                'note'             =>$request->note,
                'user'             =>auth()->user()->name,
                ]);
            if($request->hasFile('pic')){
                $invoice_id =invoice::latest()->first()->id;
                $image= $request->file('pic');
                $filename= $image->getClientOriginalName();
                $invoice_number = $request->invoice_num;
                $attachment = new invoice_attachments();
                $attachment->file_name=$filename;
                $attachment->invoice_number=$invoice_number;
                $attachment->Created_by=auth()->user()->name;
                $attachment->invoice_id=$invoice_id;
                $attachment->save();
                $imageName = $request->pic->getClientOriginalName();
                $request->pic->move(public_path('Attachments/'.$invoice_number),$imageName);
            }
            $users = User::get();
            $invoice =invoice::latest()->first();
            Notification::send($users, new add_invoice($invoice));
            session()->flash('Add');
            return redirect()->route('invoices.index');
        }


    public function edit(invoice $invoice)
        {
            $sections= section::all();
            return view('invoices.edit_invoice',compact('invoice','sections'));
        }


    public function update(Request $request, invoice $invoice)
        {
            $invoice->update([
                    'invoice_num'       =>$request->invoice_num,
                    'invoice_Date'      =>$request->invoice_Date,
                    'due_Date'          =>$request->due_Date,
                    'category'          =>$request->category    ,
                    'section_id'        =>$request->Section,
                    'Amount_collection' =>$request->Amount_collection,
                    'Amount_Commission' =>$request->Amount_Commission,
                    'Discount'          =>$request->Discount,
                    'Value_VAT'         =>$request->Value_VAT,
                    'Rate_VAT'          =>$request->Rate_VAT,
                    'Total'             =>$request->Total,
                    'note'              =>$request->note,
                ]);
            $invoice_id =invoice::latest()->first()->id;
            $invoices_details =invoices_details::first()->where('id_Invoice',$invoice_id);
            $invoices_details->update([
                    'id_Invoice'       =>$invoice_id,
                    'invoice_number'   =>$request->invoice_num,
                    'category'         =>$request->category    ,
                    'section_id'       =>$request->Section,
                    'Payment_Date'     =>$request->Payment_Date,
                    'note'             =>$request->note,
                    'user'             =>auth()->user()->name,
                    ]);
            session()->flash('edit');
            return redirect()->route('invoices.index');
        }


    public function destroy(Request $request)
        {
            $invoice=invoice::first()->where('id',$request->invoice_id);
            $invoice->delete();
            session()->flash('arrchif');
            return redirect()->route('invoices.index');

        }
    public function retrached(Request $request)
        {
            $invoice =invoice::onlyTrashed()->findOrFail($request->invoice_id);
            $invoice->restore();
            session()->flash('restore_invoice');
            return redirect()->route('invoices.index');
        }

    public function getoption($id)
        {
            $categories = category::all()->where('section_id',$id)->pluck('name','id');
            return json_encode($categories );
        }

    public function trached()
        {
            $invoices =invoice::onlyTrashed()->get();
            return view('invoices.trashed',compact('invoices'));
        }

    public function delete(Request $request)
        {
            $invoice=invoice::onlyTrashed()->findOrFail($request->invoice_id);
            $invoiceAttachments= invoice_attachments::first()->where('invoice_id',$request->invoice_id);
            Storage::disk('public_uploads')->deleteDirectory($invoice->invoice_num);
            $invoice->forceDelete();

            session()->flash('delete');
            return redirect()->route('invoices.index');
        }

    public function status($id)
        {

            $invoices = invoice::findOrFail($id);
            return view('invoices.status',compact('invoices'));
        }
    public function updateStatus(Request $request)
        {
            $invoice = invoice::findOrFail($request->invoice_id);

            $invoice->update([
                    'Value_Status'      =>$request->Value_Status,
                    'Payment_Date'      =>$request->Payment_Date,
                ]);

            invoices_details::create([
                'id_Invoice'       =>$request->invoice_id,
                'invoice_number'   =>$request->invoice_num,
                'category'         =>$request->category    ,
                'section_id'       =>$request->Section,
                'Value_Status'     =>$request->Value_Status,
                'Payment_Date'     =>$request->Payment_Date,
                'note'             =>$request->note,
                'user'             =>auth()->user()->name,
                ]);
            session()->flash('Status_Update');
            return redirect()->route('invoices.index');
        }

    public function print($id){
        $invoice = invoice::findOrFail($id);
        return view('invoices.invoice',compact('invoice'));
    }
    public function export()
        {
            return Excel::download(new InvoicesExport, 'invoices.xlsx');
        }

    public function markAsRead()
        {
           auth()->user()->unreadNotifications->markAsRead();
           return redirect()->back();
        }
}
