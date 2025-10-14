<?php

namespace Modules\Service\Mail\BusinessSettingsModule;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Modules\Service\Entities\ProviderManagement\Provider;

class RenewSubscriptionMail extends Mailable
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
        return $this->subject(translate('Subscription Plan Renewed!'))->view('service::mail-templates.business-settings-module.renew-subscription', ['provider' => $this->provider]);
    }
}
