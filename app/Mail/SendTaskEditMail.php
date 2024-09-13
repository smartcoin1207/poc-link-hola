<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SendTaskEditMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    private $_task_name;
    private $_task_edit_user;
    private $_first_name;
    private $_last_name;
    private $_client_name;
    private $_task_url;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($task_name, $task_edit_user, $first_name, $last_name, $client_name, $task_url)
    {
        $this->_task_name = $task_name;
        $this->_task_edit_user = $task_edit_user;
        $this->_first_name = $first_name;
        $this->_last_name = $last_name;
        $this->_client_name = $client_name;
        $this->_task_url = $task_url;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        Log::channel('mail')->info('【MEMBER-S】今日のタスク通知');

        return $this
            ->subject('【MEMBER-S】タスク編集通知')
            ->from(config('mail.from.address'), config('mail.from.name'))
            ->view('notification.email.task_edit')
            ->with(
                [
                'user_name' => $this->_last_name.' '.$this->_first_name,
                'task_name' => $this->_task_name,
                'task_edit_user' => $this->_task_edit_user,
                'client_name' => $this->_client_name,
                'task_url' => $this->_task_url,
                ]
            );
    }
}
