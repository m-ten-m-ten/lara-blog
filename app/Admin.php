<?php

namespace App;

use App\Notifications\AdminPasswordResetNotification;
use App\Notifications\AdminVerifyEmailNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    protected $guarded = [];

    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * パスワードリセット通知の送信
     *
     * @param string $token
     */
    public function sendPasswordResetNotification($token): void
    {
        $this->notify(new AdminPasswordResetNotification($token));
    }

    /**
     * メール確認の送信
     */
    public function sendEmailVerificationNotification(): void
    {
        $this->notify(new AdminVerifyEmailNotification());
    }
}
