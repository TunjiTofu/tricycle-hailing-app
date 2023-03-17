<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UpdateLocation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'location:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Riders Location';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $request = Request::create('http://localhost/rider/updatetripevent', 'GET');

        $response = app()->handle($request);
        // dd($response);
        $responseBody = $response->getContent();

        print($responseBody. PHP_EOL);
        $this->info('location:update route has been dispatched successfully');
        
        // if($response->failed()){
        //     $errorMsg = ["message"=> 'Error Updating Location'];
        //     print($errorMsg . PHP_EOL);
        // }

        // print($responseBody. PHP_EOL);

        return Command::SUCCESS;

    }
}
