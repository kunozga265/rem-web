<?php

namespace App\Http\Controllers;

use App\Events\ActivityEvent;
use App\Http\Resources\EventResource;
use App\Models\Event;
use Illuminate\Http\Request;
use Inertia\Inertia;

class EventController extends Controller
{
    public function index()
    {
        $events=Event::orderBy('start_time','desc')->limit(7)->get();

        return Inertia::render('Dashboard',[
            'statusInfo'           =>  $events->isNotEmpty()?$events->first()->status:null,
            'eventsData'           =>  EventResource::collection($events),
        ]);
    }
    public function events()
    {
        $events=Event::orderBy('start_time','desc')->get();

        /*$normal=[];
        $off=[];
        $fault=[];
        $now=Carbon::now()->getTimestamp();

        foreach ($events as $event){
            if($event->status==0){
                array_push($off,[
                    'x' =>  'OFF',
                    'y' =>  [
                        ($event->start_time)*1000,
                        ($event->end_time?$event->end_time:$now)*1000
                    ]
                ]);
            }else if ($event->status==1){
                array_push($normal,[
                    'x' =>  'NORMAL',
                    'y' =>  [
                        ($event->start_time)*1000,
                        ($event->end_time?$event->end_time:$now)*1000
                    ]
                ]);
            }else{
                array_push($fault,[
                    'x' =>  'FAULT',
                    'y' =>  [
                        ($event->start_time)*1000,
                        ($event->end_time?$event->end_time:$now)*1000
                    ]
                ]);
            }
        }*/



        return Inertia::render('Events',[
            /*'normal_series'    =>  $normal,
            'off_series'       =>  $off,
            'fault_series'     =>  $fault,*/
            'eventsData'           =>  EventResource::collection($events),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'status'=>'required'
        ]);

        $last_entry=Event::orderBy("start_time","desc")->first();
        if (is_object($last_entry)) {
            $last_entry->update([
                'end_time'  =>  time()
            ]);
        }

        $event=new Event([
            'status'         =>  $request->status,
            'start_time'     =>  time()
        ]);

        if ($request->status==2){
            $event->fault_code=$request->fault_code;
        }

        $event->save();

        ActivityEvent::dispatch(new EventResource($event));

        return response()->json([],200);

    }
}
