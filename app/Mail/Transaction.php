<?php

namespace App\Mail;

use App\EmailTemplate;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Auth;
class Transaction extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    protected $head;
    protected $body;
    public function __construct($subject, $body)
    {
//        $this->emailTemplate = [
//            'subject' => 'Transaction Successful',
//            'content' => 'Your transaction has been successful.'
//        ];

//        if($emailTemplate !== null){
//
//        }
        $this->head = $subject;
        $this->body = $body;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env('MAIL_FROM_ADDRESS'), env('APP_NAME'))
            ->subject($this->head)
            ->view('emailTemplate')->with([
            'customer_name' => Auth::user()->name,
            'body' => $this->body
        ]);
    }
}
