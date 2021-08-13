<?php

namespace App\Http\Controllers;

use App\Events\ActivityEvent;
use App\Http\Resources\EventResource;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;
use Inertia\Inertia;

class EventController extends Controller
{
    public function index()
    {
        $events=Event::orderBy('start_time','desc')->limit(7)->get();
        $normal=[];
        $off=[];
        $fault=[];
        $now=Carbon::now()->getTimestamp();

//        foreach ($events as $event){
//            if($event->status==0){
//                array_push($off,[
//                    'x' =>  'OFF',
//                    'y' =>  [
//                        ($event->start_time)*1000,
//                        ($event->end_time?$event->end_time:$now)*1000
//                    ]
//                ]);
//            }else if ($event->status==1){
//                array_push($normal,[
//                    'x' =>  'NORMAL',
//                    'y' =>  [
//                        ($event->start_time)*1000,
//                        ($event->end_time?$event->end_time:$now)*1000
//                    ]
//                ]);
//            }else{
//                array_push($fault,[
//                    'x' =>  'FAULT',
//                    'y' =>  [
//                        ($event->start_time)*1000,
//                        ($event->end_time?$event->end_time:$now)*1000
//                    ]
//                ]);
//            }
//        }



        return Inertia::render('Dashboard',[
            'latest_event'     =>  $events->first(),
            'eventsData'           =>  EventResource::collection($events),
            'normal_series'    =>  $normal,
            'off_series'       =>  $off,
            'fault_series'     =>  $fault,
        ]);
    }
    public function events()
    {
        $events=Event::orderBy('start_time','desc')->get();
        $normal=[];
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
        }



        return Inertia::render('Events',[
            'latest_event'     =>  $events->first(),
            'eventsData'           =>  EventResource::collection($events),
            'normal_series'    =>  $normal,
            'off_series'       =>  $off,
            'fault_series'     =>  $fault,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'status'=>'required'
        ]);

        $now=Carbon::now('Africa/Blantyre')->getTimestamp();

        $last_entry=Event::orderBy("start_time","desc")->first();
        if (is_object($last_entry)) {
            $last_entry->update([
                'end_time'  =>  $now
            ]);
        }

        $event=new Event([
            'status'         =>  $request->status,
            'start_time'    =>  $now
        ]);

        if ($request->status==2){
            $event->error_code=$request->error_code;
        }

        $event->save();

//        Broadcast::channel('events', function ($user){
////            return Auth::check();
//            return true;
//        });

        ActivityEvent::dispatch(new EventResource($event));

        return response()->json([$event],200);

    }
}
