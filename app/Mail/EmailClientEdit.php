<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class EmailClientEdit extends Mailable
{
    use Queueable;
    use SerializesModels;

    protected $client;
    protected $formattedClientName;

    /**
     * Create a new message instance.
     * クラス生成時にユーザ情報と新規パスワードを確保.
     *
     * @return void
     */
    public function __construct($client, $member_name, $clientName)
    {
        $this->client = $client;
        $this->member_name = $member_name;
        $this->formattedClientName = $clientName;
    }

    /**
     * Build the message.
     * メール送信処理.
     *
     * @return $this
     */
    public function build()
    {
        Log::channel('mail')->info('【MEMBER-S】企業情報変更のお知らせ');

        // メールのタイトル・bladeファイル・変数をセット
        return $this
            ->subject('【MEMBER-S】企業情報変更のお知らせ')
            ->from(config('mail.from.address'), config('mail.from.name'))
            ->view('admin.email.client_edit')
            ->with([
                'name' => $this->formattedClientName,
                'name_kana' => $this->client->name_kana,
                'post_code' => $this->client->post_code,
                'address' => $this->client->address,
                'tel' => $this->client->tel,
                'member_name' => $this->member_name,
                'mail' => $this->client->mail,
            ]);
    }
}
