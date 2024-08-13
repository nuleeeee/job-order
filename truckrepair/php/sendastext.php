<?php

$selectedEmail = $_POST["selectedEmail"];

// Create an array to store the contacts and their corresponding phone numbers
$contacts = array(
    'auditdeptmbd@gmail.com' => '09673311014',
    'financedeptmbd@gmail.com' => '09668637631',
    'maquilinghr@gmail.com' => '09928837700',
    'rize07.elca@gmail.com' => '09074627758',
    'mis@maquilingbuildersdepot.com' => '09561363891',
    'teammbdoperation@gmail.com' => '09959789666',
    'operations@maquilingbuildersdepot.com' => '09168452067',
    'mbdpurchasedept@gmail.com' => '09157303857',
    'michie9428@gmail.com' => '09950219212'
);

foreach (explode(",", $selectedEmail) as $email) {
    $email = trim($email);
    if (array_key_exists($email, $contacts)) {
        $phoneNumber = $contacts[$email];

        $ch = curl_init();
        $parameters = array(
            'apikey' => '76856457820ec74f92b8c0c39118866b',
            'number' => $phoneNumber,
            'message' => 'You have a notification from Job Order System. Please login your PIN: joborder.maquilingbuildersdepot.com',
            'sendername' => 'SEMAPHORE'
        );

        curl_setopt($ch, CURLOPT_URL, 'https://semaphore.co/api/v4/messages');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($parameters));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($ch);
        curl_close($ch);

        // Show the server response (you can process it as needed)
        echo $output;
    }
}

?>