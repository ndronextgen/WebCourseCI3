<?php  
if (!defined('BASEPATH')) exit('No direct script access allowed');

function SendMail($obj) {
    $ci=& get_instance();
    $ci->load->database();

    $status = false;
    $message = `
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>`.$obj['message'].`</body>
    </html>
    `;
    
    $url = 'http://10.1.2.180/gateway/public/api/sendemail';
    $curl = curl_init();

    $data = [
        'subject' => $obj['subject'],
        'email' => $obj['email'],
        'html' => $message
    ];

    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_SSL_VERIFYHOST => false,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => http_build_query($data)
    ));

    $resp = curl_exec($curl);
    $err = curl_error($curl);

    if ($err) {
        $msg = 'Error';
    }
    else {
        $resp = json_decode($resp);
        if ($resp->status == 'success') {
            $status = true;
            $msg = $resp->status;
        }
        else {
            $status = false;
            $msg = $resp->msg;
        }
    }

    curl_close($curl);

    $response = [
        'status' => $status,
        'message' => $msg
    ];

    return $response;
}