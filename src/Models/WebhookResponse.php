<?php


namespace Dotlines\Foster\Models;
/**
 * After Foster pushes a webhook to your Webhook Receiving endpoint
 * And after you've done necessary processing for the webhook
 * Please prepare an object of this class
 * And send it as a valid response
 *
 * Class WebhookResponse
 * @package Dotlines\Foster\Models
 */

class WebhookResponse
{
    public string $message;

    public function __construct(string $message = 'successfully update')
    {
        $this->message = $message;
    }

    public function __toString(): string
    {
        return $this->message;
    }

}