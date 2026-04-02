<?php 
function setStudent($db, $first_name, $last_name, $email, $slogan, $is_delegate){
    $sql = "INSERT INTO `student` (`first_name`,`last_name`,`email`,`slogan`,`is_delegate`)
    VALUES (:first_name, :last_name, :email, :slogan, :is_delegate)";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':first_name', $first_name, PDO::PARAM_STR);
    $stmt->bindValue(':last_name', $last_name, PDO::PARAM_STR);
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->bindValue(':slogan', $slogan, PDO::PARAM_STR);
    $stmt->bindValue(':is_delegate', $is_delegate, PDO::PARAM_BOOL);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        return true;
    } else {
        return false;
    }
}

// faut ajouter la date et l'heure et check les images