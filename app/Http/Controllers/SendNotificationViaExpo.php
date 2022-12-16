<?php

namespace App\Http\Controllers;

use App\Notifications\HelloNotification;
use Illuminate\Http\Request;
use YieldStudio\LaravelExpoNotifier\Dto\ExpoMessage;

class SendNotificationViaExpo extends Controller
{
    public function Hello()
    {
        (new ExpoMessage())
            ->to(["ExponentPushToken[MroVznDui3LluVogn7Y0Iu]"])
            ->title('A beautiful title')
            ->body('This is a content')
            ->channelId('default')
            ->shouldBatch();
    }
}
