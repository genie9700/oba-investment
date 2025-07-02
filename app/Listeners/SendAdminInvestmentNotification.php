<?php

namespace App\Listeners;

use App\Events\NewInvestmentSubmitted;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendAdminInvestmentNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(NewInvestmentSubmitted $event): void
    {
        // This is where you would send an email to the admin.
        // For example:
        // Mail::to('admin@cryptane-bitcoininvestment.com')
        //     ->send(new AdminNewInvestmentMail($event->deposit));
        
        // For now, we can just log that it was handled.
        \Illuminate\Support\Facades\Log::info(
            'New investment submitted: Deposit ID ' . $event->deposit->id
        );
    }
}