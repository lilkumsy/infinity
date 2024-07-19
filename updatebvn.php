<?php

include 'connection.php';

if(isset($_POST['submit'])) {
    
    $account_number = $_POST['account_number'];
    $value_to_update = $_POST['value_to_update'];
    
    if (!empty($account_number) && !empty($value_to_update)) {
        // Perform input validation
        if (!preg_match('/^\d+$/', $account_number)) {
            echo "Invalid account number";
            exit;
        }

        $query = "UPDATE CusMaster 
                  SET ninno = '$value_to_update' 
                  WHERE CusID = (SELECT CusID FROM AcctMaster WHERE AccountNo = '$account_number')";
        
        $result = sqlsrv_query($conn, $query);

        if ($result) {
            echo "<script>alert('NIN Updated successfully')</script>";
        } else {
            echo "<script>alert('Can't update NIN for the selected account number due to: " . mysqli_error($conn) . ')</script>';
        }
    } else {
        echo "Enter required fields";
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
				<CENTER><img src="itmb-logo.jpg" height='120' width='120' alt="Logo" class="logo"></CENTER>
                    
					<h5 class="text-center mb-4 navy-blue-color">In view of the recent CBN guidelines you are required to update your NIN.
					Kindly provide your account number and associated NIN and click update </h5>
					<!-- Added class navy-blue-color -->
                    <form method="post" action=" ">
                        <div class="form-group">
                            <label for="account_number" class="navy-blue-color">Account Number</label>
                            <input type="text" class="form-control" id="account_number" name="account_number" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="value_to_update" class="navy-blue-color">Enter NIN</label>
                            <input type="text" class="form-control" id="value_to_update" name="value_to_update" required>
                        </div>
                         <button type="submit" name='submit' class="btn btn-primary btn-block navy-blue-bg">UPDATE NIN</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
