<?php

/** @noinspection GlobalVariableUsageInspection */
/** @noinspection PhpComposerExtensionStubsInspection */
/** @noinspection SpellCheckingInspection */

namespace Dotlines\Foster\Tests;

use Dotenv\Dotenv;
use Dotlines\Foster\ChargeRequest;
use Dotlines\Foster\StatusRequest;
use JsonException;
use PHPUnit\Framework\TestCase;

class StatusRequestTest extends TestCase
{
    protected $backupStaticAttributes = false;
    protected $runTestInSeparateProcess = false;

    public string $charge_request_url = "";
    public string $status_request_url = "";
    public string $mcnt_AccessCode = "";
    public string $mcnt_ShortName = "";
    public int $mcnt_ShopId = 0;
    public string $secretkey = "";

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
    public string $gateway = '';
    public string $card_type = '';

    final public function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        Dotenv::createImmutable(__DIR__ . '\\..')->safeLoad();

        $this->charge_request_url = (array_key_exists('server_url', $_ENV) ? (string)$_ENV['server_url'] : (string)getenv('SERVER_URL')) . '/fosterpayments/paymentrequest.php';
        $this->status_request_url = (array_key_exists('server_url', $_ENV) ? (string)$_ENV['server_url'] : (string)getenv('SERVER_URL')) . '/fosterpayments/TransactionStatus/txstatus.php';
        $this->mcnt_AccessCode = array_key_exists('mcnt_AccessCode', $_ENV) ? (string)$_ENV['mcnt_AccessCode'] : (string)getenv('MCNT_ACCESSCODE');
        $this->mcnt_ShortName = array_key_exists('mcnt_ShortName', $_ENV) ? (string)$_ENV['mcnt_ShortName'] : (string)getenv('MCNT_SHORTNAME');
        $this->mcnt_ShopId = array_key_exists('mcnt_ShopId', $_ENV) ? (int)$_ENV['mcnt_ShopId'] : (int)getenv('MCNT_SHOPID');
        $this->secretkey = array_key_exists('secretkey', $_ENV) ? (string)$_ENV['secretkey'] : (string)getenv('SECRETKEY');
    }

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
            (float)$this->mcnt_Amount,
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
            $this->merchentip,
            $this->gateway,
            $this->card_type
        );
        $chargeRequest->send();

        $statusRequest = StatusRequest::getInstance($this->status_request_url, $this->mcnt_TxnNo, $this->secretkey);
        $statusRequestResponse = $statusRequest->send();
        self::assertNotEmpty($statusRequestResponse);

        $response_data = (array)$statusRequestResponse[0];

        self::assertArrayHasKey('Status', $response_data);
        self::assertArrayHasKey('MerchantTxnNo', $response_data);
        self::assertArrayHasKey('message', $response_data);

        self::assertNotEmpty($response_data['Status']);
        self::assertNotEmpty($response_data['MerchantTxnNo']);
        self::assertNotEmpty($response_data['message']);
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

        $response_data = (array)$statusRequestResponse[0];

        self::assertArrayHasKey('Status', $response_data);
        self::assertArrayHasKey('MerchantTxnNo', $response_data);
        self::assertArrayHasKey('message', $response_data);

        self::assertTrue($response_data['Status'] >= 400);
        self::assertEmpty($response_data['fosterid']);
        self::assertEmpty($response_data['TxnResponse']);
    }
}
