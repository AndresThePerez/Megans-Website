<?php
    function insert_values() {
        extract($_POST);
        include 'includes/config.php';
        $statusMsg = '';

        // File upload path
        $targetDir = "uploads/";
        $fileName = basename(strtolower($_FILES["file"]["name"]));
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
        
        if(isset($_POST["submit"]) && !empty($_FILES["file"]["name"])){
            // Allow certain file formats
            $allowTypes = array('jpg','png','jpeg','gif','pdf');
            if(in_array($fileType, $allowTypes)){
                // Upload file to server
                if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
                    // Insert image file name into database
                    $date = date("Y-m-d", strtotime($date));
                    $insert = $conn->prepare("INSERT INTO mainkittens (name, subheading, description, dob, picture_dir, status, reg_date) VALUES (?,?,?,?,?,'ACTIVE',NOW())");
                    $insert->bind_param('sssss', $name, $subheading, $description, $date, $targetFilePath);
                    $insert->execute();
                    if($insert){
                        $statusMsg = "The file ".$fileName. " has been uploaded successfully.";
                    }else{
                        $statusMsg = "File upload failed, please try again.";
                    } 
                }else{
                    $statusMsg = "Sorry, there was an error uploading your file.";
                }
            }else{
                $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
            }
        }else{
            $statusMsg = 'Please select a file to upload.';
        }

            // Display status message
    echo $statusMsg;
    $conn->close();
    }

    function edit_values() {
        include "includes/config.php";
        extract($_POST);


        if($description == $description_old
            && $name == $name_old
            && $subheading == $subheading_old
            && $date == $date_old) {
                echo '<div class="container mt-2 w-50"><div class="alert alert-danger text-center">
                <strong>Danger!</strong> No changes detected.
                    </div></div>';
        }

        $sql = "UPDATE mainkittens SET name = ?, subheading = ?, description = ?, dob = ? where id = ?";

        $date = date("Y-m-d", strtotime($date));
        $update = $conn->prepare($sql);
        $update->bind_param("ssssi", $name, $subheading, $description, $date, $id);
        if(!$update->execute()) {
            echo '<div class="container mt-2 w-50"><div class="alert alert-danger text-center">
                    <strong>Danger!</strong> Something went wrong
                </div></div>';
        }
        $update->close();

        $conn->close();
    }

?>