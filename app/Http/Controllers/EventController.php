<?php

namespace App\Http\Controllers;

use App\Events\ActivityEvent;
use App\Http\Resources\EventResource;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Swift_Mailer;
use Swift_Message;
use Swift_SmtpTransport;

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

        $this->sendEmail($event);

        return response()->json([],200);

    }

    private function sendEmail(Event $event){

        switch ($event->status){
            case 0:
                $status="OFF";
                break;
            case 1:
                $status="NORMAL";
                break;
            default:
                $status="FAULT - $event->fault_code";
        }

        $data=[
            'email'         =>  'dummy@email.com',
            'subject'       =>  'The Polytechnic Lift - Status Update',
            'bodyMessage'   =>  "STATUS: <strong>$status</strong>",
            'date'          =>  $this->formatDate($event->start_time)
        ];


        // Create the Transport
        $transport = (new Swift_SmtpTransport(env("MAIL_HOST"), env("MAIL_PORT"),env("MAIL_ENCRYPTION")))
            ->setUsername(env("MAIL_USERNAME"))
            ->setPassword(env("MAIL_PASSWORD"))
        ;

        // Create the Mailer using your created Transport
        $mailer = new Swift_Mailer($transport);

        // Create a message
        $message = (new Swift_Message($data['subject']))
            ->setFrom($data['email'])
            ->setTo(['kunozmlowoka@gmail.com'])
            ->setBody("<p>$data[bodyMessage]</p><p>As of $data[date]</p>",'text/html')
        ;

        // Send the message
        try{
            $result = $mailer->send($message);
            //if successful
            if($result==1)
                return response()->json(['response' => true]);
            else
                return response()->json(['response' => false]);
        }catch (\Swift_TransportException $exception){
            return response()->json(['response' => false,'status'=>$exception]);
        }
    }

    private function formatDate($timestamp){
        return Carbon::createFromTimestamp($timestamp,'Africa/Blantyre')->format("M d, Y H:i");
    }
}
