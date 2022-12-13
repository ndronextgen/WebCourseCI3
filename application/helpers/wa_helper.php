<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

function GetTokenWA()
{
    $ci = &get_instance();
    $ci->load->database();

    $url = 'https://dcktrp.jakarta.go.id/service-center/api/Auth';
    $curl = curl_init();
    $token = '';

    $data = [
        'username' => 'CITATA',
        'password' => 'hDdSsP1vAw'
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
    } else {
        $resp = json_decode($resp);
        if ($resp->status == 'success') {
            $token = $resp->token;
        }
    }

    curl_close($curl);

    return $token;
}
function SendWANotif($obj)
{
    $ci = &get_instance();
    $ci->load->database();

    $status = false;
    $category = 'Notif Si-ADIK';
    $serviceId = 2;

    $url = 'https://dcktrp.jakarta.go.id/service-center/api/SendMessage';
    $curl = curl_init();

    $data = [
        'serviceId' => $serviceId,
        'phone' => $obj['phone'],
        'message' => $obj['message'],
        'category' => $category,
        'token' => GetTokenWA()
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
    } else {
        $resp = json_decode($resp);
        if ($resp->status == 'success') {
            $status = true;
            $msg = $resp->status;
        } else {
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
