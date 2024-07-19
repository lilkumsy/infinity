<?php
include 'connection.php'; // Include your database connection file

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve account number from the form
    $acctno = $_POST['acctno']; 
	$firstname = $_POST['firstname'];
	$othernames = $_POST['othernames'];
	$phonenumber = $_POST['phonenumber'];
	$address = $_POST['address'];
	$nin = $_POST['nin'];
	$bvid = $_POST['bvid'];
	$lastname = $_POST['lastname']; 
	$dob = $_POST['dob'];
	$mail = $_POST['mail'];
	$bvn = $_POST['bvn'];
	$occupation = $_POST['occupation'];
	$ubill = $_POST['ubill'];
	$fvid = $_POST['fvid'];
	
    // Example of updating records based on account number
    $sql = "UPDATE your_table_name SET column1 = value1, column2 = value2 WHERE account_number = ?";
    
    // Prepare statement
    $stmt = $conn->prepare($sql);
    
    // Bind parameters
    $stmt->bind_param("s", $account_number);
    
    // Execute statement
    if ($stmt->execute()) {
        echo "Records updated successfully.";
    } else {
        echo "Error updating records: " . $stmt->error;
    }
    
    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update KYC</title>
	<link rel="shortcut icon" href="itmb-logo.jpg" />
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<style>
        body {
            font-family: Arial, sans-serif;
			color:#000080;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            text-align: center;
        }
        .logo {
            width: 100px;
            height: auto;
        }
        .welcome-message {
            font-size: 24px;
            margin-bottom: 20px;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            margin: 10px;
            transition: background-color 0.3s ease;
        }
        .button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
		<img src="itmb-logo.jpg" height='' width='' alt="Logo" class="logo">
        <h1 class="mt-5 mb-4" style="text-align: center;">Individual Basic Information Update Form</h1>
		<h6  style="color: red; text-align: center;">Kindly fill in personal details you wish to update and hit the submit button, it would only take a few minutes. Fields marked with * are mandatory.</h6>
        <form id="updateKYCForm" method="post" action="" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6">
				
				<div class="form-group">
                        <label for="acctno">Account Number*</label>
                        <input type="text" class="form-control" id="acctno" name="acctno" required>
                    </div>
					
                    <div class="form-group">
                        <label for="firstname">First Name*</label>
                        <input type="text" class="form-control" id="firstname" name="firstname" required>
                    </div>

                    <div class="form-group">
                        <label for="othernames">Other Names*</label>
                        <input type="text" class="form-control" id="othernames" name="othernames" required>
                    </div>
					
					<div class="form-group">
                        <label for="phonenumber">Phone Number*</label>
                        <input type="tel" class="form-control" id="phonenumber" name="phonenumber" required>
                    </div>
					
					<div class="form-group">
                        <label for="address">House Address*</label>
                        <input type="text" class="form-control" id="address" name="address" required>
                    </div>
					
					<div class="form-group">
                        <label for="nin">NIN*</label>
                        <input type="text" class="form-control" id="nin" name="nin" required>
                    </div>
					
					<div class="form-group">
                        <label for="bvid">Back  View Of ID*</label>
                        <input type="file" class="form-control" id="bvid" name="bvid" required>
                    </div>
                    <!-- Add more fields here for the first column -->
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="lastname">Last Name*</label>
                        <input type="text" class="form-control" id="lastname" name="lastname" required>
                    </div>

                    <div class="form-group">
                        <label for="dob">Date of Birth*</label>
                        <input type="date" class="form-control" id="dob" name="dob" required>
                    </div>
					
					<div class="form-group">
                        <label for="mail">Email Address*</label>
                        <input type="email" class="form-control" id="mail" name="mail" required>
                    </div>
					
					<div class="form-group">
                        <label for="bvn">BVN*</label>
                        <input type="text" class="form-control" id="bvn" name="bvn" required>
                    </div>
					
					<div class="form-group">
                        <label for="occupation">Occuption*</label>
                        <input type="text" class="form-control" id="occupation" name="occupation" required>
                    </div>
					
					<div class="form-group">
                        <label for="fvid">Upload front view of ID*</label>
                        <input type="file" class="form-control" id="fvid" name="fvid" required>
                    </div>
					
					<div class="form-group">
                        <label for="ubill">Upload Utility Bill*</label>
                        <input type="file" class="form-control" id="ubill" name="ubill " required>
                    </div>
                    <!-- Add more fields here for the second column -->
                </div>
            </div>
            
            <!-- Add your submit button here -->
            <button type="submit" name='submit' class="btn btn-primary btn-block mt-4">Submit</button>
            <br/><br/>  
		</form>
    </div>

    <!-- Bootstrap JS (optional, for form validation) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
