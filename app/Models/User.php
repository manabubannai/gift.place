<?php
namespace App\Models;

use App\Mail\Auth\ResetPasswordMailable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
         'remember_token',
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
     * Override the mail body for reset password notification mail.
     */
    public function sendPasswordResetNotification($token)
    {
        $resetPasswordMailableContent = new ResetPasswordMailable($token, $this->name, $this->email);
        \MailHelper::send($this->email, $resetPasswordMailableContent);
    }
}
