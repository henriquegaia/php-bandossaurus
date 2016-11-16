<?php

$config = include dirname(dirname(dirname(__FILE__))) . '/core/config.php';
include $config['file']['init'];
Security::protected_page();
include $config['file']['ov_header'];

Presentation::print_page_title('Become Premium');

if (empty($_POST) == false) {
    require $config['file']['autoload'];
    $paypal_api = new PayPalClass;
    $paypal_api->set_api_credentials();
   

    $paypal = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential($paypal_api->get_client_id(), $paypal_api->get_secret())
    );
    $paypal->setConfig($paypal_api->get_config());
    $payment = $paypal_api->get_payment();

    $create_error = '';
    try {
        $payment->create($paypal);
    } catch (Exception $exc) {
        exit($exc->getMessage());
//        $create_error = $paypal_api->error_message_paypal('creation of the payment');
    }

    if (empty($create_error)) {
        $approvalUrl = $payment->getApprovalLink();
        header("Location: {$approvalUrl}");
    } else {
        Presentation::print_failure_message($create_error);
    }
}

include $config['file']['paypal_form'];
include $config['file']['ov_footer'];

