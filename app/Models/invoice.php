<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class invoice extends Model
{
    use HasFactory;
     use SoftDeletes;
    protected $fillable = [
        'invoice_num',
        'invoice_Date',
        'due_Date',
        'category',
        'section_id',
        "Amount_collection",
        'Amount_Commission',
        'Discount',
        'Value_VAT',
        'Rate_VAT',
        'Total',
        'Value_Status',
        'note',
        'Payment_Date',
    ];
    protected $data=['deleted_at'];
    public function section(): BelongsTo
    {
        return $this->belongsTo(section::class,'section_id');
    }
}

