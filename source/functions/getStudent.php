<?php
function getStudent($db)
{
    $sql = "SELECT * FROM `student` WHERE `status`='valide';";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    return $stmt;
}

