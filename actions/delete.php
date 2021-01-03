<?php

    include "../includes/config.php";
    $id = $_GET['id'];


    $update = $conn->prepare("DELETE FROM mainkittens WHERE id = ?");
    $update->bind_param('i', $id);
    if($update->execute()) {
        header("Location: /admin_page.php");
    } else {
        echo '<div class="container mt-2 w-50"><div class="alert alert-danger text-center">
                <strong>Danger!</strong> Something went wrong
            </div></div>';
    }
    $update->close();

    $conn->close();
?>