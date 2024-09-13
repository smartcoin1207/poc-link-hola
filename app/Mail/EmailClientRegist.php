<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class EmailClientRegist extends Mailable
{
    use Queueable;
    use SerializesModels;

    protected $client;
    protected $member_name;
    protected $formattedClientName;
    protected $login_id;
    protected $password;

    /**
     * Create a new message instance.
     * クラス生成時にユーザ情報と新規パスワードを確保.
     *
     * @return void
     */
    public function __construct($client, $member_name, $clientName, $login_id, $password)
    {
        $this->client = $client;
        $this->member_name = $member_name;
        $this->formattedClientName = $clientName;
        $this->login_id = $login_id;
        $this->password = $password;
    }

    /**
     * Build the message.
     * メール送信処理.
     *
     * @return $this
     */
    public function build()
    {
        Log::channel('mail')->info('【MEMBER-S】ユーザー登録のお知らせ＜株式会社アイドマ・ホールディングス＞');

        // メールのタイトル・bladeファイル・変数をセット
        return $this
            ->subject('【MEMBER-S】ユーザー登録のお知らせ＜株式会社アイドマ・ホールディングス＞')
            ->from(config('mail.from.address'), config('mail.from.name'))
            ->view('admin.email.client_regist')
            ->with([
                'name' => $this->formattedClientName,
                'name_kana' => $this->client->name_kana,
                'post_code' => $this->client->post_code,
                'address' => $this->client->address,
                'tel' => $this->client->tel,
                'member_name' => $this->member_name,
                'mail' => $this->client->mail,
                'login_id' => $this->login_id,
                'password' => $this->password,
            ]);
    }
}
