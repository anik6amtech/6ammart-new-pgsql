<?php

namespace Modules\Service\Mail\ProviderModule;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Modules\Service\Entities\ProviderManagement\Provider;

class RegistrationApprovedMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected Provider $provider;

    public function __construct($provider)
    {
        $this->provider = $provider;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): static
    {
        return $this->subject(translate('Registration Approved'))->view('service::mail-templates.provider-module.registration-approved', ['provider' => $this->provider]);
    }
}
