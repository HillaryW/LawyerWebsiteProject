<?php
    require_once('config.php');

if (!empty($_POST['submit']) && $_POST['submit'] == 'submit') {

    $result = 'start ';

    $token = $_POST['tokenID'];
    $email = $_POST['tokenEmail'];
    $amount = 2000;
    $description = "description";

    try {
        $charge = \Stripe\Charge::create(array(
            'amount' => 5000,
            'currency' => 'usd',
            'description' => $description,
            'receipt_email' => $email,
            'source' => $token
        ));
        $result = 'success';
    } catch(\Stripe\Error\Card $e) {
        // Since it's a decline, \Stripe\Error\Card will be caught
        $body = $e->getJsonBody();
        $err  = $body['error'];

        $result .= 'Status is:' . $e->getHttpStatus() . "\n";
        $result .= 'Type is:' . $err['type'] . "\n";
        $result .= 'Code is:' . $err['code'] . "\n";
        // param is '' in this case
        $result .='Param is:' . $err['param'] . "\n";
        $result .= 'Message is:' . $err['message'] . "\n";
    } catch (\Stripe\Error\RateLimit $e) {
        // Too many requests made to the API too quickly
        $body = $e->getJsonBody();
        $err  = $body['error'];

        $result .= 'Status is:' . $e->getHttpStatus() . "\n";
        $result .= 'Type is:' . $err['type'] . "\n";
        $result .= 'Code is:' . $err['code'] . "\n";
        // param is '' in this case
        $result .='Param is:' . $err['param'] . "\n";
        $result .= 'Message is:' . $err['message'] . "\n";
    } catch (\Stripe\Error\InvalidRequest $e) {
        // Invalid parameters were supplied to Stripe's API
        $body = $e->getJsonBody();
        $err  = $body['error'];

        $result .= 'Status is:' . $e->getHttpStatus() . "\n";
        $result .= 'Type is:' . $err['type'] . "\n";
        $result .= 'Code is:' . $err['code'] . "\n";
        // param is '' in this case
        $result .='Param is:' . $err['param'] . "\n";
        $result .= 'Message is:' . $err['message'] . "\n";
    } catch (\Stripe\Error\Authentication $e) {
        // Authentication with Stripe's API failed
        // (maybe you changed API keys recently)
        $body = $e->getJsonBody();
        $err  = $body['error'];

        $result .= 'Status is:' . $e->getHttpStatus() . "\n";
        $result .= 'Type is:' . $err['type'] . "\n";
        $result .= 'Code is:' . $err['code'] . "\n";
        // param is '' in this case
        $result .='Param is:' . $err['param'] . "\n";
        $result .= 'Message is:' . $err['message'] . "\n";
    } catch (\Stripe\Error\ApiConnection $e) {
        // Network communication with Stripe failed
        $body = $e->getJsonBody();
        $err  = $body['error'];

        $result .= 'Status is:' . $e->getHttpStatus() . "\n";
        $result .= 'Type is:' . $err['type'] . "\n";
        $result .= 'Code is:' . $err['code'] . "\n";
        // param is '' in this case
        $result .='Param is:' . $err['param'] . "\n";
        $result .= 'Message is:' . $err['message'] . "\n";
    } catch (\Stripe\Error\Base $e) {
        // Display a very generic error to the user, and maybe send
        // yourself an email
        $body = $e->getJsonBody();
        $err  = $body['error'];

        $result .= 'Status is:' . $e->getHttpStatus() . "\n";
        $result .= 'Type is:' . $err['type'] . "\n";
        $result .= 'Code is:' . $err['code'] . "\n";
        // param is '' in this case
        $result .='Param is:' . $err['param'] . "\n";
        $result .= 'Message is:' . $err['message'] . "\n";
    } catch (Exception $e) {
        // Something else happened, completely unrelated to Stripe
        $body = $e->getJsonBody();
        $err  = $body['error'];

        $result .= 'Status is:' . $e->getHttpStatus() . "\n";
        $result .= 'Type is:' . $err['type'] . "\n";
        $result .= 'Code is:' . $err['code'] . "\n";
        // param is '' in this case
        $result .='Param is:' . $err['param'] . "\n";
        $result .= 'Message is:' . $err['message'] . "\n";
    }
    echo $result;
}
?>