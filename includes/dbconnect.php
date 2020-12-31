<?php


function conn_create() {
    include_once("config.php");
    // Create connection
    $conn = new mysqli($DBSERVER, $DBUSER, $DBPASSWORD);
    
    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    echo "Connected successfully";

    return $conn;
}

function create_db($conn) {

// Create database
$sql = "CREATE DATABASE IF NOT EXISTS dbkittens";
if ($conn->query($sql) === TRUE) {
  echo "Database created successfully";
} else {
  echo "Error creating database: " . $conn->error;
}


}

function create_table($conn) {
    $sql = "CREATE TABLE IF NOT EXISTS dbkittens.mainkittens (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(30) NOT NULL,
        description VARCHAR(30) NOT NULL,
        status VARCHAR(50),
        reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";
        
        if ($conn->query($sql) === TRUE) {
            echo "Table mainkittens created successfully";
        } else {
            echo "Error creating table: " . $conn->error;
        }

        $sql = "CREATE TABLE IF NOT EXISTS dbkittens.secondkittens (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            picture BLOB,
            catfk int(6),
            reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            )";
        
        if ($conn->query($sql) === TRUE) {
            echo "Table secondkittens created successfully";
        } else {
            echo "Error creating table: " . $conn->error;
        }

        $sql = "CREATE TABLE IF NOT EXISTS dbkittens.users (
          id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
          username varchar(30),
          password varchar(30),
          reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
          )";
      
        if ($conn->query($sql) === TRUE) {
            echo "Table secondkittens created successfully";
        } else {
            echo "Error creating table: " . $conn->error;
        }
}

function insert_entry($conn) {
    $sql = "Insert into dbkittens.mainkittens (name, description, email) values ('kitten2', 'hello2', 'a2@gmail.com')";
    if ($conn->query($sql) === TRUE) {
        $last_id = $conn->insert_id;
        echo "New record created successfully";
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }

      $sql = "Insert into dbkittens.secondkittens (name, description, email, katfk) values ('kitten1', 'hello', 'a@gmail.com', '$last_id')";
      if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }

}

// function get_data() {

//   $conn = mysql()
//   $sql = "SELECT * FROM dbkittens.mainkittens";

// }

?>