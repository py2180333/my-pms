<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_p_no',
        'invoice_date',
        'invoice_due_date',
        'company_id',
        'customer_id',
        'milestone_id',
        'note',
        'alltotal',
        'gst',
        'grandtotal',
        'currency',
        'prefix',
        'template',
        'invoice_number',
        'status',
        'option_tax',
        'created_by',
        'updated_by'
    ];

    public function items()
    {
        return $this->hasMany(InvoiceItem::class);
    }
    public function milestone()
    {
        return $this->belongsTo(milestone::class, 'milestone_id');
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}
