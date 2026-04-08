<?php
include_once('../partials/header.php');
include_once __DIR__ . '/../functions/admin.php';
include_once __DIR__ . '/../functions/search.php';
include_once __DIR__ . '/../functions/deletStudent.php';
include_once __DIR__ . '/../functions/validateStudent.php';

$db = db();
$search = '';
$searchStudentResults = [];
$sentence = '';

if (isset($_SESSION['logged']) && isset($_GET['logout'])) {
    session_destroy();
    header('Location: /source/pages/home.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $studentId = filter_input(INPUT_POST, 'student_id', FILTER_VALIDATE_INT);

    if ($_POST['action'] === 'delete' && $studentId) {
        $delet = deletStudent($db, $studentId);
        $sentence = $delet ? 'La suppression a réussi' : 'La suppression a échoué';
    }
    if ($_POST['action'] === 'validate' && $studentId) {
        $delet = validateStudent($db, $studentId);
        $sentence = $delet ? 'La validation a réussi' : 'La validation a échoué';
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $search = filter_input(INPUT_GET, 'search', FILTER_SANITIZE_SPECIAL_CHARS) ?? '';
    $searchStudentResults = isset($_SESSION['logged'])
        ? adminSearchStudent($db, $search)
        : searchStudent($db, $search);
}
?>

<div class="upper-band">
    <div>
        <h1>Administration</h1>
        <p>Gérer les élèves · supprimer · modifier</p>
    </div>
    <form action="" method="get" class="search">
        <input type="text" name="search" id="search" value="<?= htmlspecialchars($search) ?>" placeholder="Votre recherche...">
        <button type="submit"><i class="ri-search-line"></i></button>
    </form>
</div>


<?php if ($sentence): ?>
    <p><?= htmlspecialchars($sentence) ?></p>
<?php endif ?>

<section>
    <p>filtre validé ou non</p>
    <table class="trombi-table">
        <thead>
            <tr>
                <th>Photo</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Slogan</th>
                <th>Modifier</th>
                <th>Valider</th>
                <th>Supprimer</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($searchStudentResults as $student) : ?>
                <tr>
                    <td><img src="/source/<?= $student['photo_path'] ?>" alt="Photo de <?= htmlspecialchars($student['first_name']) ?>" class="picture-table"></td>
                    <td><?= htmlspecialchars($student['last_name']) ?></td>
                    <td><?= htmlspecialchars($student['first_name']) ?></td>
                    <td><?= htmlspecialchars($student['email']) ?></td>
                    <td><?= htmlspecialchars($student['slogan']) ?></td>
                    <td>
                        <a href="<?= BASE_URL ?>source/pages/edit_student.php?id=<?= $student['student_id'] ?>" class="btn-second">Modifier</a>
                    </td>
                    <td>
                        <form method="POST">
                            <input type="hidden" name="student_id" value="<?= $student['student_id'] ?>">
                            <button name="action" value="validate" class="btn-green">Valider</button>
                        </form>
                    </td>
                    <td>
                        <form method="POST">
                            <input type="hidden" name="student_id" value="<?= $student['student_id'] ?>">
                            <button name="action" value="delete" class="btn-red">Supprimer</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>

    <a href="?logout=true" class="btn-cta">Déconnexion</a>
</section>

<?php include_once('../partials/footer.php'); ?>