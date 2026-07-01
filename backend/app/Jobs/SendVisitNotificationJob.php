<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use App\Models\Visit;
use App\Notifications\VisitCreatedNotification;

class SendVisitNotificationJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public int $visitId
    )
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $visit = Visit::with('visitor')->find($this->visitId);

        if (!$visit) 
        {
            return;
        }        

        $visit->visitor->notify(
            new VisitCreatedNotification($visit)
        );
    }
}
