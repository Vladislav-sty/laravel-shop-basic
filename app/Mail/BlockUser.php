<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BlockUser extends Mailable
{
    use Queueable, SerializesModels;

    protected $user;
    protected $cause;

    /**
     * @param $user
     * @param $cause
     */
    public function __construct($user, $cause)
    {
        $this->user = $user;
        $this->cause = $cause;
    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.blocked_user', [
            'user' => $this->user,
            'cause' => $this->cause
        ]);
    }
}
