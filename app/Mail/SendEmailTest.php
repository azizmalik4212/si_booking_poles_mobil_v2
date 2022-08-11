<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;



class SendEmailTest extends Mailable

{

    use Queueable, SerializesModels;

    protected $details;

    /**

     * Create a new message instance.

     *

     * @return void

     */

    public function __construct($details)

    {

        $this->details = $details;

    }



    /**

     * Build the message.

     *

     * @return $this

     */

    public function build()

    {
        if ($this->details['type_message'] == 'PAID')
            return $this->view('emails.test',$this->details);
        else if ($this->details['type_message'] == 'RESET_PASSORD')
            return $this->view('emails.ganti_password',$this->details);

    }

}
