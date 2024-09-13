<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class EmailClientApply extends Mailable
{
    use Queueable;
    use SerializesModels;

    protected $client;
    protected $formattedClientName;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($client, $clientName)
    {
        $this->client = $client;
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
        $personName = $this->client->last_name.' '.$this->client->first_name;

        Log::channel('mail')->info('【MEMBER-S】企業登録お申込受付のお知らせ');

        // メールのタイトル・bladeファイル・変数をセット
        return $this
            ->subject('【MEMBER-S】企業登録お申込受付のお知らせ')
            ->from(config('mail.from.address'), config('mail.from.name'))
            ->view('client.email.client-apply')
            ->with([
                'name' => $this->formattedClientName,
                'name_kana' => $this->client->name_kana,
                'post_code' => $this->client->post_code,
                'address' => $this->client->address,
                'tel' => $this->client->tel,
                'person_name' => $personName,
            ]);
    }
}
