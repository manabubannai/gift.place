<?php
namespace App\Mail\Auth;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPasswordMailable extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     *
     * @return void
     */
    public function __construct(
        string $token,
        string $name,
        string $email
    ) {
        $this->token = $token;
        $this->name  = $name;
        $this->email = $email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $view    = 'emails.auth.reset-password';
        $subject = '【】パスワードリセット';

        $verificationUrl = $this->verificationUrl($this->token);

        return $this->view($view, [
            'link' => $verificationUrl,
        ])->subject($subject);
    }

    /**
     * @return string
     */
    protected function verificationUrl(string $token)
    {
        return 'test';
        // return route('user.password.reset', $token);
    }
}
