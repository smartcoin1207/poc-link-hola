<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class EmailUsagePromotion extends Mailable
{
    use Queueable;
    use SerializesModels;

    protected $user;

    /**
     * @var int
     */
    protected $days;

    /**
     * Create a new message instance.
     *
     * @param int $days
     *
     * @return void
     */
    public function __construct($user, $days)
    {
        $this->user = $user;
        $this->days = $days;
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
            ->view('reminder.email.promotion_html', [
                'user' => $this->user,
                'days' => $this->days,
            ])
            ->text('reminder.email.promotion_text', [
                'user' => $this->user,
                'days' => $this->days,
            ]);
    }
}
