<?php
include_once('../partials/header.php');
include_once __DIR__ . '/../functions/admin.php';
include_once __DIR__ . '/../functions/search.php';
$db = db();
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $search = filter_input(INPUT_GET, 'search', FILTER_SANITIZE_SPECIAL_CHARS) ?? '';
    if (isset($_SESSION['logged'])) {
        $searchStudentResults = adminSearchStudent($db, $search);
    } else {
        $searchStudentResults = searchStudent($db, $search);
    }
}

if (isset($_SESSION['logged']) && isset($_GET['logout'])) {
    session_destroy();
    header('Location: /source/pages/home.php');
    exit();
}
?>

<div>
    <div class="upper-band">
        <div>
            <h1>Administration</h1>
            <p>Gérer les élèves · supprimer · modifier</p>
        </div>
        <form action="" method="get">
            <label for="">Rechercher : </label>
            <input type="text" name="search" value="<?= $search ?>" placeholder="Votre recherche...">
            <button type="submit">Envoyer</button>
        </form>
    </div>
</div>

<section>
    <p>filtre par année et validé ou non</p>
    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Slogan</th>
                <th>Supprimer</th>
                <th>Modifier</th>
                <th>Valider</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($searchStudentResults as $student) : ?>
                <tr>
                    <th><?= htmlspecialchars($student['last_name']) ?></th>
                    <td><?= htmlspecialchars($student['first_name']) ?></td>
                    <td><?= htmlspecialchars($student['email']) ?></td>
                    <td><?= htmlspecialchars($student['slogan']) ?></td>
                    <td><a href="<?= BASE_URL ?>source/pages/edit_student.php?id=<?= $student['student_id'] ?>" class="btn">Modifier</a></td>
                    <td><a href="<?= BASE_URL ?>source/pages/delete_student.php?id=<?= $student['student_id'] ?>" class="btn">Supprimer</a></td>
                    <td><a href="<?= BASE_URL ?>source/pages/valid_student.php?id=<?= $student['student_id'] ?>" class="btn">Valider</a></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
 
    <a href="?logout=true">Déconexion</a>
</section>


<?php include_once('../partials/footer.php'); ?>