<?php

function create_tables() {
    include('config.php');
    $sql = "CREATE TABLE IF NOT EXISTS dbkittens.mainkittens (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(30) NOT NULL,
        subheading VARCHAR(30) NOT NULL,
        description VARCHAR(30) NOT NULL,
        picture_dir VARCHAR(30) NOT NULL,
        status VARCHAR(50),
        reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";
        
        if (!$conn->query($sql)) {
            echo "Error creating table: " . $conn->error;
        }

        $sql = "CREATE TABLE IF NOT EXISTS dbkittens.users (
          id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
          username varchar(30),
          password varchar(30),
          reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
          )";
      
        if (!$conn->query($sql)) {
            echo "Error creating table: " . $conn->error;
        }

        $conn->close();
}

?>