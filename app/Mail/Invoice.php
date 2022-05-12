<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Invoice extends Mailable
{
    use Queueable, SerializesModels;
    public $request;
    public $invoice;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($invoice, $request)
    {
        $this->invoice = $invoice;
        $this->request = $request;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->view('admin.emails.invoice' , ['invoice' =>$this->invoice, 'request' , $this->request] )
            ->subject("YALLA WRAP IT INVOICE")
            ->attach($this->request['pdf_file']->getRealPath(),
            [
                'as' => $this->request['pdf_file']->getClientOriginalName(),
                'mime' => $this->request['pdf_file']->getClientMimeType(),
            ]);
    }
}
