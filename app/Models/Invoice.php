<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use Auditable;
    use HasFactory;

    public $table = 'invoices';

    public static $searchable = [
        'invoice_number',
    ];

    protected $dates = [
        'invoice_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'invoice_number',
        'purchase_order_number',
        'show_fifty',
        'invoice_date',
        'due_date',
        'percentage',
        'customer_name',
        'company',
        'complete_address',
        'total',
        'discount',
        'discount_type',
        'currency_id',
        'created_at',
        'company_template',
        'vat',
        'type',
        'slug',
        'notes',
        'attention',
        'project',
        'privacy_policy',
        'admin_company',
        'user_id',
        'clean',
        'template_type',
        'payment_type',
        'email',
        'updated_at',
        'deleted_at',
    ];

    public function invoiceInvoiceItems()
    {
        return $this->hasMany(InvoiceItem::class, 'invoice_id', 'id');
    }

    public function getInvoiceDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setInvoiceDateAttribute($value)
    {
        $this->attributes['invoice_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class, 'currency_id');
    }

    public function recepit()
    {
        return $this->hasOne(Receipt::class);
    }

    public function income()
    {
        return $this->hasOne(Income::class);
    }

    public function expense()
    {
        return $this->hasOne(Expense::class);
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
