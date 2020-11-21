<?php

namespace App\Commands;

use App\Http\RequestInterface;
use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;

class RequestCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'droid:navigate
                            {name : Your name or nickname (required)}
                            {path : A path for droids, passed as string (required)}';

    /**
     * The description of the command.
     *
     * @var string
     */
     protected $description = 'API controlled droid movements';


     private $client;

    /**
     * Instantiates the request interface class.
     *
     * @var RequestInterface
     */
    public function __construct(RequestInterface $client)
    {
        $this->client = $client;

        parent::__construct();
    }


    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $apiResponse = $this->client->getRequest(
            strtolower($this->argument('name')),
            strtolower($this->argument('path'))
        );

        $this->line(sprintf(
           $apiResponse
        ));
    }

    /**
     * Define the command's schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    public function schedule(Schedule $schedule): void
    {
        // $schedule->command(static::class)->everyMinute();
    }
}
