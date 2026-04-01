<?php
function getStudent($db)
{
    $sql = "SELECT * FROM `students`;";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    return $stmt;
}

