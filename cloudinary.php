<?php

// Include Cloudinary SDK
require 'vendor/autoload.php';
use Cloudinary\Cloudinary;

// Cloudinary configuration
$cloudinary = new Cloudinary([
    'cloud' => [
        'cloud_name' => 'dtuii2cln',
        'api_key' => '675618269116393',
        'api_secret' => '4eMLBcnCo34rnJ3CazhgRSzcWaQ'
    ]
]);

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
    // Upload image to Cloudinary
    $uploaded = $cloudinary->uploadApi()->upload($_FILES['image']['tmp_name']);

    // Extract metadata
    $metadata = $cloudinary->adminApi()->getAsset($uploaded['public_id'], ['metadata' => true]);

    // Get capture date
    $captureDate = $metadata['image_metadata']['DateTimeOriginal']; // Assuming EXIF data is available

    // Get location (if available)
    $location = isset($metadata['context']['custom']['location']) ? $metadata['context']['custom']['location'] : 'Unknown';

    // Calculate age
    $captureDateTime = new DateTime($captureDate);
    $currentDateTime = new DateTime();
    $age = $captureDateTime->diff($currentDateTime)->format('%y years, %m months, %d days');

    // Display results
    echo "Capture Date: $captureDate<br>";
    echo "Location: $location<br>";
    echo "Image Age: $age<br>";
}

?>

<!-- HTML form -->
<form method="post" enctype="multipart/form-data">
    <input type="file" name="image" accept="image/*" required>
    <button type="submit">Upload</button>
</form>
