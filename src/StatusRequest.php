<?php

/** @noinspection SpellCheckingInspection */

namespace Dotlines\Foster;

use Dotlines\Core\Request;

class StatusRequest extends Request
{
    public static function getInstance(string $url, string $mcnt_TxnNo, string $secretkey): StatusRequest
    {
        return new StatusRequest($url, $mcnt_TxnNo, $secretkey);
    }

    /**
     * StatusRequest constructor.
     * @param string $url
     * @param string $mcnt_TxnNo
     * @param string $secretkey
     */
    private function __construct(string $url, string $mcnt_TxnNo, string $secretkey)
    {
        $this->requestMethod = 'GET';
        $this->url = $url . '?' . http_build_query(['mcnt_TxnNo' => $mcnt_TxnNo, 'mcnt_SecureHashValue' => md5($secretkey . $mcnt_TxnNo)]);
    }

    final public function params(): array
    {
        return [];
    }
}
