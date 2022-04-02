<?php

require __DIR__ . '\vendor\autoload.php';

use Minishlink\WebPush\WebPush;
use Minishlink\WebPush\Subscription;

$subscription = Subscription::create([
    "endpoint" => "https://updates.push.services.mozilla.com/wpush/v2/gAAAAABiSEbCodotvxRazY2LdOiuWFFPkOb_1ZXez1hDYpkncFeoNBIMXyGMQoHfGVU7iACuyiFdtJXMoNqaOfn9DfSLYRcBoOtLZvfbVZCz6nV20JPYs4sJIMvFJvVRdoGu_MxFsgCYUhqapIBnwVe-Lqhb7K7xzyWtcrZh_7yzvJe1dBp5yhA",
    "keys" => [
        'p256dh' => 'BHepnQlzWvRNpoI0oEAA2SjgXeSGgemqOhB92-ipwwjvuzo_5R948_2P0BW_um8HZpMR-dpaNEpvVm41K_21UjA',
        'auth' => '_TTHxpKflpnVR3smCUu2HA'
    ]
]);

$auth = [
    'VAPID' => [
        'subject' => 'mailto:philip.engesser@go.winona.edu',
        'publicKey' => 'BM92XKYODFOd5Tmt2RAc-5u8s2sP9d1MbAZ5H2EqupdKhvge0mqqmStKDuaUU5dB0hEAzjmRWFQXdnlse4L8TFc',
        'privateKey' => 't4sCoph0Z540e3sT9bgPYX-921Pmq1vF36YJZE_neM0',
    ],
];
$webPush = new WebPush($auth);

$result = $webPush->sendOneNotification($subscription);

if ($result->isSuccess() == true) {
    echo "It's alive!!!!!";
}
else {
    error_log($result->getReason());
    error_log($result->getResponse());
}