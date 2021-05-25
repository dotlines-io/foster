<?php


namespace Dotlines\Foster\Models;

/**
 * You will provide an API endpoint to Foster
 * After that Foster will start pushing notifications to this API endpoint
 *
 * How to use:
 * After Foster pushes a notification to your Notification Receiving endpoint
 * Please prepare a notification object from this class
 * and pass it to your NotificationProcessor
 *
 * Class Webhook
 * @package Dotlines\Foster\Models
 */

class Webhook
{
    public string $merchantTxnNo;
    public string $txnResponse;
    public string $txnAmount;
    public string $currency;
    public string $convertionRate;
    public string $orderNo;
    public string $fosterId;
    public string $hashkey;

    public function __construct(string $merchantTxnNo, string $txnResponse, string $txnAmount, string $currency, string $convertionRate, string $orderNo, string $fosterId, string $hashkey)
    {
        $this->merchantTxnNo = $merchantTxnNo;
        $this->txnResponse = $txnResponse;
        $this->txnAmount = $txnAmount;
        $this->currency = $currency;
        $this->convertionRate = $convertionRate;
        $this->orderNo = $orderNo;
        $this->fosterId = $fosterId;
        $this->hashkey = strtolower($hashkey);
    }
}
