<?php

namespace App\Jobs;

use App\Developer;
use Illuminate\Bus\Queueable;
use App\Mail\DeveloperCreated;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ProcessEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $developerId;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(int $developerId)
    {
        $this->developerId = $developerId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $developer = Developer::find($this->developerId);
        Mail::to('hagoodem@gmail.com')->send(new DeveloperCreated($developer));
    }
}
