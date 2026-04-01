<?php
function setAdmin($db, $login, $email, $role, $password)
{
    try {
        $sql = "INSERT INTO `admin` (`login`, `role`, `email`, `password`)
                VALUES (:login, :role, :email, :password)";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':login', $login, PDO::PARAM_STR);
        $stmt->bindValue(':role', $role, PDO::PARAM_STR);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->bindValue(':password', $password, PDO::PARAM_STR);
        
        $stmt->execute();
        return true;
    } catch (PDOException $e) {
        error_log($e->getMessage());
        var_dump($e->getMessage());
        return false; 
    }
}

function getAdmin($db, $username, $password)
{
    $sql = "SELECT * FROM `admin` WHERE `login` = :login";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':login', $username, PDO::PARAM_STR);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        return [
            'login' => $user['login'],
            'email' => $user['email'],
            'role' => $user['role'],
        ];
    }
    return false;
}
