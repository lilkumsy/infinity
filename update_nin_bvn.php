<?php

include 'connection.php';

if(isset($_POST['submit'])) {
    $account_number = $_POST['account_number'];
    $chosen_option = $_POST['chosen_option'];
    $value_to_update = $_POST['value_to_update'];
	
    // Validate inputs
    if (empty($account_number) || empty($chosen_option) || empty($value_to_update)) {
        echo "<script>alert('Please fill in all fields.')</script>";
    } else {
        // Check if chosen_option is valid
        if ($chosen_option != 'bvn' && $chosen_option != 'nin') {
            echo "<script>alert('Invalid option selected.')</script>";
        } else {
            // Prepare and execute the SQL query
            $query = "UPDATE CusMaster SET BvnNO = ? WHERE AccountNo = ?";
            $params = array($value_to_update, $account_number);
            $result = sqlsrv_query($conn, $query, $params);

            // Check query result
            if ($result === false) {
                echo "<script>alert('Failed to update record: " . sqlsrv_errors()[0]['message'] . "')</script>";
            } else {
                echo "<script>alert('Record updated successfully.')</script>";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ITMB NIN/BVN UPDATE</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="shortcut icon" href="itmb-logo.jpg" />
    <style>
        body {
            background-color: #001F3F; /* Navy Blue */
            color: white; /* Text color */
        }
        .form-container {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .navy-blue-color {
            color: #001F3F !important;
        }
        .navy-blue-bg {
            background-color: #001F3F !important;
            border-color: #001F3F !important;
        }
    </style>
</head>
<body>
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="form-container">
                    <center><img src="itmb-logo.jpg" height='120' width='120' alt="Logo" class="logo"></center>
                    <h5 class="text-center mb-4 navy-blue-color">In view of the recent CBN guidelines you are required to update your BVN and NIN. Kindly provide your account number and associated BVN/NIN and click update </h5>
                    <form method="post" action="">
                        <div class="form-group">
                            <label for="account_number" class="navy-blue-color">Account Number</label>
                            <input type="text" class="form-control" id="account_number" name="account_number" >
                        </div>
                        <div class="form-group">
                            <label for="chosen_option" class="navy-blue-color">Select Field</label>
                            <select class="form-control" id="chosen_option" name="chosen_option" >
                                <option value="">Select...</option>
                                <option value="bvn">BVN</option>
                                <option value="nin">NIN</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="value_to_update" class="navy-blue-color">Enter BVN/NIN</label>
                            <input type="text" class="form-control" id="value_to_update" name="value_to_update" required>
                        </div>
                         <button type="submit" name='submit' class="btn btn-primary btn-block navy-blue-bg">UPDATE NIN/BVN</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
