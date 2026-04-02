<?php
function searchStudent($db, $first_name = "", $last_name = "")
{
    $sql = "SELECT * FROM `student`
    WHERE (`first_name` like :first_name OR `last_name` like :last_name) AND `status`= 'valide'";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':first_name', $first_name . '%', PDO::PARAM_STR);
    $stmt->bindValue(':last_name', $last_name . '%', PDO::PARAM_STR);
    $stmt->execute();
    return $stmt;
}
function adminSearchStudent($db, $first_name, $last_name)
{
    $sql = "SELECT * FROM `student`
    WHERE `first_name` like :first_name OR `last_name` like :last_name";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':first_name', $first_name . '%', PDO::PARAM_STR);
    $stmt->bindValue(':last_name', $last_name . '%', PDO::PARAM_STR);
    $stmt->execute();
    return $stmt;
}
