<?php

include 'connection.php';

if(isset($_POST['submit'])) {
    
    $account_number = $_POST['account_number'];
    $update_type = $_POST['update_type'];
    $value_to_update = $_POST['value_to_update'];
    
    if (!empty($account_number) && !empty($update_type) && !empty($value_to_update)) {
                
        // Validate account number (assuming it's numeric)
        if (!ctype_digit($account_number)) {
            echo "Invalid account number";
            exit;
        }

        // Determine the field to update based on the selected update type
        $field_to_update = '';
        $update_message = '';
        if ($update_type === 'bvn') {
            $field_to_update = 'BvnNo';
            $update_message = 'BVN has been updated successfully';
        } elseif ($update_type === 'nin') {
            $field_to_update = 'NinNo';
            $update_message = 'NIN has been updated successfully';
        } else {
            echo "Invalid update type";
            exit;
        }

        // Construct the SQL query
        $query = "UPDATE CusMaster 
                  SET $field_to_update = ? 
                  WHERE CusID = (SELECT CusID FROM AcctMaster WHERE AccountNo = ?)";
        
        // Execute the query with prepared statement
        $params = array($value_to_update, $account_number);
        $stmt = sqlsrv_query($conn, $query, $params);

        if ($stmt) {
            echo "<script>alert('$update_message')</script>";
        } else {
            echo "<script>alert('Failed to update: " . mysqli_error($conn) . ')</script>';
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
                    
					<h5 class="text-center mb-4 navy-blue-color">In view of the recent CBN guidelines you are required to update your BVN and NIN.
					Kindly provide your account number and associated BVN/NIN and click update </h5>
					<!-- Added class navy-blue-color -->
                    <form method="post" action=" ">
                        <div class="form-group">
                            <label for="account_number" class="navy-blue-color">Account Number</label>
                            <input type="text" class="form-control" id="account_number" name="account_number" required>
                        </div>
                        <div class="form-group">
                            <label for="update_type" class="navy-blue-color">Update Type</label>
                            <select class="form-control" id="update_type" name="update_type" required>
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
