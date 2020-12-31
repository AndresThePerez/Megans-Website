<?php

session_start();

function authenticate($data) {
    $conn = new mysqli("localhost", "root", "", "users");
    $query = "SELECT * from users";
    $result = $conn->query($query);
    $rows = $result->fetch_all(MYSQLI_ASSOC);

    $result->free();
    $conn->close();

    $username = testInput($data['username']);
    $password = testInput($data['password']);

    foreach($rows as $row){
        if($row['username'] == $username && $row['password'] == $password) {
            header("Location: admin_page.php");
        } else {
            echo '<div class="container mt-2 w-50"><div class="alert alert-danger text-center">
                    <strong>Danger!</strong> Incorrect Password.
                </div></div>';
        }
    }

    $_SESSION['username'] = $username;
}

function testInput($data) {
  $data = trim($data);
  $data = stripslashes($data);
//   $data = htmlspecialchars($data);
  return $data;
}



?>