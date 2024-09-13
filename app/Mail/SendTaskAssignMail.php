<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SendTaskAssignMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    private $_task_name;
    private $_task_actual_start_date;
    private $_task_actual_end_date;
    private $_task_detail;
    private $_first_name;
    private $_last_name;
    private $_client_name;
    private $_creator_name;
    private $_task_url;

    /**
     * Create a new message instance.
     *
     * @param $task_name タスク名
     * @param $task_actual_start_date 開始予定日
     * @param $task_actual_end_date 締切予定日
     * @param $task_detail 詳細
     * @param $first_name 名
     * @param $last_name 性
     * @param $task_url URL
     *
     * @return void
     */
    public function __construct($task_name, $task_actual_start_date, $task_actual_end_date, $task_detail, $first_name, $last_name, $client_name, $creator_name, $task_url)
    {
        $this->_task_name = $task_name;
        $this->_task_actual_start_date = $task_actual_start_date;
        $this->_task_actual_end_date = $task_actual_end_date;
        $this->_task_detail = $task_detail;
        $this->_first_name = $first_name;
        $this->_last_name = $last_name;
        $this->_client_name = $client_name;
        $this->_creator_name = $creator_name;
        $this->_task_url = $task_url;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        Log::channel('mail')->info('【MEMBER-S】タスクアサイン通知');

        return $this
            ->subject('【MEMBER-S】タスクアサイン通知')
            ->from(config('mail.from.address'), config('mail.from.name'))
            ->view('notification.email.task_assign')
            ->with(
                [
                'user_name' => $this->_last_name.' '.$this->_first_name,
                'task_name' => $this->_task_name,
                'task_actual_start_date' => $this->_task_actual_start_date,
                'task_actual_end_date' => $this->_task_actual_end_date,
                'task_detail' => $this->_task_detail,
                'client_name' => $this->_client_name,
                'creator_name' => $this->_creator_name,
                'task_url' => $this->_task_url,
                ]
            );
    }
}
