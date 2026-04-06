<?php
function getStudent($db)
{
    $sql = "SELECT * FROM `student` WHERE `status`='valide';";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    return $stmt;
}

function getStudentB1($db)
{
    $sql = "SELECT * FROM `student` WHERE `status`='valide' AND `class_id` = 1;";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    return $stmt;
}