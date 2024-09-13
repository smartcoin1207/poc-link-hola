<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class EmailLoginReminder extends Mailable
{
    use Queueable;
    use SerializesModels;

    /**
     * @var \App\Models\NeverLoginUser
     */
    protected $user;

    /**
     * @var string
     */
    protected $password;

    /**
     * @var string
     */
    protected $wp_token;

    /**
     * Create a new message instance.
     *
     * @param \App\Models\NeverLoginUser $user
     * @param string $password
     * @param string $wp_token
     *
     * @return void
     */
    public function __construct($user, $password, $wp_token)
    {
        $this->user = $user;
        $this->password = $password;
        $this->wp_token = $wp_token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        Log::channel('mail')->info('【MEMBER-S】ご活用状況のお知らせ');

        return $this
            ->subject('【MEMBER-S】ご活用状況のお知らせ')
            ->from(config('mail.from.address'), config('mail.from.name'))
            ->view('reminder.email.login_html', [
                'user' => $this->user,
                'password' => $this->password,
                'wp_token' => $this->wp_token,
            ])
            ->text('reminder.email.login_text', [
                'user' => $this->user,
                'password' => $this->password,
            ]);
    }
}
