<?php

/** @noinspection PhpComposerExtensionStubsInspection */
/** @noinspection SpellCheckingInspection */

namespace Dotlines\Foster\Tests;

use Dotlines\Foster\ChargeRequest;
use Dotlines\Foster\StatusRequest;
use JsonException;
use PHPUnit\Framework\TestCase;

class StatusRequestTest extends TestCase
{
    public string $charge_request_url = "https://demo.fosterpayments.com.bd/fosterpayments/paymentrequest.php";
    public string $status_request_url = "https://demo.fosterpayments.com.bd/fosterpayments/TransactionStatus/txstatus.php";
    public string $mcnt_AccessCode = "190331053509";
    public string $mcnt_ShortName = "FosterTest";
    public int $mcnt_ShopId = 104;
    public string $secretkey = "b5b50bcefaa3140c5775ed49469983da";
    public string $mcnt_TxnNo = 'test_';
    public string $mcnt_Amount = "100";
    public string $mcnt_Currency = 'BDT';
    public string $cust_InvoiceTo = '01111111111';
    public string $cust_CustomerServiceName = 'Endowment Insurance service';
    public string $cust_CustomerName = 'TestCustomer';
    public string $cust_CustomerEmail = 'info@carnivalassure.com.bd';
    public string $cust_CustomerAddress = 'Dhaka';
    public string $cust_CustomerContact = '01111111111';
    public string $cust_CustomerCity = 'Dhaka';
    public string $cust_CustomerState = 'dhaka';
    public string $cust_CustomerPostcode = "1224";
    public string $cust_CustomerCountry = 'Bangladesh';
    public string $cust_Billingaddress = 'Bangladesh';
    public string $cust_ShippingAddress = 'Bangladesh';
    public string $cust_orderitems = '21314';
    public string $success_url = 'http://localhost/test.php';
    public string $cancel_url = 'http://localhost/test.php';
    public string $fail_url = 'http://localhost/test.php';
    public string $merchentdomainname = 'carnivalassure.com.bd';
    public string $merchentip = 'carnivalassure.com.bd';

    /**
     * @test
     * @throws JsonException
     */
    final public function it_fetches_payment_status(): void
    {
        $this->mcnt_TxnNo .= random_int(1111111111, 9999999999) . '_kalage';
        $chargeRequest = ChargeRequest::getInstance(
            $this->charge_request_url,
            $this->mcnt_AccessCode,
            $this->mcnt_ShortName,
            $this->mcnt_ShopId,
            $this->secretkey,
            $this->mcnt_TxnNo,
            $this->mcnt_Amount,
            $this->mcnt_Currency,
            $this->cust_InvoiceTo,
            $this->cust_CustomerServiceName,
            $this->cust_CustomerName,
            $this->cust_CustomerEmail,
            $this->cust_CustomerAddress,
            $this->cust_CustomerContact,
            $this->cust_CustomerCity,
            $this->cust_CustomerState,
            $this->cust_CustomerPostcode,
            $this->cust_CustomerCountry,
            $this->cust_Billingaddress,
            $this->cust_ShippingAddress,
            $this->cust_orderitems,
            $this->success_url,
            $this->cancel_url,
            $this->fail_url,
            $this->merchentdomainname,
            $this->merchentip
        );
        $chargeRequest->send();

        $statusRequest = StatusRequest::getInstance($this->status_request_url, $this->mcnt_TxnNo, $this->secretkey);
        $statusRequestResponse = $statusRequest->send();
        self::assertNotEmpty($statusRequestResponse);

        self::assertArrayHasKey('Status', $statusRequestResponse[0]);
        self::assertArrayHasKey('MerchantTxnNo', $statusRequestResponse[0]);
        self::assertArrayHasKey('message', $statusRequestResponse[0]);

        self::assertNotEmpty($statusRequestResponse[0]['Status']);
        self::assertNotEmpty($statusRequestResponse[0]['MerchantTxnNo']);
        self::assertNotEmpty($statusRequestResponse[0]['message']);
    }

    /**
     * @test
     * @throws JsonException
     */
    final public function it_fails_with_invalid_trxno(): void
    {
        $this->mcnt_TxnNo .= random_int(1111111111, 9999999999) . '_kalage';
        $statusRequest = StatusRequest::getInstance($this->status_request_url, $this->mcnt_TxnNo, $this->secretkey);
        $statusRequestResponse = $statusRequest->send();
        self::assertNotEmpty($statusRequestResponse);

        self::assertArrayHasKey('Status', $statusRequestResponse[0]);
        self::assertArrayHasKey('MerchantTxnNo', $statusRequestResponse[0]);
        self::assertArrayHasKey('message', $statusRequestResponse[0]);

        self::assertTrue($statusRequestResponse[0]['Status'] >= 400);
        self::assertEmpty($statusRequestResponse[0]['fosterid']);
        self::assertEmpty($statusRequestResponse[0]['TxnResponse']);
    }
}
