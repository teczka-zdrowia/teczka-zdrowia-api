<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserInitialized extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The userdata instance.
     *
     * @var User $user
     * @var string $userPassword
     */
    public $user;
    public $userPassword;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $userPassword)
    {
        $this->user = $user;
        $this->userPassword = $userPassword;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.users.initialized')->subject('Specjalista utworzył twoje konto');
    }
}
