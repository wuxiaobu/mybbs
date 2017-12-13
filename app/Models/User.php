<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\ResetPassword;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Mail;

class User extends Authenticatable implements CanResetPasswordContract
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','introduction','avatar','activation_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function topics()
    {
        return $this->hasMany(Topic::class);
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));

        /*$to = '1594989692@qq.com';
        $subject = "感谢注册Mybbs！请确认你的邮箱。";
        Mail::send('emails.confirm', [],
            function ($message) use ($to, $subject) {
            $message
            ->from(env('MAIL_USERNAME'), env('MAIL_FROM_NAME'))
            ->to($to)
            ->subject($subject);
        });*/
    }
}
