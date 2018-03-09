<?php

namespace App\Listeners;

use App\Events\ReceiptWasConfirmed;
use App\Mail\Code;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendDiscountCode
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(ReceiptWasConfirmed $event)
    {
        $receipt = $event->receipt;
        $email = $receipt->customer->email;

        Mail::to($email)->send(new Code($receipt));
    }
}
