<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class EmailUserEdit extends Mailable
{
    use Queueable;
    use SerializesModels;

    protected $client;

    /**
     * Create a new message instance.
     * クラス生成時にユーザ情報を確保.
     *
     * @return void
     */
    public function __construct($name, $name_kana, $post_code, $address, $tel, $mail, $employment_type_name, $role_name, $note, $custom_items, $custom_data_array)
    {
        $this->name = $name;
        $this->name_kana = $name_kana;
        $this->post_code = $post_code;
        $this->address = $address;
        $this->tel = $tel;
        $this->mail = $mail;
        $this->employment_type_name = $employment_type_name;
        $this->role_name = $role_name;
        $this->note = $note;
        $this->custom_items = $custom_items;
        $this->custom_data_array = $custom_data_array;
    }

    /**
     * Build the message.
     * メール送信処理.
     *
     * @return $this
     */
    public function build()
    {
        Log::channel('mail')->info('【MEMBER-S】メンバー情報変更のお知らせ');

        // メールのタイトル・bladeファイル・変数をセット
        return $this
            ->subject('【MEMBER-S】メンバー情報変更のお知らせ')
            ->from(config('mail.from.address'), config('mail.from.name'))
            ->view('member.email.member_edit')
            ->with([
                'name' => $this->name,
                'name_kana' => $this->name_kana,
                'post_code' => $this->post_code,
                'address' => $this->address,
                'tel' => $this->tel,
                'mail' => $this->mail,
                'employment_type_name' => $this->employment_type_name,
                'role_name' => $this->role_name,
                'note' => $this->note,
                'custom_items' => $this->custom_items,
                'custom_data_array' => $this->custom_data_array,
            ]);

        // return $this->view('view.name');
    }
}
