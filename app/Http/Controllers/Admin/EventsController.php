<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyEventRequest;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Mail\Invoice;
use App\Models\Event;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;


class EventsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('event_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $events = DB::table('events')->get();
        return view('admin.events.index', compact('events'));
    }
    public function create()
    {
        abort_if(Gate::denies('event_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin.events.create');
    }

    public function store(Request $request)
    {
        $event = new Event();
        $invoice = \App\Models\Invoice::where('invoice_number', $request->invoice)->first();
        $event->title = $invoice->customer_name . '(' . $invoice->complete_address . ')';
        $event->start = $request->start;
        $event->end = $request->end;
        $event->model_name = $invoice->id;
        $event->color = $request->color;
        $event->model = $request->invoice;
        if ($request->employees) {
            $event->employees = json_encode($request->employees);
        }
        $event->description = $request->description;
        $event->save();

        return redirect()->route('admin.events.index');
    }

    public function edit(Event $event)
    {
        abort_if(Gate::denies('event_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $event->start = $request->start;
        $event->end = $request->end;
        $event->color = $request->color;
        if ($request->invoice) {
            $event->model = $request->invoice;
            $invoice = \App\Models\Invoice::where('invoice_number', $request->invoice)->first();
            $event->title = $invoice->customer_name . '(' . $invoice->complete_address . ')';
            $event->model_name = $invoice->id;
        }
        if ($request->employees) {
            $event->employees = json_encode($request->employees);
        }
        $event->description = $request->description;
        $event->save();

        return redirect()->route('admin.events.index');
    }
    public function show(Event $event)
    {
        abort_if(Gate::denies('event_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.events.show', compact('event'));
    }

    public function destroy(Event $event)
    {
        abort_if(Gate::denies('event_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $event->delete();

        return back();
    }
   public function remove(Request $request)
    {
      $event =  Event::where('id', '=', $request->id)->first();
      $event->delete();
      return back()->with('success','Event removed');
    }

    public function massDestroy(MassDestroyEventRequest $request)
    {
        Event::whereIn('id', request('ids'))->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }


    public function updateAjax(Request $request)
    {
        $event = Event::find($request->id);
        $event->start = $request->start;
        $event->end = $request->end;
        $event->color = $request->color;
        if ($request->invoice) {
            $event->model = $request->invoice;
            $invoice = \App\Models\Invoice::where('invoice_number', $request->invoice)->first();
            $event->title = $invoice->customer_name . '(' . $invoice->complete_address . ')';
            $event->model_name = $invoice->id;
        }
        if ($request->employees) {
            $event->employees = json_encode($request->employees);
        }
        $event->description = $request->description;
        $event->save();
        return response()->json([
            'status' => 200,
            'message' => 'success',
        ], 200);

    }

    public function addAjax(Request $request)
    {
        $event = new Event();
        $invoice = \App\Models\Invoice::where('invoice_number', $request->invoice)->first();
        $event->title = $invoice->customer_name . '(' . $invoice->complete_address . ')';
        $event->start = $request->start;
        $event->end = $request->end;
        $event->model_name = $invoice->id;
        $event->color = $request->color;
       $event->model = $request->invoice;
        if ($request->employees) {
            $event->employees = json_encode($request->employees);
        }
        $event->description = $request->description;
        $event->save();
        return response()->json([
            'status' => 200,
            'message' => 'success',
        ], 200);
    }
}
