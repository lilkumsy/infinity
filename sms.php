<!DOCTYPE html>
<html>
<body>
<?php
function generateOTP($length = 6) {
    // Define the characters that can be used in the OTP
    $characters = '0123456789';
    
    // Get the total number of characters
    $charLength = strlen($characters);
    
    // Initialize the OTP variable
    $otp = '';
    
    // Generate random OTP
    for ($i = 0; $i < $length; $i++) {
        $otp .= $characters[rand(0, $charLength - 1)];
    }
    
    // Return the generated OTP
    return $otp;
}

function SendSMS($phoneno,$message) {
    $url = "http://ibank.itmbplc.com:8500/RadiusPoints/UtilSMS.aspx";
    $data = array(
        "msgTo" => $phoneno,
        "msgText" => $message,
        "msgSender" => "Infinity",
        "msgChannels" => "00"
    );
    $encodedData = json_encode($data);

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $encodedData);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Host: ibank.itmbplc.com', 'AuthToken: b21vbHVhYmk6b21vbHVhYmlAMTIz'));

    $response = curl_exec($curl);

    // Check for cURL errors
    if (curl_errno($curl)) {
        return 'Error: ' . curl_error($curl);
    }

    curl_close($curl);

    // Process the response
    $formattedR = json_decode($response, true);
    if (isset($formattedR['ResponseCode']) && $formattedR['ResponseCode'] === '00') {
        return 'SMS sent successfully';
    } else {
        return 'OTP could not be sent, Please try again ...';
    }
}

$otp = generateOTP();
echo $otp;
echo SendSMS("2348164540549", $otp);

?>
</body>
</html>
