<?php

namespace App\Listeners;

use App\Mail\Confirmation;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendConfirmationMessage
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $receipt = $event->receipt;
        $email = $receipt->customer->email;

        Mail::to($email)->send(new Confirmation($receipt));
    }
}
