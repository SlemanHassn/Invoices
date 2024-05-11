<?php

namespace App\Exports;

use App\Models\invoice;
use Maatwebsite\Excel\Concerns\FromCollection;

class InvoicesExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return invoice::SELECT('invoice_num','invoice_Date','due_Date','Amount_collection','Amount_Commission','Discount','Rate_VAT','Total','Payment_Date')->get();
    }
}
