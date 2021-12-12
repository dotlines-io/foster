<?php

/** @noinspection SpellCheckingInspection */

namespace Dotlines\Foster;

use Dotlines\Core\Request;

class ChargeRequest extends Request
{
    private string $mcnt_AccessCode;
    private string $mcnt_ShortName;
    private string $secretkey;
    private int $mcnt_ShopId;
    private string $mcnt_TxnNo;
    private float $mcnt_Amount;
    private string $mcnt_Currency;
    private string $cust_InvoiceTo;
    private string $cust_CustomerServiceName;
    private string $cust_CustomerName;
    private string $cust_CustomerEmail;
    private string $cust_CustomerAddress;
    private string $cust_CustomerContact;
    private string $cust_CustomerCity;
    private string $cust_CustomerState;
    private string $cust_CustomerPostcode;
    private string $cust_CustomerCountry;
    private string $cust_Billingaddress;
    private string $cust_ShippingAddress;
    private string $cust_orderitems;
    private string $success_url;
    private string $cancel_url;
    private string $fail_url;
    private string $merchentdomainname;
    private string $merchentip;
    /**
     * @var string|null
     */
    private string $gateway;
    /**
     * @var string|null
     */
    private string $card_type;

    /**
     * @param string $charge_request_url
     * @param string $mcnt_AccessCode
     * @param string $mcnt_ShortName
     * @param int $mcnt_ShopId
     * @param string $secretkey
     * @param string $mcnt_TxnNo
     * @param float $mcnt_Amount
     * @param string $mcnt_Currency
     * @param string $cust_InvoiceTo
     * @param string $cust_CustomerServiceName
     * @param string $cust_CustomerName
     * @param string $cust_CustomerEmail
     * @param string $cust_CustomerAddress
     * @param string $cust_CustomerContact
     * @param string $cust_CustomerCity
     * @param string $cust_CustomerState
     * @param string $cust_CustomerPostcode
     * @param string $cust_CustomerCountry
     * @param string $cust_Billingaddress
     * @param string $cust_ShippingAddress
     * @param string $cust_orderitems
     * @param string $success_url
     * @param string $cancel_url
     * @param string $fail_url
     * @param string $merchentdomainname
     * @param string $merchentip
     * @param string $gateway
     * @param string $card_type
     * @return ChargeRequest
     */
    public static function getInstance(
        string $charge_request_url,
        string $mcnt_AccessCode,
        string $mcnt_ShortName,
        int $mcnt_ShopId,
        string $secretkey,
        string $mcnt_TxnNo,
        float $mcnt_Amount,
        string $mcnt_Currency,
        string $cust_InvoiceTo,
        string $cust_CustomerServiceName,
        string $cust_CustomerName,
        string $cust_CustomerEmail,
        string $cust_CustomerAddress,
        string $cust_CustomerContact,
        string $cust_CustomerCity,
        string $cust_CustomerState,
        string $cust_CustomerPostcode,
        string $cust_CustomerCountry,
        string $cust_Billingaddress,
        string $cust_ShippingAddress,
        string $cust_orderitems,
        string $success_url,
        string $cancel_url,
        string $fail_url,
        string $merchentdomainname,
        string $merchentip,
        string $gateway = NULL,
        string $card_type = NULL

    ): ChargeRequest
    {
        return new ChargeRequest(
            $charge_request_url,
            $mcnt_AccessCode,
            $mcnt_ShortName,
            $mcnt_ShopId,
            $secretkey,
            $mcnt_TxnNo,
            $mcnt_Amount,
            $mcnt_Currency,
            $cust_InvoiceTo,
            $cust_CustomerServiceName,
            $cust_CustomerName,
            $cust_CustomerEmail,
            $cust_CustomerAddress,
            $cust_CustomerContact,
            $cust_CustomerCity,
            $cust_CustomerState,
            $cust_CustomerPostcode,
            $cust_CustomerCountry,
            $cust_Billingaddress,
            $cust_ShippingAddress,
            $cust_orderitems,
            $success_url,
            $cancel_url,
            $fail_url,
            $merchentdomainname,
            $merchentip,
            $gateway,
            $card_type
        );
    }

