<?php

namespace App\Mail;

use App\Models\ITechGroup;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Throwable;

class AccountsCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $iTechGroup;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(ITechGroup $iTechGroup)
    {
        $this->iTechGroup = $iTechGroup;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.accounts_created')->subject('Welcome onboard - Account details')
            ->with(['message' => $this, 'savingsAccount' => $this->iTechGroup->savingsAccount()->first(), 'operationsAccount' =>
                $this->iTechGroup->operationsAccount()->first(), 'welfareAccount' =>
                $this->iTechGroup->welfareAccount()->first()]);

    }
}
