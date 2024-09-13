<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class EmailPasswordResetConfirmation extends Mailable
{
    use Queueable;
    use SerializesModels;

    private string $username;
    private string $url;

    /**
     * Create a new message instance.
     * クラス生成時にユーザ情報と新規パスワードを確保.
     *
     * @return void
     */
    public function __construct(string $username, string $url)
    {
        $this->username = $username;
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
        Log::channel('mail')->info('【MEMBER-S】パスワード再発行確認メール');

        return $this
            ->subject('【MEMBER-S】パスワード再設定手続きのお知らせ')
            ->from(config('mail.from.address'), config('mail.from.name'))
            ->view('auth.email.password-reset-confirmation')
            ->with([
                'username' => $this->username,
                'url' => $this->url,
            ]);
    }
}
