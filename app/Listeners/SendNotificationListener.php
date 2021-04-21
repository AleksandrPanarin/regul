<?php

namespace App\Listeners;

use App\Events\SmsErrorEvent;
use App\Jobs\SendNotificationError;

class SendNotificationListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param SmsErrorEvent $event
     * @return void
     */
    public function handle(SmsErrorEvent $event)
    {
        SendNotificationError::dispatch($event->getData());
    }
}
