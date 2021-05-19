# Foster Payment Integration Package

[![Latest Version on Packagist](https://badgen.net/github/release/dotlines-io/foster)](https://packagist.org/packages/dotlines-io/foster)
[![Tests](https://github.com/dotlines-io/foster/actions/workflows/run-tests.yml/badge.svg)](https://github.com/dotlines-io/foster/actions/workflows/run-tests.yml)
[![Psalm](https://github.com/dotlines-io/foster/actions/workflows/psalm.yml/badge.svg)](https://github.com/dotlines-io/foster/actions/workflows/psalm.yml)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/dotlines-io/foster/Check%20&%20fix%20styling?label=code%20style)](https://github.com/dotlines-io/foster/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amaster)
[![Total Downloads](https://img.shields.io/packagist/dt/dotlines-io/foster.svg?style=flat-square)](https://packagist.org/packages/dotlines-io/foster)
[![Total Downloads](https://badgen.net/packagist/php/dotlines-io/foster)](https://packagist.org/packages/dotlines-io/foster)

---

This composer package can be used for payment integration with [Foster](https://fosterpayments.com.bd/) Payments Platform.

For the credentials, please contact with info@fosterpayments.com.bd or call 8801730372941

## Installation

You can install the package via composer:

```bash
composer require dotlines-io/foster
```

## Usage

```php
/**
 * ******************************************************
 * ******************* Charge Request *******************
 * ******************************************************
 */

$charge_request_url = "<SERVER_URL>/fosterpayments/paymentrequest.php"; // Contact Foster Payments for it
$mcnt_AccessCode = '';          // Contact Foster Payments for it
$mcnt_ShortName = "";           // Contact Foster Payments for it
$mcnt_ShopId = '';              // Contact Foster Payments for it
$secretkey = "";                // Contact Foster Payments for it

$mcnt_TxnNo = '';               // Mandatory | Unique | Max: 32 Char 
$mcnt_Amount = 100;             // Mandatory | The total amount payable | Decimal
$mcnt_Currency = 'BDT';         // Mandatory | 3 Letter currency code  
$cust_InvoiceTo = '';           // Mandatory | Customer ID
$cust_CustomerServiceName = ''; // Mandatory | Service or Items sold
$cust_CustomerName = '';        // Mandatory | Customer ID
$cust_CustomerEmail = '';       // Mandatory | Customer Email
$cust_CustomerAddress = '';     // Mandatory | Customer Address
$cust_CustomerContact = '';     // Mandatory | Customer Contact no
$cust_CustomerCity = '';        // Mandatory | Customer City
$cust_CustomerState = '';       // Optional | Customer State
$cust_CustomerPostcode = '';    // Optional
$cust_CustomerCountry = '';     // Mandatory | Customer Country
$cust_Billingaddress = '';      // Mandatory | Customer Billing Address
$cust_ShippingAddress = '';     // Mandatory | Customer Shipping Address
$cust_orderitems = '';          // Mandatory | Customer ordered itme name, no, etc.
$success_url = '';              // Mandatory | Customer redirection URL after successful payment 
$cancel_url = '';               // Mandatory | Customer redirection URL after payment is canceled
$fail_url = '';                 // Mandatory | Customer redirection URL after payment failure
$merchentdomainname = '';       // Mandatory | Domain Name
$merchentip = '';               // Mandatory | Domain IP


$chargeRequest = \Dotlines\Foster\ChargeRequest::getInstance($charge_request_url, $mcnt_AccessCode, $mcnt_ShortName, $mcnt_ShopId, $secretkey,
    $mcnt_TxnNo, $mcnt_Amount, $mcnt_Currency, $cust_InvoiceTo, $cust_CustomerServiceName, $cust_CustomerName, $cust_CustomerEmail, $cust_CustomerAddress,
    $cust_CustomerContact, $cust_CustomerCity, $cust_CustomerState, $cust_CustomerPostcode, $cust_CustomerCountry, $cust_Billingaddress, $cust_ShippingAddress,
    $cust_orderitems, $success_url, $cancel_url, $fail_url, $merchentdomainname, $merchentip);
echo json_encode($chargeRequest->send()) . '<br/>';

/**
 * Success Charge Request Response looks like below.
 * You must store "payment_id" and redirect the user to the "redirect_url" for payment.
 * {
 *  "status": "200",
 *  "message": "Your Request Successfully received",
 *  "data": {
 *      "payment_id": "Testdc400a5.49862879-93218-nYaHX",
 *      "redirect_url": "https://demo.fosterpayments.com.bd/short/redirect.php",
 *      "merchant_ShopId": "6"
 *  }
 * }
 * Fail response only contains status > 200
 */


/**
 * ******************************************************
 * ******************* Status Request *******************
 * ******************************************************
 */

$status_url = "<SERVER_URL>/fosterpayments/TransactionStatus/txstatus.php";
$mcnt_TxnNo = '';   // Transaction No provided during payment request initiation
$secretkey = '';    // Secret key provided by admin 

$statusRequest = \Dotlines\Foster\StatusRequest::getInstance($status_url, $mcnt_TxnNo, $secretkey);
echo json_encode($statusRequest->send()) . '<br/>';

/**
 * Status Request Response looks like below:
 *[
 * {
 *      "MerchantTxnNo":"XXXXXXXXXXXXX",
 *      "TxnResponse":2,
 *      "TxnAmount":"1020.00",
 *      "Currency":"BDT",
 *      "ConvertionRate":"1",
 *      "OrderNo":"1803600769",
 *      "fosterid":"BUP8d8b615.97386539",
 *      "hashkey":"b3bceae17f843a910a4e295feed349a4",
 *      "message":"Transaction Successfully."
 *  }
 * ]
 * Fail response only contains status > 200
 */
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Credits

- [Rahat Mahmud](https://github.com/peash1068)
- [TareqMahbub](https://github.com/TareqMahbub)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
