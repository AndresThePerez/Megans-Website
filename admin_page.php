<?php
session_start();
if(!isset($_SESSION['username'])){
   header("Location:Login.php");
}

if(isset($_POST)) {

    print_r($_POST);
    print_r($_FILES);

    include('includes/config.php');
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
                $insert = $db->query("INSERT into images (file_name, uploaded_on) VALUES ('".$fileName."', NOW())");
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
}
    ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
            <h1 class="text-center mb-10">Admin Page</h1>

<div class="container w-75">
    <div class="d-flex justify-content-end mb-2">
        <button class="btn-primary btn" data-toggle="modal" data-target="#new-entry-modal">Add New Entry</button>
    </div>
        <table class='table'>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>
    
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
</html>

<!-- Modal -->
<div class="modal fade" id="new-entry-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="" method="post" href="admin_page.php" enctype="multipart/form-data">
        <div class="row">
            <div class="col-6">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value=""></input>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-12">
                <label for="description">Description</label>
                <textarea type="text" class="form-control" id="description" name="description" value=""></textarea>
            </div>
        </div>
        <br>
        <label>Upload Your Image
            <input type="file" name="file" />
        </label>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" name="submit" value="Upload" class="btn btn-primary">
        </form>
      </div>
    </div>
  </div>
</div>