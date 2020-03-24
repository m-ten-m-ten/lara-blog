<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\URL;

class UserVerifyEmailNotification extends Notification
{
    /**
     * The callback that should be used to build the mail message.
     *
     * @var null|\Closure
     */
    public static $toMailCallback;

    /**
     * Get the notification's channels.
     *
     * @return array|string
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Build the mail representation of the notification.
     *
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $verificationUrl = $this->verificationUrl($notifiable);

        if (static::$toMailCallback) {
            return \call_user_func(static::$toMailCallback, $notifiable, $verificationUrl);
        }

        return (new MailMessage())->markdown('notifications.email')
            ->subject('【' . config('app.name') . '】メールアドレスの確認')
            ->greeting('【' . config('app.name') . '】ご利用者様')
            ->line('下記のボダンをクリックして、メールアドレスの確認を完了してください。下記ボタンの有効期限は、当メールの送信より1時間となっております。')
            ->action('メールアドレスを確認', $verificationUrl)
            ->line('当メールに心当たりが無い場合には、本メールを破棄して下さい。');
    }

    /**
     * Set a callback that should be used when building the notification mail message.
     *
     * @param \Closure $callback
     */
    public static function toMailUsing($callback): void
    {
        static::$toMailCallback = $callback;
    }

    /**
     * Get the verification URL for the given notifiable.
     *
     * @return string
     */
    protected function verificationUrl($notifiable)
    {
        return URL::temporarySignedRoute(
            'user.verification.verify',
            Carbon::now()->addMinutes(Config::get('auth.verification.expire', 60)),
            [
                'id'   => $notifiable->getKey(),
                'hash' => \sha1($notifiable->getEmailForVerification()),
            ]
        );
    }
}
