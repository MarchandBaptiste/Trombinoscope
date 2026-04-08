<?php
function searchStudent($db, $search = "")
{
    $sql = "SELECT s.*, c.name AS class_name, l.name AS level_name 
            FROM `student` s
            JOIN `class` c ON s.`class_id` = c.`class_id`
            JOIN `level` l ON c.`level_id` = l.`level_id`
            WHERE (
                s.`first_name` LIKE :search
                OR s.`last_name` LIKE :search2
                OR l.`name` LIKE :search3
            )
            AND s.`status` = 'valide'";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
    $stmt->bindValue(':search2', '%' . $search . '%', PDO::PARAM_STR);
    $stmt->bindValue(':search3', '%' . $search . '%', PDO::PARAM_STR);
    $stmt->execute();
    return $stmt;
}
function filterStudent($db, $type = '', $search = '')
{
    $sql = "SELECT s.*, c.name AS class_name, l.name AS level_name 
            FROM `student` s
            JOIN `class` c ON s.`class_id` = c.`class_id`
            JOIN `level` l ON c.`level_id` = l.`level_id`
            WHERE (
                s.`first_name` LIKE :search
                OR s.`last_name` LIKE :search2
                OR l.`name` LIKE :search3
            )";
    if (!empty($type)) {
        $sql .= " AND s.`status` = :type";
    }
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
    $stmt->bindValue(':search2', '%' . $search . '%', PDO::PARAM_STR);
    $stmt->bindValue(':search3', '%' . $search . '%', PDO::PARAM_STR);
    if (!empty($type)) {
        $stmt->bindValue(':type', $type, PDO::PARAM_STR);
    }
    $stmt->execute();
    return $stmt;
}
