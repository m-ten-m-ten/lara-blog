<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordNotification;
use Illuminate\Notifications\Messages\MailMessage;

class AdminPasswordResetNotification extends ResetPasswordNotification
{
    public function toMail($notifiable)
    {
        return (new MailMessage())->markdown('notifications.email')
            ->subject('【' . config('app.name') . '】管理者パスワードのリセットリンク通知')
            ->greeting('【' . config('app.name') . '】の管理者様')
            ->line('このメールは、パスワードリセットの申し込みをされた方に送信されています。')
            ->action('パスワードリセットページへ', url(config('app.url') . route('admin.reset', ['token' => $this->token, 'email' => $notifiable->getEmailForPasswordReset()], false)))
            ->line('もしパスワードリセットの申し込みをされていない場合、この通知は無視して下さい。');
    }
}
