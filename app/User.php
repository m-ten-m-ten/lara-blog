<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;

class User extends Authenticatable
{
    use Notifiable;
    use Billable;

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
     * A user has many messages
     */
    public function messages()
    {
        return $this->hasMany('App\Message');
    }

    /**
     * ユーザーの一覧を取得（プルダウン用）
     */
    public static function getUserList()
    {
        return static::latest()->pluck('name', 'id');
    }

    /**
     * Boot
     */
    protected static function boot(): void
    {
        parent::boot();

        static::deleting(function ($user): void {
            $user->messages()->delete();
        });
    }
}
