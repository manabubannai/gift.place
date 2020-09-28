<?php
namespace App\Helpers;

use Illuminate\Support\Facades\Mail;

class MailHelper
{
    public function send($to, $sendContent)
    {
        if (config('app.env') === 'production') {
            Mail::to($to)->send($sendContent);

            $content = view($sendContent->build()->view, $sendContent->build()->viewData)->render();
            \Log::debug('TO: '.$to.' | Subject: '.$sendContent->build()->subject.' | Content: '.$content);
        }

        if (config('app.env') !== 'production') {
            $content = view($sendContent->build()->view, $sendContent->build()->viewData)->render();
            \Log::debug('TO: '.$to.' | Subject: '.$sendContent->build()->subject.' | Content: '.$content);
        }
    }
}
