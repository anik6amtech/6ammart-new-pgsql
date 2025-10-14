<?php

namespace Modules\Service\Mail\BusinessSettingsModule;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\Service\Entities\ProviderManagement\Provider;

class CashInHandOverflowMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected Provider $provider;
    public function __construct(Provider $provider)
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
        return $this->subject(translate('Cash in hand overflow'))->view('service::mail-templates.business-settings-module.cash-in-hand', ['provider' => $this->provider]);
    }
}
