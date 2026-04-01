<?php
function deletStudent($db, $studentId)
{
    $sql = "DELETE FROM `students`
    WHERE `id` = :id";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':id', $studentId, PDO::PARAM_INT);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        return true;
    } else {
        return false;
    }
}
