<?php

namespace App\Http\Controllers;

use App\Models\invoice_attachments;
use Faker\Core\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InvoiceAttachmentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:إضافة مرفق', ['only' => ['store']]);
        $this->middleware('permission:عرض المرفق', ['only' => ['getPic']]);
        $this->middleware('permission:تحميل المرفق', ['only' => ['downloadPic']]);
        $this->middleware('permission:حذف المرفق', ['only' => ['destroy']]);
    }

    public function store(Request $request)
    {
                $invoice_id =$request->invoice_id;
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


                session()->flash('Add');
                return redirect()->back();
    }

    public function getPic($invoice_num,$filename)

    {   $path = Storage::disk('public_uploads')->path($invoice_num . '/' . $filename);
        $type = mime_content_type($path);
        return response()->file($path, [
        'Content-Type' => $type,
        'Content-Disposition' => 'inline',
]);
        }

    public function downloadPic($invoice_num,$filename)
    {   $path = Storage::disk('public_uploads')->path($invoice_num . '/' . $filename);
        return response()->download($path);
    }



    public function destroy(Request $request)
    {
        $invoiceAttachments= invoice_attachments::findOrfail($request->id_file);
        $invoiceAttachments->delete();
        Storage::disk('public_uploads')->delete($request->invoice_number.'/'.$request->file_name);
        session()->flash('delete');
        return redirect()->back();
    }
}
