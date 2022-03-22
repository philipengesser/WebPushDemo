<?php

require __DIR__ . '\vendor\autoload.php';

use Minishlink\WebPush\WebPush;
use Minishlink\WebPush\Subscription;

// array of notifications
$notifications = [
    [
          'subscription' => Subscription::create([
              "endpoint" => "https://fcm.googleapis.com/fcm/send/do4shyCfVYA:APA91bFuwAb-KNKggafXF-JgLCXJdRdtLnIZieOa5NyUMqkYmPIPH8qSVkrRT0dHS95pkF0xLQa7vfsd0lmy3VbW70UJAkrmdGQYRbtZp1NGoJaDjA6Fe2GEv_Ew0dqmSHuHY7pRjNSD",
              "keys" => [
                  'p256dh' => 'BK3FFZpxRMoD9aAB_CilCitWIiULgu_Zf3iW9DxyTmEX7M6Gjcc4H97sfsCgVNbnb7VWvmTSswseNRjMY5Te0uE',
                  'auth' => 'GaeBftOls3RJ5JENz53S8Q'
              ]
              //"contentEncoding" => "aes128gcm"
          ]),
          'payload' => '{"msg":"Hello World!"}',
        ],
        // [
        //     'subscription' => Subscription::create([
        //         "endpoint" => "https://wns2-by3p.notify.windows.com/w/?token=BQYAAACAUazvWMyDviQg%2buWJDlWOmKnqx5Bo9pohy3OLMXrKdK4R7PLCnq3IdFPj5g38cRYQN63nhHWUBPiZall4O5X3JYHXgjNDTxV65GtEoZAX%2f%2bor3oHV9%2fBcGc%2fzayyCB5xS0PcHqXdCP%2bUIJtQ02rFMf9MS197p0qcGoTiPN%2fk5xWoY2dNOQaWZDJX4drJbyACN9G4DyoUyxWMnDPz0HKUalKQ13kV8TRoOTH1MKD5M7hfiwfPfwSW7fONZna41dtcr4q3D8Mz59d5RiNVcoYozWrBQmpS8o2FSXhqfoNHGNDZamV%2fNcGXajWi9awi0xQM%3d",
        //         "keys" => [
        //             'p256dh' => 'BN8OyIKLWLWqSw85mr-7--30cnyPF4X8qGcy8a-gFE7VuAIY8HxY3BmrYNNSVsEw-ClUywFGK891Gx0M8MFymR4',
        //             'auth' => 'vywnoLkDbE3OZkq5tzwCWg'
        //         ]
        //         //"contentEncoding" => "aes128gcm"
        //     ]),
        //     'payload' => '{"msg":"Hello World!"}',
        //   ],
        [
        'subscription' => Subscription::create([
            "endpoint" => "https://updates.push.services.mozilla.com/wpush/v2/gAAAAABiOgHBl_NsEtM_pUG0ycmqUiEiFv0Y7PR-IO6SfqNqdermEkF0B5BHg7Y3wzDZo6p2VHjWHs4aOFirPm9xk9tKhDm31_4Vu_0JHz2Dn1RuxRo6VuLQtPH34Vdl-P2fzZishLjztoqb_x2dlMswqbKUT9l94LSZT-vKqRtdI_BBw13GGzo",
            "keys" => [//  https://updates.push.services.mozilla.com/wpush/v2/gAAAAABiOgHBl_NsEtM_pUG0ycmqUiEiFv0Y7PR-IO6SfqNqdermEkF0B5BHg7Y3wzDZo6p2VHjWHs4aOFirPm9xk9tKhDm31_4Vu_0JHz2Dn1RuxRo6VuLQtPH34Vdl-P2fzZishLjztoqb_x2dlMswqbKUT9l94LSZT-vKqRtdI_BBw13GGzo
                'p256dh' => 'BEwS27GQHqKpGlhStmre1bSa1nPeuhs3dWdH3gQqVdci-99LqBS35k_u-pB96Scn8JNjvU5oq4irKXh8XxDZv_o',
                'auth' => '-GBmahusvwkNSco-cFrWEQ'
            ]
            //"contentEncoding" => "aesgcm"
        ]),
        'payload' => '{"msg":"Hello World!"}',
      ]
    //     [
    //         'subscription' => Subscription::create([
    //             "endpoint" => "https://updates.push.services.mozilla.com/wpush/v2/gAAAAABiO...7T1554OHapOxYS6hIl7jN3SyHSuHXh2Gock27HLCVxNSVDhBFSQk0ZN8rqdc",
    //             "keys" => [
    //                 'p256dh' => 'p256dh":"BKsbsdOMzK282i-Bu6hdWj7QP_sPS9qWjmz8GcYNy1WOpffdMm6Ibe_KVzfu0zpMivFODRjDcOyPWV43Oqvrakg',
    //                 'auth' => 'ZPgqAZ5RJS0j7fTWdc0Ifg'
    //             ],
    //             "contentEncoding" => "aes128gcm"
    //         ]),
    //         'payload' => '{"msg":"Hello World!"}',
    //   ]
];
$auth = [
    'VAPID' => [
        'subject' => 'mailto:philip.engesser@go.winona.edu',
        'publicKey' => 'BM92XKYODFOd5Tmt2RAc-5u8s2sP9d1MbAZ5H2EqupdKhvge0mqqmStKDuaUU5dB0hEAzjmRWFQXdnlse4L8TFc',
        'privateKey' => 't4sCoph0Z540e3sT9bgPYX-921Pmq1vF36YJZE_neM0',
    ],
];
$webPush = new WebPush($auth);

// send multiple notifications with payload
foreach ($notifications as $notification) {
    $webPush->queueNotification(
        $notification['subscription'],
        $notification['payload'] // optional (defaults null)
    );
}

/**
 * Check sent results
 * @var MessageSentReport $report
 */
foreach ($webPush->flush() as $report) {
    $endpoint = $report->getRequest()->getUri()->__toString();

    if ($report->isSuccess()) {
        echo "[v] Message sent successfully for subscription {$endpoint}.\n";
    } else {
        echo "[x] Message failed to sent for subscription {$endpoint}: {$report->getReason()}  End of message\n";
    }
}

/**
 * send one notification and flush directly
 * @var MessageSentReport $report
 */
// $report = $webPush->sendOneNotification(
//     $notifications[0]['subscription'],
//     $notifications[0]['payload'] // optional (defaults null)
// );
