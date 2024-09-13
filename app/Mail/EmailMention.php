<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class EmailMention extends Mailable
{
    use Queueable;
    use SerializesModels;

    private string $name;
    private string $chatMessage;
    private ?string $roomName;
    private string $loginId;

    /**
     * Create a new message instance.
     * クラス生成時にユーザ情報を確保.
     *
     * @return void
     */
    public function __construct(
        string $fromUserName,
        string $message,
        ?string $roomName,
        string $loginId
    ) {
        $this->name = $fromUserName;
        $this->chatMessage = $message;
        $this->roomName = $roomName;
        // loginIdを受け取る
        $this->loginId = $loginId;
    }

    /**
     * Build the message.
     * メール送信処理.
     *
     * @return $this
     */
    public function build()
    {
        // 件名
        $subject = __('Bot.unread_mention_message_notification.subject');
        // 本文
        $content = __('Bot.unread_mention_message_notification.content');
        // 「あなた」を「あなた（login_id）」にする
        $content = str_replace('あなた', 'あなた（ID：'.$this->loginId.'）', $content);
        // 項目名（グループ）
        $itemGroup = __('Bot.unread_mention_message_notification.group');
        // 項目名（メッセージ）
        $itemMessage = __('Bot.unread_mention_message_notification.message');
        // 項目名 (備考)
        $itemRemarks = __('Bot.unread_mention_message_notification.remarks');
        $loginManualText = __('Bot.unread_mention_message_notification.login_manual_text');
        $loginManualUrl = __('Bot.unread_mention_message_notification.login_manual_url');
        $notificationManualText = __('Bot.unread_mention_message_notification.notification_manual_text');
        $notificationManualUrl = __('Bot.unread_mention_message_notification.notification_manual_url');

        // チャットページURL
        $chatUrl = config('app.url').'/chat';

        Log::channel('mail')->info($subject);

        return $this
            ->subject($subject)
            ->from(config('mail.from.address'), config('mail.from.name'))
            ->view('chat.email.mention')
            ->with([
                'name' => $this->name,
                'chat_message' => $this->chatMessage,
                'room_name' => $this->roomName,
                'content' => $content,
                'item_group' => $itemGroup,
                'item_message' => $itemMessage,
                'item_remarks' => $itemRemarks,
                'chat_url' => $chatUrl,
                'login_manual_text' => $loginManualText,
                'login_manual_url' => $loginManualUrl,
                'notification_manual_text' => $notificationManualText,
                'notification_manual_url' => $notificationManualUrl,
            ]);
    }
}
