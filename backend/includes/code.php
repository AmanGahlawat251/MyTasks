
function resizeImage($sourcePath, $destinationPath, $width = 96, $height = 45) {
    $info = getimagesize($sourcePath);

    if (!$info) {
        // Not a valid image file
        return false;
    }

    $mime = $info['mime'];
    switch ($mime) {
        case 'image/jpeg':
        case 'image/jpg':
            $originalImage = imagecreatefromjpeg($sourcePath);
            break;
		case 'image/webp':
            $originalImage = imagecreatefromwebp($sourcePath);
            break;
        case 'image/png':
            $originalImage = imagecreatefrompng($sourcePath);
            break;
		case 'image/gif':
            $originalImage = imagecreatefromgif($sourcePath);
            break;
		case 'image/wbmp':
            $originalImage = imagecreatefromwbmp($sourcePath);
            break;
        default:
           $originalImage = imagecreatefromjpeg($sourcePath);
		   }

    // Calculate aspect ratio
    $aspectRatio = imagesx($originalImage) / imagesy($originalImage);

    // Calculate new dimensions while maintaining the aspect ratio
    $width = (int) $width;
    $height = (int) $height;

    if ($width / $height > $aspectRatio) {
        $width = (int) ($height * $aspectRatio);
    } else {
        $height = (int) ($width / $aspectRatio);
    }

    // Create a new image with the specified dimensions
    $newImage = imagecreatetruecolor($width, $height);

    // Resize the image
    imagecopyresampled($newImage, $originalImage, 0, 0, 0, 0, $width, $height, imagesx($originalImage), imagesy($originalImage));

    // Save the resized image
    $outputFormat = strtolower(pathinfo($destinationPath, PATHINFO_EXTENSION));
    switch ($outputFormat) {
        case 'jpeg':
        case 'jpg':
            imagejpeg($newImage, $destinationPath, 100); // 100 is the quality (0 to 100)
            break;
        case 'png':
            imagepng($newImage, $destinationPath);
            break;
        default:
            // Unsupported output format
            return false;
    }

    // Free up memory
    imagedestroy($originalImage);
    imagedestroy($newImage);

    return true;
}



		$uploadsDir = "file_upload/logo";
$allowedFileType = array('jpg', 'png', 'jpeg', 'JPG', 'PNG', 'JPEG');
$response = array();

if (!empty($_FILES['logo']['name'])) {
    // Get file upload details
    $fileName = $_FILES['logo']['name'];
    $tempLocation = $_FILES['logo']['tmp_name'];
    $file_name = time() . $fileName;
    $fileType = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

    if (in_array($fileType, $allowedFileType)) {
        if (move_uploaded_file($tempLocation, $uploadsDir . '/' . $file_name)) {
            // Image resizing
            $uploadedImagePath = $uploadsDir . '/' . $file_name;
            $resizedImagePath = $uploadsDir . '/resized_' . $file_name;
			
            // Call resizeImage function
            if (resizeImage($uploadedImagePath, $resizedImagePath, 96, 45)) {
               
                echo "Uploaded Image Path: " . $uploadedImagePath . "<br>";
                echo "Resized Image Path: " . $resizedImagePath . "<br>";
            } else {
                $response['msg_code'] = "036"; // Added a new error code
                $response['msg'] = "Failed to resize the image.";
            }
        } else {
            $response['msg_code'] = "033";
            $response['msg'] = "Unable to upload the attachment at this time.";
        }
    } else {
        $response['msg_code'] = "034";
        $response['msg'] = "File format not supported.";
    }
} else {
    $response['msg_code'] = "035";
    $response['msg'] = "No file selected for upload.";
}