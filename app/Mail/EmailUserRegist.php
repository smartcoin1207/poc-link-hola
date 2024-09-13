<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class EmailUserRegist extends Mailable
{
    use Queueable;
    use SerializesModels;

    protected $client;

    /**
     * Create a new message instance.
     * クラス生成時にユーザ情報と新規パスワードを確保.
     *
     * @return void
     */
    public function __construct($client_name, $name, $name_kana, $mail, $login_id, $new_password)
    {
        $this->client_name = $client_name;
        $this->name = $name;
        $this->name_kana = $name_kana;
        $this->mail = $mail;
        $this->login_id = $login_id;
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
        Log::channel('mail')->info('【MEMBER-S】メンバー登録のお知らせ＜株式会社アイドマ・ホールディングス＞');

        // メールのタイトル・bladeファイル・変数をセット
        return $this
            ->subject('【MEMBER-S】メンバー登録のお知らせ＜株式会社アイドマ・ホールディングス＞')
            ->from(config('mail.from.address'), config('mail.from.name'))
            ->view('member.email.member_regist')
            ->with([
                'client_name' => $this->client_name,
                'name' => $this->name,
                'name_kana' => $this->name_kana,
                'mail' => $this->mail,
                'login_id' => $this->login_id,
                'new_password' => $this->new_password,
            ]);

        // return $this->view('view.name');
    }
}
