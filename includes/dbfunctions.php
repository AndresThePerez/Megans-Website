<?php 

function getKats() {
    include 'config.php';
    
    $sql = "SELECT id,name,subheading,description, DATE_FORMAT(dob, '%m/%d/%Y') as dob, picture_dir, status, reg_date FROM mainkittens WHERE STATUS = 'ACTIVE'";

    $result = $conn->query($sql);
    $result->fetch_all(MYSQLI_ASSOC);

    $conn->close();
    return $result;

}
?>