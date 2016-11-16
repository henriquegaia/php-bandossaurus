<?php

use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Payer;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Details;
use PayPal\Api\Amount;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Payment;

class PayPalClass {

    private $client_id;
    private $secret;

    const PRODUCT_NAME = '30 days Premium Membership';
    const CURRENCY = 'USD';

    private $payer;
    private $item;
    private $itemList;
    private $details;
    private $amount;
    private $transaction;
    private $redirectUrls;
    private $payment;

    public function set_api_credentials() {
        $this->set_client_id();
        $this->set_secret();
    }

    public function get_config() {
        global $config;
        return [
            'mode' => $this->get_api_mode(),
            'http.ConnectionTimeOut' => 30,
            'log.logEnabled' => true,
            'log.fileName' => $config['file']['pay_pal_log'],
            'log.logLevel' => 'FINE',
            'validation.level' => 'log'
        ];
    }

    private function get_api_mode() {
        if (Project::testing()) {
            return 'sandbox';
        } else {
            return 'live';
        }
    }

    private function set_client_id() {
        if (Project::testing()) {
            $this->client_id = '';
        } else {
            $this->client_id = '';
        }
    }

    private function set_secret() {
        if (Project::testing()) {
            $this->secret = '';
        } else {
            $this->secret = '';
        }
    }

    public function set_payer() {
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
        $this->payer = $payer;
    }

    public function set_item() {
        $item = new Item();
        $item->setName(self::PRODUCT_NAME);
        $item->setCurrency(self::CURRENCY);
        $item->setQuantity(1);
        $item->setPrice(Premium::FEE_US_DOLLARS);
        $this->item = $item;
    }

    public function set_itemList() {
        $itemList = new ItemList();
        $itemList->setItems([$this->item]);
        $this->itemList = $itemList;
    }

    public function set_details() {
        $details = new Details();
        $details->setSubtotal(Premium::FEE_US_DOLLARS);
        $this->details = $details;
    }

    public function set_amount() {
        $amount = new Amount();
        $amount->setCurrency(self::CURRENCY);
        $amount->setTotal(Premium::FEE_US_DOLLARS);
        $amount->setDetails($this->details);
        $this->amount = $amount;
    }

    public function set_transaction() {
        $transaction = new Transaction();
        $transaction->setAmount($this->amount);
        $transaction->setItemList($this->itemList);
        $transaction->setDescription(self::PRODUCT_NAME);
        $transaction->setInvoiceNumber(uniqid());
        $this->transaction = $transaction;
    }

    public function set_redirectUrls() {
        global $config;
        $redirectPath = $config['file']['paypal_pay'];
        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl($redirectPath . '?success=true');
        $redirectUrls->setCancelUrl($redirectPath . '?success=false');
        $this->redirectUrls = $redirectUrls;
    }

    public function set_payment() {
        $payment = new Payment();
        $payment->setIntent('sale');
        $payment->setPayer($this->payer);
        $payment->setRedirectUrls($this->redirectUrls);
        $payment->setTransactions([$this->transaction]);
        $this->payment = $payment;
    }

    public function get_payment() {
        $this->set_payer();
        $this->set_item();
        $this->set_itemList();
        $this->set_details();
        $this->set_amount();
        $this->set_transaction();
        $this->set_redirectUrls();
        $this->set_payment();
        return $this->payment;
    }

    public function get_client_id() {
        return $this->client_id;
    }

    public function get_secret() {
        return $this->secret;
    }

    public function error_message_paypal($body) {
        $error_message_start = 'Paypal payment: Something went wrong with the payment. Description: ';
        $error_message_end = '. The transaction was not completed!';
        return $error_message_start . $body . $error_message_end;
    }

}
