<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyReceiptRequest;
use App\Http\Requests\StoreReceiptRequest;
use App\Http\Requests\UpdateReceiptRequest;
use App\Models\Invoice;
use App\Models\Receipt;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\Response;

class ReceiptsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('receipt_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $receipts = Receipt::with(['invoice'])->get();

        return view('admin.receipts.index', compact('receipts'));
    }

    public function create()
    {
        abort_if(Gate::denies('receipt_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $invoices = Invoice::pluck('invoice_number', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.receipts.create', compact('invoices'));
    }

    public function sendMail(Request $request)
    {
        $this->validate($request, [
            'recepit_id' => 'required',
        ]);
        $recepit = Receipt::findOrFail($request->recepit_id);
        $invoice = Invoice::find($recepit->invoice_id);
        $invoice->load('currency', 'invoiceInvoiceItems', 'recepit');
        if ($invoice->email) {
            Mail::to($invoice->email)->send(new \App\Mail\Recepit($invoice, $request));
            return redirect()->route('admin.receipts.index')->with('success', 'Mail Sent successfully');
        }
        return redirect()->route('admin.receipts.index')->with('error', 'Mail cannot be sent email address not found');
    }

    public function store(StoreReceiptRequest $request)
    {
        $receipt = Receipt::create($request->all());

        return redirect()->route('admin.receipts.index');
    }

    public function edit(Receipt $receipt)
    {
        abort_if(Gate::denies('receipt_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $invoices = Invoice::pluck('invoice_number', 'id')->prepend(trans('global.pleaseSelect'), '');

        $receipt->load('invoice');

        return view('admin.receipts.edit', compact('invoices', 'receipt'));
    }

    public function update(UpdateReceiptRequest $request, Receipt $receipt)
    {
        
        $receipt->pending =  $request->pending;
        $receipt->received = $request->received;
        $receipt->save();

        return redirect()->route('admin.receipts.index');
    }

    public function show(Receipt $receipt)
    {
        abort_if(Gate::denies('receipt_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $receipt->load('invoice');

        return view('admin.receipts.show', compact('receipt'));
    }

    public function destroy(Receipt $receipt)
    {
        abort_if(Gate::denies('receipt_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $receipt->delete();

        return back();
    }

    public function massDestroy(MassDestroyReceiptRequest $request)
    {
        Receipt::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
