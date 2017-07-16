<?php
    require_once('vendor/autoload.php');

    $stripe = array(
        "secret_key"      => "sk_test_hluUMIA09WTwmMeLdOUzvqRI",
        "publishable_key" => "pk_test_fP7ulaUBqPVejk3Ap8aZmaxf"
    );

    \Stripe\Stripe::setApiKey($stripe['secret_key']);
?>