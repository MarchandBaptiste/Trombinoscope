<?php
function validateStudent($db, $studentId)
{
    try {
        $sql = "UPDATE `student`
                SET `status` = 'valide'
                WHERE `student_id` = :studentId";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':studentId', $studentId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount();
    } catch (PDOException $e) {
        die('Erreur SQL : ' . $e->getMessage());
    }
}
