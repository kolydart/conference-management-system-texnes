<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ErrorNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $errorMessage;
    public $context;

    /**
     * Create a new message instance.
     *
     * @param string $errorMessage
     * @param string $context
     * @return void
     */
    public function __construct($errorMessage, $context = 'System Error')
    {
        $this->errorMessage = $errorMessage;
        $this->context = $context;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // Get the first Admin user's email as sender (role_id = 1)
        try {
            $adminRole = \App\Role::find(1);
            $adminUser = $adminRole ? \App\User::where('role_id', 1)->first() : null;
            $fromEmail = $adminUser ? $adminUser->email : config('mail.from.address');
            $fromName = $adminUser ? $adminUser->name : config('mail.from.name');
        } catch (\Exception $e) {
            $fromEmail = config('mail.from.address');
            $fromName = config('mail.from.name');
        }

        return $this->from($fromEmail, $fromName)
                    ->subject('System Error Notification - ' . $this->context)
                    ->view('emails.error-notification')
                    ->with([
                        'errorMessage' => $this->errorMessage,
                        'context' => $this->context,
                        'timestamp' => now()->format('Y-m-d H:i:s')
                    ]);
    }
}
