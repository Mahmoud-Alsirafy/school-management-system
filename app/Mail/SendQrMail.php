<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class SendQrMail extends Mailable
{
    use Queueable, SerializesModels;

    public $filePath;
    public $nationality_id;
    public $user;

    public function __construct($filePath, $nationality_id,$user)
    {
        $this->filePath = $filePath;
        $this->nationality_id = $nationality_id;
        $this->user = $user;
    }

    public function build()
    {
        return $this->subject('QR Code للمريض')
            ->view('pages.QR_Code.Show')
            ->attach(storage_path('app/' . $this->filePath));
    }
}
