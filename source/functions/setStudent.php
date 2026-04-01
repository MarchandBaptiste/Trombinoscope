<?php 
function setStudent($db, $first_name, $last_name, $email){
    $sql = "INSERT INTO `students` (`first_name`,`last_name`,`email`)
    VALUES (:first_name, :last_name, :email)";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':first_name', $first_name, PDO::PARAM_STR);
    $stmt->bindValue(':last_name', $last_name, PDO::PARAM_STR);
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        return true;
    } else {
        return false;
    }
}
?>