    private function __construct(
        string $charge_request_url,
        string $mcnt_AccessCode,
        string $mcnt_ShortName,
        int $mcnt_ShopId,
        string $secretkey,
        string $mcnt_TxnNo,
        float $mcnt_Amount,
        string $mcnt_Currency,
        string $cust_InvoiceTo,
        string $cust_CustomerServiceName,
        string $cust_CustomerName,
        string $cust_CustomerEmail,
        string $cust_CustomerAddress,
        string $cust_CustomerContact,
        string $cust_CustomerCity,
        string $cust_CustomerState,
        string $cust_CustomerPostcode,
        string $cust_CustomerCountry,
        string $cust_Billingaddress,
        string $cust_ShippingAddress,
        string $cust_orderitems,
        string $success_url,
        string $cancel_url,
        string $fail_url,
        string $merchentdomainname,
        string $merchentip,
        string $gateway,
        string $card_type
    )
    {
        $this->requestMethod = 'POST';
        $this->url = $charge_request_url;
        $this->mcnt_AccessCode = $mcnt_AccessCode;
        $this->mcnt_ShortName = $mcnt_ShortName;
        $this->mcnt_ShopId = $mcnt_ShopId;
        $this->secretkey = $secretkey;
        $this->mcnt_TxnNo = $mcnt_TxnNo;
        $this->mcnt_Amount = $mcnt_Amount;
        $this->mcnt_Currency = $mcnt_Currency;
        $this->cust_InvoiceTo = $cust_InvoiceTo;
        $this->cust_CustomerServiceName = $cust_CustomerServiceName;
        $this->cust_CustomerName = $cust_CustomerName;
        $this->cust_CustomerEmail = $cust_CustomerEmail;
        $this->cust_CustomerAddress = $cust_CustomerAddress;
        $this->cust_CustomerContact = $cust_CustomerContact;
        $this->cust_CustomerCity = $cust_CustomerCity;
        $this->cust_CustomerState = $cust_CustomerState;
        $this->cust_CustomerPostcode = $cust_CustomerPostcode;
        $this->cust_CustomerCountry = $cust_CustomerCountry;
        $this->cust_Billingaddress = $cust_Billingaddress;
        $this->cust_ShippingAddress = $cust_ShippingAddress;
        $this->cust_orderitems = $cust_orderitems;
        $this->success_url = $success_url;
        $this->cancel_url = $cancel_url;
        $this->fail_url = $fail_url;
        $this->merchentdomainname = $merchentdomainname;
        $this->merchentip = $merchentip;
        $this->gateway = $gateway;
        $this->card_type = $card_type;
    }

    final public function params(): array
    {
        $request_params = [
            'mcnt_ShortName' => $this->mcnt_ShortName,
            'mcnt_ShopId' => $this->mcnt_ShopId,
            'mcnt_TxnNo' => $this->mcnt_TxnNo,
            'mcnt_OrderNo' => $this->mcnt_TxnNo,
            'mcnt_Amount' => $this->mcnt_Amount,
            'mcnt_Currency' => $this->mcnt_Currency,
            'cust_InvoiceTo' => $this->cust_InvoiceTo,
            'cust_CustomerServiceName' => $this->cust_CustomerServiceName,
            'cust_CustomerName' => $this->cust_CustomerName,
            'cust_CustomerEmail' => $this->cust_CustomerEmail,
            'cust_CustomerAddress' => $this->cust_CustomerAddress,
            'cust_CustomerContact' => $this->cust_CustomerContact,
            'cust_CustomerCity' => $this->cust_CustomerCity,
            'cust_CustomerState' => $this->cust_CustomerState,
            'cust_CustomerPostcode' => $this->cust_CustomerPostcode,
            'cust_CustomerCountry' => $this->cust_CustomerCountry,
            'cust_Billingaddress' => $this->cust_Billingaddress,
            'cust_ShippingAddress' => $this->cust_ShippingAddress,
            'cust_orderitems' => $this->cust_orderitems,
            'success_url' => $this->success_url,
            'cancel_url' => $this->cancel_url,
            'fail_url' => $this->fail_url,
            'merchentdomainname' => $this->merchentdomainname,
            'merchentip' => $this->merchentip,
            'mcnt_SecureHashValue' => $this->makeMerchantHash(),
        ];
        if(!empty($this->gateway)){
            $request_params['GW'] = $this->gateway;
        }
        if(!empty($this->card_type)){
            $request_params['CardType'] = $this->card_type;
        }

        return $request_params;
    }

    private function makeMerchantHash(): string
    {
        $urlparamForHash = http_build_query([
            'mcnt_AccessCode' => $this->mcnt_AccessCode,
            'mcnt_TxnNo' => $this->mcnt_TxnNo, //Ymdhmsu//PNR
            'mcnt_ShortName' => $this->mcnt_ShortName,
            'mcnt_OrderNo' => $this->mcnt_TxnNo,
            'mcnt_ShopId' => (string)$this->mcnt_ShopId,
            'mcnt_Amount' => $this->mcnt_Amount,
            'mcnt_Currency' => 'BDT',
        ]);

        return hash_hmac('SHA256', $urlparamForHash, strtoupper($this->secretkey));
    }
}
