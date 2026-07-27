<?php

namespace App\Mail;

use App\Models\Voucher;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VoucherNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $voucher;
    public $isUpdate;

    public function __construct(Voucher $voucher, $isUpdate = false)
    {
        $this->voucher = $voucher;
        $this->isUpdate = $isUpdate;
    }

    public function envelope(): Envelope
    {
        $subject = $this->isUpdate 
            ? 'Pemberitahuan: Pembaruan Voucher Diskon ' . $this->voucher->code 
            : 'Voucher Baru Tersedia: Klaim ' . $this->voucher->code . ' Sekarang!';

        return new Envelope(subject: $subject);
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.voucher_notification', // Kita akan buat file view ini di langkah berikutnya
        );
    }
}