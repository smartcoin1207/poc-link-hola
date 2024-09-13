<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class EmailRequestAgreement extends Mailable
{
    use Queueable;
    use SerializesModels;

    // protected $user_id;

    private $user_id;
    private $user_name;
    private $agreement_id;
    private $client_name;

    /**
     * Create a new message instance.
     * クラス生成時にユーザ情報.
     *
     * @return void
     */
    public function __construct($user_id, $user_name, $agreement_id, $client_name)
    {
        $this->user_id = $user_id;
        $this->user_name = $user_name;
        $this->agreement_id = $agreement_id;
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
        Log::channel('mail')->info('【対応依頼】契約書送付通知メール');

        // メールのタイトル・bladeファイル・変数をセット
        return $this
            ->subject('【対応依頼】契約書送付通知メール')
            ->from(config('mail.from.address'), config('mail.from.name'))
            ->view('admin.email.request_agreement')
            ->with([
                'user_name' => $this->user_name,
                'user_id' => $this->user_id,
                'agreement_id' => $this->agreement_id,
                'agreement_url' => url('/member/'.$this->user_id.'/agreement/'.$this->agreement_id),
                'client_name' => $this->client_name,
            ]);
    }
}
