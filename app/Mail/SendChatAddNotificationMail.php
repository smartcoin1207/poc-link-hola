<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SendChatAddNotificationMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    private $roomName;
    private $fromName;

    /**
     * Create a new message instance.
     *
     * @param string $fromName - 招待者名
     * @param string $roomName - ルーム（グループ）名
     *
     * @return void
     */
    public function __construct($fromName, $roomName)
    {
        $this->fromName = $fromName;
        $this->roomName = $roomName;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // 件名
        $subject = \Lang::get('Bot.chat_add_notification.subject');
        Log::channel('mail')->info($subject);

        return $this->subject($subject)
        ->from(config('mail.from.address'), config('mail.from.name'))
        ->view('notification.email.chat_add_notification')
        ->with([
            'fromName' => $this->fromName,
            'roomName' => $this->roomName,
        ]);
    }
}
