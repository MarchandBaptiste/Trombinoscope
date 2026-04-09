<?php
$pageTitle = 'Administration';
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
        header("Refresh:0");
        $sentence = $delet ? 'La suppression a réussi' : 'La suppression a échoué';
    }
    if ($_POST['action'] === 'validate' && $studentId) {
        $delet = validateStudent($db, $studentId);
        header("Refresh:0");
        $sentence = $delet ? 'La validation a réussi' : 'La validation a échoué';
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $search = filter_input(INPUT_GET, 'search', FILTER_SANITIZE_SPECIAL_CHARS) ?? '';
    $type = filter_input(INPUT_GET, 'type', FILTER_SANITIZE_SPECIAL_CHARS) ?? '';
    $searchStudentResults = filterStudent($db, $type, $search);
}
$studentsArray = [];
foreach ($searchStudentResults as $student) {
    $studentsArray[] = $student;
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

<section class="admin-panel">
    <form action="" method="GET" class="filter" id="filterForm">
        <select name="type" id="typeSelect">
            <option value="">-- Filtrer --</option>
            <option value="valide">Valide</option>
            <option value="en_attente">En attente</option>
        </select>
    </form>
    <div class="desktop-only">
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
                <?php foreach ($studentsArray as $student) : ?>
                    <tr>
                        <td><img src="/source/<?= $student['photo_path'] ?>" class="picture-table"></td>
                        <td><?= htmlspecialchars($student['last_name']) ?></td>
                        <td><?= htmlspecialchars($student['first_name']) ?></td>
                        <td><?= htmlspecialchars($student['email']) ?></td>
                        <td><?= htmlspecialchars($student['slogan']) ?></td>
                        <td><a href="<?= BASE_URL ?>source/pages/edit_student.php?id=<?= $student['student_id'] ?>" class="btn-second">Modifier</a></td>
                        <td>
                            <form method="POST"><input type="hidden" name="student_id" value="<?= $student['student_id'] ?>"><button name="action" value="validate" class="btn-green">Valider</button></form>
                        </td>
                        <td>
                            <form method="POST"><input type="hidden" name="student_id" value="<?= $student['student_id'] ?>"><button name="action" value="delete" class="btn-red">Supprimer</button></form>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>

    <div class="mobile-only">
        <?php foreach ($studentsArray as $student) : ?>
            <article>
                <div>
                    <img src="/source/<?= $student['photo_path'] ?>" class="picture-table">
                    <div>
                        <p><?= htmlspecialchars($student['first_name']) ?></p>
                        <p><?= htmlspecialchars($student['last_name']) ?></p>
                    </div>
                    <p><?= htmlspecialchars($student['email']) ?></p>
                    <p><?= htmlspecialchars($student['slogan']) ?></p>
                    <div>
                        <a href="<?= BASE_URL ?>source/pages/edit_student.php?id=<?= $student['student_id'] ?>" class="btn-second">Modifier</a>
                        <form method="POST"><input type="hidden" name="student_id" value="<?= $student['student_id'] ?>"><button name="action" value="validate" class="btn-green">Valider</button></form>
                        <form method="POST"><input type="hidden" name="student_id" value="<?= $student['student_id'] ?>"><button name="action" value="delete" class="btn-red">Supprimer</button></form>
                    </div>
                </div>
            </article>
        <?php endforeach ?>
    </div>

    <div>
        <a href="?logout=true" class="btn-cta">Déconnexion</a>
    </div>
</section>

<?php include_once('../partials/footer.php'); ?>