<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SendTaskDeleteMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    private $_task_name;
    private $_task_delete_user;
    private $_first_name;
    private $_last_name;
    private $_task_url;
    private $_client_name;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($task_name, $task_delete_user, $first_name, $last_name, $client_name)
    {
        $this->_task_name = $task_name;
        $this->_task_delete_user = $task_delete_user;
        $this->_first_name = $first_name;
        $this->_last_name = $last_name;
        $this->_client_name = $client_name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        Log::channel('mail')->info('【MEMBER-S】タスク削除通知');

        return $this
            ->subject('【MEMBER-S】タスク削除通知')
            ->from(config('mail.from.address'), config('mail.from.name'))
            ->view('notification.email.task_delete')
            ->with(
                [
                'user_name' => $this->_last_name.' '.$this->_first_name,
                'task_name' => $this->_task_name,
                'task_delete_user' => $this->_task_delete_user,
                'client_name' => $this->_client_name,
                ]
            );
    }
}
