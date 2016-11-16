<?php

$config = include dirname(dirname(dirname(__FILE__))) . '/core/config.php';
include $config['file']['init'];
Security::protected_page();
include $config['file']['ov_header'];

use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;

Presentation::print_page_title('Paypal Payment');

$paypal_api = new PayPalClass;
$paypal_api->set_api_credentials();

if (!isset($_GET['success'], $_GET['paymentId'], $_GET['PayerID'])) {
    $error = $paypal_api->error_message_paypal('parameters in the url');
    exit($error);
}

if ((bool) $_GET['success'] === false) {
    $error = $paypal_api->error_message_paypal('parameter \'success\' in the url');
    exit($error);
}

require $config['file']['autoload'];
$paypal = new \PayPal\Rest\ApiContext(
        new \PayPal\Auth\OAuthTokenCredential($paypal_api->get_client_id(), $paypal_api->get_secret())
);

$paypal->setConfig($paypal_api->get_config());

$paymentId = $_GET['paymentId'];
$payerId = $_GET['PayerID'];

$payment = Payment::get($paymentId, $paypal);

$execute = new PaymentExecution();
$execute->setPayerId($payerId);

$pay_error = '';
try {
    $result = $payment->execute($execute, $paypal);
} catch (Exception $exc) {
    $error_data = json_decode($exc->getData());
//    var_dump($error_data);
//    exit($exc->getMessage());
//    $pay_error = $paypal_api->error_message_paypal('execution of the transaction');
    $pay_error = $paypal_api->error_message_paypal($error_data->message);
}

if (empty($pay_error)) {
    // 1.make user premium
    $become_premium = User::become_premium();
    // 2.new_end_premium = sum 30 days to now
    $new_end_date = Validation::add_days_to_now_date(Premium::FEE_FREQUENCY_DAYS);
    // 3.update value on db
    $end_date_update = User::set_premium_end($new_end_date);
    // 4.show new end_premium
    $duration = Premium::FEE_FREQUENCY_DAYS;
    $append = "<br>Expiration date: $new_end_date.";
    $append .= "<br>Duration: $duration days.";

    Presentation::print_success_message("The payment has been accepted.$append");
} else {
    Presentation::print_failure_message($pay_error);
}

include $config['file']['ov_footer'];

