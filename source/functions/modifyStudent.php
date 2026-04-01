<?php
function studentSet($db, $studentId)
{
    $sql = "SELECT 
    *
    FROM `students` 
    WHERE id = :id
    ";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':id', $studentId, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);;
}
function modifyStudent($db, $studentId, $first_name, $last_name, $email)
{
    $sql = "UPDATE `students`
    SET `first_name` = :first_name, `last_name` = :last_name, `email` = :email
    WHERE `id` = :studentId";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':studentId', $studentId, PDO::PARAM_INT);
    $stmt->bindValue(':first_name', $first_name, PDO::PARAM_STR);
    $stmt->bindValue(':last_name', $last_name, PDO::PARAM_STR);
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->rowCount();
}