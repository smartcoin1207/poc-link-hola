<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SendTaskCommentMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    private $_task_name;
    private $_task_actual_start_date;
    private $_task_actual_end_date;
    private $_task_plans_end_date;
    private $_task_status;
    private $_task_comment_date;
    private $_task_comment;
    private $_first_name;
    private $_last_name;
    private $_task_url;
    private $_from_first_name;
    private $_from_last_name;
    private $_client_name;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(
        $task_name,
        $task_actual_start_date,
        $task_actual_end_date,
        $task_plans_end_date,
        $task_status,
        $task_comment_date,
        $task_comment,
        $first_name,
        $last_name,
        $task_url,
        $from_first_name,
        $from_last_name,
        $client_name
    ) {
        $this->_task_name = $task_name;
        $this->_task_actual_start_date = $task_actual_start_date;
        $this->_task_actual_end_date = $task_actual_end_date;
        $this->_task_plans_end_date = $task_plans_end_date;
        $this->_task_status = $task_status;
        $this->_task_comment_date = $task_comment_date;
        $this->_task_comment = $task_comment;
        $this->_first_name = $first_name;
        $this->_last_name = $last_name;
        $this->_task_url = $task_url;
        $this->_from_first_name = $from_first_name;
        $this->_from_last_name = $from_last_name;
        $this->_client_name = $client_name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        Log::channel('mail')->info('【MEMBER-S】タスクコメント追加通知');

        return $this
            ->subject('【MEMBER-S】タスクコメント追加通知')
            ->from(config('mail.from.address'), config('mail.from.name'))
            ->view('notification.email.task_comment')
            ->with(
                [
                'user_name' => $this->_last_name.' '.$this->_first_name,
                'task_name' => $this->_task_name,
                'task_actual_start_date' => $this->_task_actual_start_date,
                'task_actual_end_date' => $this->_task_actual_end_date,
                'task_plans_end_date' => $this->_task_plans_end_date,
                'task_status' => $this->_task_status,
                'task_comment_date' => $this->_task_comment_date,
                'task_comment' => $this->_task_comment,
                'task_url' => $this->_task_url,
                'from_name' => $this->_from_last_name.' '.$this->_from_first_name,
                'client_name' => $this->_client_name,
                ]
            );
    }
}
