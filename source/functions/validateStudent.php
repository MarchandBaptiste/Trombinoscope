<?php
function validateStudent($db, $studentId)
{
    $sql = "UPDATE `student`
                SET `status` = 'valide'
                WHERE `student_id` = :studentId";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':studentId', $studentId, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->rowCount();
}
