<?php


if (isset($_POST['mobile'])) {
    $mobile = '91'.$_POST['mobile'];
    $name = "Deepak";
    $code = "161099";
    $apiKey = urlencode('NzQ0YjcxNzE2ZDU0NDE0MjM3NTU3NTZjNjE2MjUyNmQ=');

    $numbers = array($mobile);
    $sender = urlencode('600010');
    $message = rawurlencode("'Dear '.$name.' Get 30% off on all our N&K clothing itmes with code '.$code.'. Hurry - offer valid only till the end of this months - N&K clothing'");

    $numbers = implode(',', $numbers);
    $data = array('apikey' => $apiKey, 'numbers' => $numbers, "sender" => $sender, "message" => $message);

    $ch = curl_init('https://api.textlocal.in/send/');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    print_r($response); die;
    if($response['status'] == 'failure'){
        $data = array('status' => 'false', 'msg' => 'Messagwe Can Not Be Sended !!');
    }else{
        $data = array('status' => 'true', 'msg' => 'Messagwe Send Succesfully !!');
    }
}else{
    $data = array('status' => 'false', 'msg' => 'All Fields are Required !!');
}

echo json_encode($data, JSON_PRETTY_PRINT);
