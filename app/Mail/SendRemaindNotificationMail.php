<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SendRemaindNotificationMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    private $_task_name;
    private $_task_state;
    private $_task_end_date;
    private $_first_name;
    private $_last_name;
    private $_task_url;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($task_name, $task_state, $task_end_date, $first_name, $last_name, $task_url)
    {
        $this->_task_name = $task_name;
        $this->_task_state = $task_state;
        $this->_task_end_date = $task_end_date;
        $this->_first_name = $first_name;
        $this->_last_name = $last_name;
        $this->_task_url = $task_url;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        Log::channel('mail')->info('【MEMBER-S】タスク定期通知');

        return $this
            ->subject('【MEMBER-S】タスク定期通知')
            ->from(config('mail.from.address'), config('mail.from.name'))
            ->view('notification.email.task_remaind_notification')
            ->with(
                [
                'user_name' => $this->_last_name.' '.$this->_first_name,
                'task_name' => $this->_task_name,
                'task_status' => $this->_task_state,
                'plans_end_date' => $this->_task_end_date,
                'task_url' => $this->_task_url,
                ]
            );
    }
}
