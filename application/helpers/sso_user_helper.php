<?php  
if (!defined('BASEPATH')) exit('No direct script access allowed');

# Insert OR Update User Aplikasi SSO
function SSOInsOrUpdUser($username) {
    $ci=& get_instance();
    $ci->load->database();

    $status = false;
    $token = null;
    $msg = '';
    
    $appKey = 'c9b2ec95-4f88-4436-96ee-30f33461d6f1';
    $url = 'https://dcktrp.jakarta.go.id/sso/service/user';
    $curl = curl_init();

    $headers = [
        'User-Agent: Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:28.0) Gecko/20100101 Firefox/28.0',
        'app-key: '.$appKey
    ];

    $body = [
        'nrk' => $username
    ];
    
    $curl = curl_init();

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
        CURLOPT_HTTPHEADER => $headers,
        CURLOPT_POSTFIELDS => http_build_query($body)
    ));

    $resp = curl_exec($curl);
    $err = curl_error($curl);

    if ($err) {
        $msg = 'Error';
    }
    else {
        $resp = json_decode($resp);
        if ($resp->status == 'success') {
            $status = $resp->status;
            $msg = 'Berhasil';
        }
        else {
            $status = $resp->status;
            $msg = 'Gagal';
        }
    }

    curl_close($curl);

    $response = [
        'status' => $status,
        'code' => $resp->code,
        'message' => $msg
    ];

    return $response;
}

# Delete User Aplikasi SSO
function SSODeleteUser($username) {
    $ci=& get_instance();
    $ci->load->database();

    $status = false;
    $token = null;
    $msg = '';
    
    $appKey = 'c9b2ec95-4f88-4436-96ee-30f33461d6f1';
    $url = 'https://dcktrp.jakarta.go.id/sso/service/user';
    $curl = curl_init();

    $headers = [
        'User-Agent: Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:28.0) Gecko/20100101 Firefox/28.0',
        'app-key: '.$appKey
    ];

    $body = [
        'username' => $username
    ];
    
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_SSL_VERIFYHOST => false,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "DELETE",
        CURLOPT_HTTPHEADER => $headers,
        CURLOPT_POSTFIELDS => http_build_query($body)
    ));

    $resp = curl_exec($curl);
    $err = curl_error($curl);

    if ($err) {
        $msg = 'Error';
    }
    else {
        $resp = json_decode($resp);
        if ($resp->status == 'success') {
            $code = $resp->code;
            $msg = $resp->msg;
        }
        else {
            $code = $resp->code;
            $msg = $resp->msg;
        }
    }

    curl_close($curl);

    $response = [
        'status' => $resp->status,
        'code' => $code,
        'message' => $msg
    ];

    return $response;
}

# Access Aplikasi SSO
function SSOUserAccessApp($username) {
    $ci=& get_instance();
    $ci->load->database();

    $status = false;
    $token = null;
    $msg = '';
    
    $appKey = 'c9b2ec95-4f88-4436-96ee-30f33461d6f1';
    $url = 'https://dcktrp.jakarta.go.id/sso/service/access-app';
    $curl = curl_init();

    $headers = [
        'User-Agent: Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:28.0) Gecko/20100101 Firefox/28.0',
        'app-key: '.$appKey
    ];

    $body = [
        'username' => $username,
        'app_key' => $appKey
    ];
    
    $curl = curl_init();

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
        CURLOPT_HTTPHEADER => $headers,
        CURLOPT_POSTFIELDS => http_build_query($body)
    ));

    $resp = curl_exec($curl);
    $err = curl_error($curl);

    if ($err) {
        $msg = 'Error';
    }
    else {
        $resp = json_decode($resp);
        if ($resp->status == 'success') {
            $code = $resp->code;
            $msg = $resp->msg;
        }
        else {
            $code = $resp->code;
            $msg = $resp->msg;
        }
    }

    curl_close($curl);

    $response = [
        'status' => $resp->status,
        'code' => $code,
        'message' => $msg
    ];

    return $response;
}

# DELETE Access Aplikasi SSO
function SSODeleteUserAccessApp($username) {
    $ci=& get_instance();
    $ci->load->database();

    $status = false;
    $token = null;
    $msg = '';
    
    $appKey = 'c9b2ec95-4f88-4436-96ee-30f33461d6f1';
    $url = 'https://dcktrp.jakarta.go.id/sso/service/access-app';
    $curl = curl_init();

    $headers = [
        'User-Agent: Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:28.0) Gecko/20100101 Firefox/28.0',
        'app-key: '.$appKey
    ];

    $body = [
        'username' => $username,
        'app_key' => $appKey
    ];
    
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_SSL_VERIFYHOST => false,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "DELETE",
        CURLOPT_HTTPHEADER => $headers,
        CURLOPT_POSTFIELDS => http_build_query($body)
    ));

    $resp = curl_exec($curl);
    $err = curl_error($curl);

    if ($err) {
        $msg = 'Error';
    }
    else {
        $resp = json_decode($resp);
        if ($resp->status == 'success') {
            $code = $resp->code;
            $msg = $resp->msg;
        }
        else {
            $code = $resp->code;
            $msg = $resp->msg;
        }
    }

    curl_close($curl);

    $response = [
        'status' => $resp->status,
        'code' => $code,
        'message' => $msg
    ];

    return $response;
}


# UBAH PASSWORD Aplikasi SSO
# Verify login token (cookies : sso_dcktrp) - change password
function SSOVerifyLogin($auth) {
    $ci=& get_instance();
    $ci->load->database();

    $status = false;
    $data = null;
    $msg = '';
    
    $appKey = $ci->config->item('sso_key');
    $url = $ci->config->item('sso_service_url').'auth';
    $curl = curl_init();

    $headers = [
        'User-Agent: Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:28.0) Gecko/20100101 Firefox/28.0',
        'app-key: '.$appKey,
        'authorization: '.$auth
    ];
    
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_SSL_VERIFYHOST => false,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => $headers
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
            $data = $resp->payload;
        }
        else {
            $msg = $resp->msg;
        }
    }

    curl_close($curl);

    $response = [
        'status' => $status,
        'data' => $data->id_user,
        'message' => $msg
    ];

    return $response;
}


function SSOChangePassword($auth, $id_user, $pass) {
    $ci=& get_instance();
    $ci->load->database();

    $status = false;
    $token = null;
    $msg = '';
    
    $appKey = 'c9b2ec95-4f88-4436-96ee-30f33461d6f1';
    $url = 'https://dcktrp.jakarta.go.id/sso/service/user/change-password';
    $curl = curl_init();

    $headers = [
        'User-Agent: Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:28.0) Gecko/20100101 Firefox/28.0',
        'app-key: '.$appKey,
        'authorization: '.$auth
    ];

    $body = [
        'id_user' => $id_user,
        'password' => $pass,
    ];
    
    $curl = curl_init();

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
        CURLOPT_HTTPHEADER => $headers,
        CURLOPT_POSTFIELDS => http_build_query($body)
    ));

    $resp = curl_exec($curl);
    $err = curl_error($curl);

    if ($err) {
        $msg = 'Error';
    }
    else {
        $resp = json_decode($resp);
        if ($resp->status == 'success') {
            $status = $resp->status;
            $msg = $resp->msg;
        }
        else {
            $status = $resp->status;
            $msg = $resp->msg;
        }
    }

    curl_close($curl);

    $response = [
        'status' => $status,
        'code' => $resp->code,
        'message' => $msg
    ];

    return $response;
}