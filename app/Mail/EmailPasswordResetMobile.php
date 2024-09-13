<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class EmailPasswordResetMobile extends Mailable
{
    use Queueable;
    use SerializesModels;
    protected $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $new_password, $clients_name)
    {
        $this->user = $user;
        $this->new_password = $new_password;
        $this->clients_name = $clients_name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        Log::channel('mail')->info('【MEMBER-S】パスワード再発行のお知らせ');

        return $this
        ->subject('【MEMBER-S】パスワード再発行のお知らせ')
        ->from(config('mail.from.address'), config('mail.from.name'))
        ->view('auth.email.password_reset_mobile')
        ->with([
            'username' => $this->user->last_name.' '.$this->user->first_name,
            'new_password' => $this->new_password,
            'clients_name' => $this->clients_name,
        ]);
    }
}
