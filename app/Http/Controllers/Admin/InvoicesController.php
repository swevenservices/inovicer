<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyInvoiceRequest;
use App\Http\Requests\StoreInvoiceRequest;
use App\Http\Requests\UpdateInvoiceRequest;
use App\Mail\Recepit;
use App\Models\Currency;
use App\Models\Expense;
use App\Models\Income;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Receipt;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use PDF;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class InvoicesController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('invoice_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $invoices = Invoice::orderBy('id','desc')->paginate(25);
        return view('admin.invoices.index',compact('invoices'));
    }

    public function create()
    {
        abort_if(Gate::denies('invoice_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $currencies = Currency::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $invoice = Invoice::all()->last();
        if ($invoice) {
            $id = $invoice->id;
        } else 
        {
            $id = 1;
        }
        return view('admin.invoices.create', compact('currencies', 'id'));
    }

    public function store(StoreInvoiceRequest $request)
    {
        $vat = 0;
        $discount = 0;
        $invoice = Invoice::create($request->all());
        $resp = $this->items($request, $invoice);
        $total = $resp['total'];
        $cost = $resp['cost'];
        $customer = User::find($request->customer);
        if ($invoice->vat) {
            $vat = ($invoice->vat / 100) * $total;
        }
        if ($invoice->discount) {
            
            if($request->discount_type == "fixed")
            {
               $discount = $invoice->discount;
            }
            else{
                $discount = ($invoice->discount / 100) * $total;
            }
        }
        $total = ($total - $discount) + $vat;

        $invoice = Invoice::find($invoice->id);
        $invoice->total = $total;
        $invoice->customer_name = $customer->name;
        $invoice->complete_address = $customer->address;
        $invoice->email = $customer->email;
        $invoice->user_id = $customer->id;
        $invoice->slug = Str::slug($invoice->customer_name) . time();
        $invoice->save();

        $receipt = new Receipt();
        $this->receipt($request, $invoice, $total, $receipt, $cost);
        
        if ($request->is_expensed) {
            $expense = new Expense();
            $this->expense($request, $expense, $invoice, $cost);
        }
        if ($request->is_incomed) {
            $income = new Income();
            $this->income($request, $income, $invoice);
        }
        return redirect()->route('admin.invoices.index');
    }

    public function edit(Invoice $invoice)
    {
       
        abort_if(Gate::denies('invoice_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $currencies = Currency::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $invoice->load('currency', 'invoiceInvoiceItems', 'recepit');
        return view('admin.invoices.edit', compact('currencies', 'invoice'));
    }

    public function income($request, $income, $invoice)
    {
        $income->entry_date = Carbon::today()->toDateString();
        $income->income_category_id = 1;
        $income->invoice_id = $invoice->id;
        $income->amount = $invoice->total;
        $income->save();
    }

    public function expense($request, $expense, $invoice, $cost)
    {
        $expense->entry_date = Carbon::today()->toDateString();
        $expense->expense_category_id = 1;
        $expense->invoice_id = $invoice->id;
        $expense->amount = $cost;
        $expense->save();
    }

    public function receipt($request, $invoice, $total, $receipt, $cost)
    {
        $received = 0;
        $pending = 0;
        if ($request->received) {
            $received = $request->received;
            $pending = $total - $received;
        } else {
            $pending = $total;
        }
        $receipt->received = $received;
        $receipt->pending = $pending;
        $receipt->total = $total;
        $receipt->material = $cost;
        $receipt->material = $invoice->customer_id;
        $receipt->profit = $total - $request->material_cost;
        $receipt->invoice_id = $invoice->id;
        $receipt->save();
    }

    public function items($request, $invoice)
    {
        $total = 0;
        $cost = 0;
        for ($i = 0; $i < sizeof($request->item_name); $i++) {
            $item = new InvoiceItem();
            if ($request['item_name'][$i] != "" ) {
                $item->name = $request['item_name'][$i];
                $item->description = $request['item_description'][$i];
                $item->qty = $request['item_qty'][$i];
                $item->unit = $request['item_unit'][$i];
                $item->total = $request['item_price'][$i];
                $item->cost_price = $request['cost_price'][$i];
                $item->invoice_id = $invoice->id;
                $item->save();
                $total += $item->qty * $item->total;
                $cost += $item->qty * $item->cost_price;
            }
        }
        return array('cost' => $cost, 'total' => $total);
    }

    public function update(UpdateInvoiceRequest $request, Invoice $invoice)
    {
        $vat = 0;
        $discount = 0;

        $invoice->update($request->all());
        InvoiceItem::where('invoice_id', $invoice->id)->delete();
        $resp = $this->items($request, $invoice);
        $total = $resp['total'];
        $cost = $resp['cost'];

        if ($request->customer) {
            $customer = User::find($request->customer);
            $invoice->customer_name = $customer->name;
            $invoice->complete_address = $customer->address;
            $invoice->email = $customer->email;
            $invoice->user_id = $customer->id;
            
            $invoice->save();
        }

        if ($invoice->vat) {
            $vat = ($invoice->vat / 100) * $total;
        }
        if ($invoice->discount) {
            
           if($request->discount_type == "fixed")
            {
               $discount = $invoice->discount;
            }
            else{
               
               $discount = ($invoice->discount / 100) * $total;
            }
        }

        $total = ($total - $discount) + $vat;
        $invoice->total = $total;
        $invoice->slug = Str::slug($invoice->customer_name) . time();
        $invoice->cloned_at = null;
        $invoice->save();
        $receipt = Receipt::where('invoice_id', $invoice->id)->first();
        if ($request) {
            $this->receipt($request, $invoice, $total, $receipt, $cost);
        }
        if ($request->is_expensed) {
            $expense = Expense::where('invoice_id', $invoice->id)->first();
            if (!$expense) {
                $expense = new Expense();
            }
            $this->expense($request, $expense, $invoice, $cost);
        }
        if ($request->is_incomed) {
            $income = Income::where('invoice_id', $invoice->id)->first();
            if (!$income) {
                $income = new Income();
            }
            $this->income($request, $income, $invoice);
        }

        return redirect()->route('admin.invoices.index');
    }

    public function show(Invoice $invoice)
    {
        //Mail::to('qureshi1amer@gmail.com')->send(new \App\Mail\Invoice($invoice));
        abort_if(Gate::denies('invoice_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $invoice->load('currency', 'invoiceInvoiceItems', 'recepit', 'income', 'expense');
        return view('admin.invoices.show', compact('invoice'));
    }

    public function detail($id)
    {
        $invoice = Invoice::findOrFail($id);
        abort_if(Gate::denies('invoice_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $invoice->load('currency', 'invoiceInvoiceItems','recepit');
        $customer = User::find($invoice->user_id);

        return view('admin.invoices.invoice', compact('invoice', 'customer'));
    }
    
    public function sendMail(Request $request)
    {
        $this->validate($request, [
            'invoice_id' => 'required',
            'pdf_file' => 'required',
        ]);
        $invoice = Invoice::findOrFail($request->invoice_id);
        $invoice->load('currency', 'invoiceInvoiceItems', 'recepit');
        if ($invoice->email) {
            Mail::to($invoice->email)->send(new \App\Mail\Invoice($invoice, $request));
            return redirect()->route('admin.invoices.index')->with('success', 'Mail Sent successfully');
        }
        return redirect()->route('admin.invoices.index')->with('error', 'Mail cannot be sent email address not found');
    }
    public function destroy(Invoice $invoice)
    {
        abort_if(Gate::denies('invoice_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $invoice->recepit()->delete();
        $invoice->income()->delete();
        $invoice->expense()->delete();
        $invoice->invoiceInvoiceItems()->delete();
        $invoice->delete();
        return back()->with('success', 'Invoice with payments, incomes, expenses removed successfully');
    }
    public function massDestroy(MassDestroyInvoiceRequest $request)
    {
        // Invoice::whereIn('id', request('ids'))->with('recepit', 'income', 'expense')->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
    public function viewInovice($slug)
    {
        $invoice = Invoice::where('slug', $slug)->firstOrFail();
        $invoice->load('currency', 'invoiceInvoiceItems');
        return view('admin.invoices.show', compact('invoice'));
    }
    public function ajaxData(Request $request)
    {
        $search = $request->search;
        if ($search == '') {
            $invoices = DB::table('invoices')->orderby('id', 'DESC')->limit(10)->get();
        } else {
            $invoices = DB::table('invoices')->orderby('id', 'DESC')
                ->where('customer_name', 'like', '%' . ucfirst($search) . '%')
                ->orWhere('invoice_number', 'like', '%' . $search . '%')
                ->limit(10)->get();
        }
        $response = array();
        foreach ($invoices as $invoice) {
            $response[] = array(
                "id" => $invoice->invoice_number,
                "text" => $invoice->customer_name . ' ( ' . $invoice->invoice_number .' )'
            );
        }
        return response()->json($response);

    }
    
    public function Clone($id){
        
       $invoice = Invoice::findOrFail($id);
       $invoice->load('currency', 'invoiceInvoiceItems','recepit');
       $new = $invoice->replicate();
       $new->cloned_at = \Illuminate\Support\Carbon::now();
       $new->invoice_number =  str_replace('-', '', date('Y-m-d')) .''. Invoice::all()->last()->id;
       $new->save();
       
       $receipt = $invoice->recepit->replicate();
       $receipt->invoice_id = $new->id;
       $receipt->save();
        foreach($invoice->invoiceInvoiceItems as $item){
         $itemnew = $item->replicate();
         $itemnew->invoice_id = $new->id;
         $itemnew->save();
       }
      
        return redirect()->route('admin.invoices.index');
    }
}
