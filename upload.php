<?php
require_once 'db.php';

// Tutorial taken from https://youtu.be/JaRq73y5MJk

if(isset($_POST['submit'])){
    $file = $_FILES['image'];
    print_r($file);   //Prints out the image in an array with all the information~!
    $fileName = $_FILES['image']['name'];
    $fileTmpName = $_FILES['image']['tmp_name'];
    $fileSize = $_FILES['image']['size'];
    $fileError = $_FILES['image']['error'];
    $fileType = $_FILES['image']['type'];

    $fileExt = explode('.', $fileName);

    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg','jpeg','png');

    if(in_array($fileActualExt, $allowed)){
        //Check if errors
        if($fileError === 0) {
            if ($fileSize < 500000) {
                $sql = "INSERT INTO headerImage (imageName) VALUES ('$fileName');";

                $cmd = $db->prepare($sql);
                $cmd->execute();

                $fileDestination = 'img/headerImg/'.$fileName;
                echo $fileDestination;
                if(!move_uploaded_file($fileTmpName, $fileDestination)){
                    echo "An error has occurred";
                }
                else
                echo "File was uploaded";
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
