<?php

namespace App;

use App\Notifications\UserPasswordResetNotification;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
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
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
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
