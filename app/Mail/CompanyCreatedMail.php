<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Company;

class CompanyCreatedMail extends GenericMail
{
    use Queueable, SerializesModels;

    /**
     * @var Company
     */
    public $company;

    /**
     * Create a new message instance.
     * @param Company $company
     * @return void
     */
    public function __construct(Company $company)
    {
        $this->company = $company;
        parent::__construct();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.company-created')->from('zmattme@gmail.com', 'Matas')
            ->subject('Your company has been registered')
            ->text('emails.company-created-plain');
    }
}
