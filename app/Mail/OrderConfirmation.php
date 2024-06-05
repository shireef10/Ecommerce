<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class OrderConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public function build()
    {
        return $this
            ->subject('Order Confirmation')
            ->markdown('emails.order-confirmation')
            ->with(['message' => 'Thank you for your order!']);
    }
}
