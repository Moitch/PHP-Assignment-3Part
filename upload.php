<?php
require_once 'db.php';

// Tutorial taken from https://youtu.be/JaRq73y5MJk.

if(isset($_POST['submit'])){
    $file = $_FILES['image'];
    print_r($file);   //Prints out the image in an array with all the information~!

    // This is the information the print_r prints out, put into variables to handle validating the image.
    $fileName = $_FILES['image']['name']; // The original file name from the users upload.
    $fileTmpName = $_FILES['image']['tmp_name']; /* The temporary file name that you need to move to a new place.
    Should look something like tmp/(random letters)*/
    $fileSize = $_FILES['image']['size']; // The size of the file.
    $fileError = $_FILES['image']['error']; // The error code of the file, if 0 then its fine.
    $fileType = $_FILES['image']['type']; // The file type, image/xxxx

    /* This will grab the file extension using the explode method to split it at the period.
    Meaning an image.jpg would split at the period and just take whats after the period into the fileExt variable.    */
    $fileExt = explode('.', $fileName);

    // Makes sure the the file extension is in lower case, because some file extensions can be uppercase.
    $fileActualExt = strtolower(end($fileExt));

    // Creates an array of image types that are allowed to be uploaded.
    $allowed = array('jpg','jpeg','png');

    // Checks the file extension and checks to see if its inside of the $allowed array.
    if(in_array($fileActualExt, $allowed)){
        // Check if any errors with file.
        if($fileError === 0) {
            // Check to see if file size is too big.
            if ($fileSize < 500000) {
                // If passes all tests create insert statement.
                $sql = "INSERT INTO headerImage (imageName) VALUES ('$fileName');";

                // Prepare query and executes it.
                $cmd = $db->prepare($sql);
                $cmd->execute();

                // Creates the fileDestination variable linked to the headerImg folder.
                $fileDestination = 'img/headerImg/'.$fileName;

                // echo $fileDestination;
                // If the file has failed to move to the proper file destination, then tell user.
                if(!move_uploaded_file($fileTmpName, $fileDestination)){
                    echo "An error has occurred";
                }
                else {
                    echo "File was uploaded";
                    header("Location: header-image.php?uploadsuccess");
                }
            } else {
                echo "Your file is too big!";
            }
        }
        else{
                echo "There was an error uploading the file";
            }
    }
    else{
        echo "You cannot upload files of this type!";
    }
}
?>
