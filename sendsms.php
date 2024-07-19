<?php

// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$database = "cms";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to retrieve a number from the database
$sql = "SELECT pheno FROM users WHERE userid = 643169632"; // Assuming user ID 1
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Fetch the phone number from the result
    $row = $result->fetch_assoc();
    $phoneNumber = $row["pheno"];

    // Generate OTP
    $otp = mt_rand(100000, 999999);

    // Close database connection
    $conn->close();

    // API URL
    $apiUrl = 'http://ibank.itmbplc.com:8500/RadiusPoints/UtilSMS.aspx';

    // API Parameters
    $params = http_build_query([
        'recipient' => $phoneNumber,
        'message' => "Your OTP is: $otp"
    ]);

    // Send OTP via API
    $response = file_get_contents("$apiUrl?$params");

    // Check if the message was sent successfully
    if ($response === false) {
        echo "Failed to send OTP.";
    } else {
        echo "OTP sent successfully to $phoneNumber.";
    }
} else {
    echo "No user found.";
}
?>
