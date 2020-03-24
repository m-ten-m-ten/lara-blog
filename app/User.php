<?php

namespace App;

use App\Notifications\UserPasswordResetNotification;
use App\Notifications\UserVerifyEmailNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'status', 'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
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
        $this->notify(new UserPasswordResetNotification($token));
    }

    /**
     * メール確認の送信
     */
    public function sendEmailVerificationNotification(): void
    {
        $this->notify(new UserVerifyEmailNotification());
    }

    /**
     * A user has many messages
     */
    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    /**
     * ユーザーの一覧を取得（プルダウン用）
     */
    public static function getUserList()
    {
        return static::latest()->pluck('name', 'id');
    }

    /*
     * Boot
     * モデルの「イベント」の利用の勉強用。
     * ユーザー削除処理時、削除直前に発生する「deleting」イベントにて、そのユーザーへのメッセージも削除。
     */
    // protected static function boot(): void
    // {
    //     parent::boot();

    //     static::deleting(function ($user): void {
    //         $user->messages()->delete();
    //     });
    // }
}
