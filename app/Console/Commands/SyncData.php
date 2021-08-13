<?php

namespace App\Console\Commands;

use App\Models\Data;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class SyncData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'syncData';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Syncs feed data from IO Adafruit';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try{
            //get the latest entry
            $last_entry=Data::orderBy("created_time","desc")->first();
            $last_entry_time=null;

            //if a last entry is available
            if (is_object($last_entry)){
                //create a time object of the last entry time
                $time=Carbon::createFromTimestamp($last_entry->created_time);

                //a control measure adding a second to the time
                $time->addSecond();

                //reformat the time
                $last_entry_time=$time->format('Y-m-d\T H:i:s\Z');
            }

            //initialise http client
            $client=new Client();

            //api call
            $response=$client->get("https://io.adafruit.com/api/v2/kunozga/feeds/status/data",[
                //query parameters -> set limit to 1000 data points and query based on last entry
                'query'     =>  ['limit' => 1000,'start_time'=>$last_entry_time],
                'headers'   =>[
                    'Content-Type'      =>  'application/json',
                    'X-AIO-Key'         =>  env('ADAFRUIT_IO_KEY')
                ]
            ]);

            //when successful
            if ($response->getStatusCode()==200){

                //decoding json content
                $feeds=json_decode($response->getBody()->getContents());

                //store each new feed
                foreach ($feeds as $feed){
                    //converting feed value from json string to json object
                    $liftInfo=$this->convertToJson($feed->value);

                    //convert ISO Format date to timestamp
                    //$created_time=Carbon::createFromFormat('Y-m-d\TH:i:s\Z',$feed->created_at)->getTimestamp();

                    //Store feed into database
                    Data::create([
                        'key'            =>  $feed->id,
                        'status'         =>  $liftInfo->status,
                        'current'        =>  $liftInfo->current,
                        'voltage'        =>  $liftInfo->voltage,
                        'speed'          =>  $liftInfo->speed,
                        'created_time'   =>  $feed->created_epoch,
                    ]);
                }
            }
        }catch ( GuzzleException $exception){
            Log::debug("Error: $exception");
        }

        return 0;
    }

    /*
   * Function converts a json string to an object
   */
    private function convertToJson(String $value){
        return json_decode(str_replace('\'','"',$value));
    }
}
