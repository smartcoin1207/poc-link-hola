<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SendTodayTaskMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    private $_tasks;
    private $_plans_end_times;
    private $_first_name;
    private $_last_name;
    private $_tasks_url;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($tasks, $plans_end_times, $urls, $first_name, $last_name)
    {
        $this->_tasks = $tasks;
        $this->_plans_end_times = $plans_end_times;
        $this->_first_name = $first_name;
        $this->_last_name = $last_name;
        $this->_tasks_url = $urls;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // タスクがない場合に表示するメッセージ取得
        $noTaskMessage = \Lang::get('Bot.no_task_today_message');
        $settingDesc = \Lang::get('Bot.notification_setting_desc_mail');
        // ?page=botはBOT通知設定ページを表示するために付与
        $settingUrl = route('bot.setting').'?page=bot';

        Log::channel('mail')->info('【MEMBER-S】今日のタスク通知');

        return $this
            ->subject('【MEMBER-S】今日のタスク通知')
            ->from(config('mail.from.address'), config('mail.from.name'))
            ->view('notification.email.task_today')
            ->with(
                [
                'user_name' => $this->_last_name.' '.$this->_first_name,
                'tasks' => $this->_tasks,
                'times' => $this->_plans_end_times,
                'urls' => $this->_tasks_url,
                'no_task_message' => $noTaskMessage,
                'setting_desc' => $settingDesc,
                'setting_url' => $settingUrl,
                ]
            );
    }
}
