<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class EmailMemberInvitation extends Mailable
{
    use Queueable;
    use SerializesModels;

    protected $client;

    /**
     * @return void
     */
    public function __construct($url, $client_name)
    {
        $this->url = $url;
        $this->client_name = $client_name;
    }

    /**
     * Build the message.
     * メール送信処理.
     *
     * @return $this
     */
    public function build()
    {
        Log::channel('mail')->info('【MEMBER-S】メンバー登録の招待');

        // メールのタイトル・bladeファイル・変数をセット
        return $this
            ->subject('【MEMBER-S】メンバー登録の招待')
            ->from(config('mail.from.address'), config('mail.from.name'))
            ->view('member.email.member_invitation')
            ->with([
                'url' => $this->url,
                'client_name' => $this->client_name,
            ]);
    }
}
