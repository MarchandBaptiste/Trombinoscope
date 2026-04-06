<?php
function deletStudent($db, $studentId)
{
    $sql = "DELETE FROM `student`
    WHERE `student_id` = :id;";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':id', $studentId, PDO::PARAM_INT);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        return true;
    } else {
        return false;
    }
}
