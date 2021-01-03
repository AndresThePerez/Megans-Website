<?php 

function getKats() {
    include 'config.php';
    
    $sql = "SELECT * FROM mainkittens WHERE STATUS = 'ACTIVE'";

    $result = $conn->query($sql);
    $result->fetch_all(MYSQLI_ASSOC);

    $conn->close();
    return $result;

}
?>