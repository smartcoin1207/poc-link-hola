<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

/**
 * ログイン画面経由での企業仮登録後、本登録案内メールを送信
 */
class EmailCompanyInvitation extends Mailable
{
    use Queueable;
    use SerializesModels;

    private $url;
    private $clientName;
    private $userName;

    /**
     * Create a new message instance.
     * クラスの作成時にユーザー情報と URL が保護されます。
     */
    public function __construct($url, $clientName, $userName)
    {
        $this->url = $url;
        $this->clientName = $clientName;
        $this->userName = $userName;
    }

    /**
     * Build the message.
     * メール送信処理.
     *
     * @return $this
     */
    public function build()
    {
        Log::channel('mail')->info('【MEMBER-S】企業招待のお知らせ');

        // メールのタイトル・bladeファイル・変数をセット
        return $this
            ->subject('【MEMBER-S】企業招待のお知らせ')
            ->from(config('mail.from.address'), config('mail.from.name'))
            ->view('client.email.company-invitation')
            ->with([
                'url' => $this->url,
                'clientName' => $this->clientName,
                'userName' => $this->userName,
            ]);
    }
}
