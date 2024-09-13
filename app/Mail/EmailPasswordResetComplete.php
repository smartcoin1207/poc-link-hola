<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class EmailPasswordResetComplete extends Mailable
{
    use Queueable;
    use SerializesModels;

    /**
     * @var \Illuminate\Database\Eloquent\Collection<\App\Models\User>
     */
    private $passwordResetUsers;
    private string $username;
    private string $newPassword;

    /**
     * Create a new message instance.
     * クラス生成時にユーザ情報と新規パスワードを確保.
     *
     * @param \Illuminate\Database\Eloquent\Collection<\App\Models\User> $passwordResetUsers
     *
     * @return void
     */
    public function __construct($passwordResetUsers, string $username, string $newPassword)
    {
        $this->passwordResetUsers = $passwordResetUsers;
        $this->username = $username;
        $this->newPassword = $newPassword;
    }

    /**
     * Build the message.
     * メール送信処理.
     *
     * @return $this
     */
    public function build()
    {
        Log::channel('mail')->info('【MEMBER-S】パスワード変更のお知らせ');

        return $this
            ->subject('【MEMBER-S】パスワード変更のお知らせ')
            ->from(config('mail.from.address'), config('mail.from.name'))
            ->view('auth.email.password-reset-complete')
            ->with([
                'passwordResetUsers' => $this->passwordResetUsers,
                'username' => $this->username,
                'newPassword' => $this->newPassword,
            ]);
    }
}
