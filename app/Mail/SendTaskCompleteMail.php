<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SendTaskCompleteMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    private $taskName;
    private $taskEditUser;
    private $firstName;
    private $lastName;
    private $clientName;
    private $taskUrl;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($taskName, $taskEditUser, $firstName, $lastName, $clientName, $taskUrl)
    {
        $this->taskName = $taskName;
        $this->taskEditUser = $taskEditUser;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->clientName = $clientName;
        $this->taskUrl = $taskUrl;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        Log::channel('mail')->info('【MEMBER-S】タスク完了通知');

        return $this
            ->subject('【MEMBER-S】タスク完了通知')
            ->from(config('mail.from.address'), config('mail.from.name'))
            ->view('notification.email.task_complete')
            ->with([
                'user_name' => $this->lastName.' '.$this->firstName,
                'task_name' => $this->taskName,
                'task_edit_user' => $this->taskEditUser,
                'client_name' => $this->clientName,
                'task_url' => $this->taskUrl,
            ]);
    }
}
