<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
// use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class EmailPasswordReset extends Mailable
{
    use Queueable;
    use SerializesModels;

    protected $user;

    /**
     * Create a new message instance.
     * クラス生成時にユーザ情報と新規パスワードを確保.
     *
     * @return void
     */
    public function __construct($user, $new_password)
    {
        $this->user = $user;
        $this->new_password = $new_password;
    }

    /**
     * Build the message.
     * メール送信処理.
     *
     * @return $this
     */
    public function build()
    {
        Log::channel('mail')->info('【MEMBER-S】パスワード再発行のお知らせ');

        // メールのタイトル・bladeファイル・変数をセット
        return $this
            ->subject('【MEMBER-S】パスワード再発行のお知らせ')
            ->from(config('mail.from.address'), config('mail.from.name'))
            ->view('auth.email.password_reset')
            ->with([
                'ar_user' => $this->user,
                'new_password' => $this->new_password,
            ]);

        // return $this->view('view.name');
    }
}
