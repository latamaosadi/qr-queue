<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class QueueNoticeMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    protected $name;
    protected $queueNumber;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $queueNumber)
    {
        $this->name = $name;
        $this->queueNumber = $queueNumber;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.queue_notice')
            ->subject('BPJAMSOSTEK - Konfirmasi Nomor Antrian')
            ->with([
                'name' => $this->name,
                'queueNumber' => $this->queueNumber,
            ]);
    }
}
