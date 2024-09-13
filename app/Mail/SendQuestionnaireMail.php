<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SendQuestionnaireMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    protected string $client_name;
    protected string $user_name;

    /** @var array<int, string> */
    protected array $answers;
    /** @var array<int, string> */
    protected array $urls;

    /**
     * Create a new message instance.
     *
     * @param string $client_name クライアント名
     * @param string $user_name ユーザー名
     * @param array<int, string> $answers アンケートの回答テキスト
     * @param array<int, string> $urls アンケートの回答URL
     *
     * @return void
     */
    public function __construct(string $client_name, string $user_name, array $answers, array $urls)
    {
        $this->client_name = $client_name;
        $this->user_name = $user_name;
        $this->answers = $answers;
        $this->urls = $urls;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        Log::channel('mail')->info('【アンケートのご協力について】(株)アイドマ・ホールディングスです');

        // メールのタイトル・bladeファイル・変数をセット
        return $this
            ->subject('【アンケートのご協力について】(株)アイドマ・ホールディングスです')
            ->from(config('mail.from.address'), config('mail.from.name'))
            ->view('admin.email.send_questionnaire')
            ->with([
                'client_name' => $this->client_name,
                'user_name' => $this->user_name,
                'answers' => $this->answers,
                'urls' => $this->urls,
            ]);
    }
}
