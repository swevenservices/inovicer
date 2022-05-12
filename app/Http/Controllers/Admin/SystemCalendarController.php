<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class SystemCalendarController extends Controller
{
    public function index()
    {
        $events = [];
        $eventsDB = DB::table('events')->get();
        foreach ($eventsDB as $event) {
            $events[] = [
                'id' => $event->id,
                'title' => $event->title,
                'start' => $event->start,
                'description' => $event->description,
                'end' => $event->end,
                'color' => $event->color,
                'url' => "",
            ];
        }
        return view('admin.calendar.calendar', compact('events'));
    }

    public function ajaxData()
    {
        $events = [];
        $eventsDB = DB::table('events')->get();
        foreach ($eventsDB as $event) {
            $events[] = [
                'id' => $event->id,
                'title' =>  $event->title . ' working : ' . $event->employees,
                's_title' => $event->title,
                'start' => $event->start,
                'model' => $event->model_name,
                'invoice' => $event->model,
                'description' => $event->description,
                'end' => $event->end,
                'employees' => $event->employees,
                'color' => $event->color,
                'url' => "",
            ];
        }
        return response()->json($events);
    }
}
