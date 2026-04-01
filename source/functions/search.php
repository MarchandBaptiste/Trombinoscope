<?php
function searchStudent($db, $first_name)
{
    $sql = "SELECT * FROM `students`
    WHERE `first_name` like :first_name;";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':first_name', $first_name.'%',PDO::PARAM_STR);
    $stmt->execute();
    return $stmt;
}
