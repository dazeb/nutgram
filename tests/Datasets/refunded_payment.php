<?php

dataset('refunded_payment', function () {
    $file = file_get_contents(__DIR__.'/../Fixtures/Updates/refunded_payment.json');

    return [json_decode($file)];
});
