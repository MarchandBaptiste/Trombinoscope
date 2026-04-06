<?php
function setStudent($db, $first_name, $last_name, $email, $slogan, $is_delegate, $photo_path, $class_id)
{
    try {
        $sql = "INSERT INTO `student` (`first_name`, `last_name`, `email`, `slogan`, `is_delegate`, `photo_path`, `class_id`)
                VALUES (:first_name, :last_name, :email, :slogan, :is_delegate, :photo_path, :class_id)";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':first_name', $first_name, PDO::PARAM_STR);
        $stmt->bindValue(':last_name', $last_name, PDO::PARAM_STR);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->bindValue(':slogan', $slogan, PDO::PARAM_STR);
        $stmt->bindValue(':is_delegate', $is_delegate, PDO::PARAM_BOOL);
        $stmt->bindValue(':photo_path', $photo_path, PDO::PARAM_STR);
        $stmt->bindValue(':class_id', $class_id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->rowCount() > 0;
    } catch (PDOException $e) {
        die('Erreur SQL : ' . $e->getMessage());
    }
}
