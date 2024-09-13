<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

/**
 * ログイン画面経由での企業仮登録後、本登録案内メールを送信
 */
class EmailClientRegistration extends Mailable
{
    use Queueable;
    use SerializesModels;

    protected $url;

    /**
     * @param string
     *
     * @return void
     */
    public function __construct($url)
    {
        $this->url = $url;
    }

    /**
     * Build the message.
     * メール送信処理.
     *
     * @return $this
     */
    public function build()
    {
        Log::channel('mail')->info('【MEMBER-S】企業登録手続きのご案内');

        // メールのタイトル・bladeファイル・変数をセット
        return $this
            ->subject('【MEMBER-S】企業登録手続きのご案内')
            ->from(config('mail.from.address'), config('mail.from.name'))
            ->view('client.email.client-registration')
            ->with([
                'url' => $this->url,
            ]);
    }
}
