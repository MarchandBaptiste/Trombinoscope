<?php
function studentSet($db, $studentId)
{
    $sql = "SELECT * FROM `student` WHERE student_id = :id";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':id', $studentId, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function modifyStudent($db, $studentId, $first_name, $last_name, $email, $slogan, $is_delegate, $photo_path, $class_id)
{
    try {
        $sql = "UPDATE `student`
                SET `first_name` = :first_name,
                    `last_name` = :last_name,
                    `email` = :email,
                    `slogan` = :slogan,
                    `is_delegate` = :is_delegate,
                    `photo_path` = :photo_path,
                    `class_id` = :class_id
                WHERE `student_id` = :studentId";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':studentId', $studentId, PDO::PARAM_INT);
        $stmt->bindValue(':first_name', $first_name, PDO::PARAM_STR);
        $stmt->bindValue(':last_name', $last_name, PDO::PARAM_STR);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->bindValue(':slogan', $slogan, PDO::PARAM_STR);
        $stmt->bindValue(':is_delegate', $is_delegate, PDO::PARAM_BOOL);
        $stmt->bindValue(':photo_path', $photo_path, PDO::PARAM_STR);
        $stmt->bindValue(':class_id', $class_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount();
    } catch (PDOException $e) {
        die('Erreur SQL : ' . $e->getMessage());
    }
}
