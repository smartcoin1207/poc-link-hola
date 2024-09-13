<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SendUnReadChatNotificationMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    private $messages;

    /**
     * Create a new message instance.
     *
     * @param [array] $messages - 下記のキーを含むメッセージ情報（連想配列）の配列
     *          [string] roomName - ルーム（グループ）名
     *          [string] message - メッセージ本文
     *          [string] senderName - 送信者名
     * @param [string] $recipientName - 受信者名
     *
     * @return void
     */
    public function __construct($messages)
    {
        $this->messages = $messages;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // 件名
        $subject = \Lang::get('Bot.unread_mention_message_notification.subject');
        Log::channel('mail')->info($subject);

        return $this->subject($subject)
        ->from(config('mail.from.address'), config('mail.from.name'))
        ->view('notification.email.unread_chat_notification')
        ->with([
            'messages' => $this->messages,
        ]);
    }
}
