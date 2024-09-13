<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SendQuestionnaireAnswerMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    protected int $client_id;
    protected string $client_name;
    protected string $login_id;
    protected string $user_name;
    protected string $answer;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(int $client_id, string $client_name, string $login_id, string $user_name, string $answer)
    {
        $this->client_id = $client_id;
        $this->client_name = $client_name;
        $this->login_id = $login_id;
        $this->user_name = $user_name;
        $this->answer = $answer;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        Log::channel('mail')->info('【MEMBER-S】アンケートの回答がありました');

        // メールのタイトル・bladeファイル・変数をセット
        return $this
            ->subject('【MEMBER-S】アンケートの回答がありました')
            ->from(config('mail.from.address'), config('mail.from.name'))
            ->view('admin.email.send_questionnaire_answer')
            ->with([
                'client_id' => $this->client_id,
                'client_name' => $this->client_name,
                'login_id' => $this->login_id,
                'user_name' => $this->user_name,
                'answer' => $this->answer,
            ]);
    }
}
