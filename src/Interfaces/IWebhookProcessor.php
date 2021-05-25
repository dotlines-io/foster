<?php


namespace Dotlines\Foster\Interfaces;
use Dotlines\Foster\Models\Webhook;
use Dotlines\Foster\Models\WebhookResponse;

/**
 * After Foster pushes a notification to your Webhook Receiving endpoint
 * Please prepare a webhook object from Webhook class
 * and pass it to your WebhookProcessor (extends this interface)
 *
 * Interface IWebhookProcessor
 * @package Dotlines\Foster\Interfaces
 */

interface IWebhookProcessor
{
    public function process(Webhook $notification, array $others = []): WebhookResponse;

}