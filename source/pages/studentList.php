<?php include_once('../partials/header.php');
include_once __DIR__ . '/../functions/getStudent.php';
$db = db();
$students = getStudent($db);
?>
<h2>Liste des étudiants</h2>
<section>
    <table>
        <thead>
            <tr>
                <th scope="col">Nom</th>
                <th scope="col">Prénom</th>
                <th scope="col">Email</th>
                <th>Slogan</th>
                <?php if (isset($_SESSION['logged'])) { ?>
                    <th>Supprimé</th>
                    <th>Modifier</th>
                <?php } ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($students as $student) : ?>
                <tr>
                    <th scope="row"><?= htmlspecialchars($student['last_name']) ?></th>
                    <td><?= htmlspecialchars($student['first_name']) ?></td>
                    <td><?= htmlspecialchars($student['email']) ?></td>
                    <td><?= htmlspecialchars($student['slogan']) ?></td>
                    <?php if (isset($_SESSION['logged'])) { ?>
                        <td><a href="<?= BASE_URL ?>source/pages/delete_student.php?id=<?= $student['student_id'] ?>" class="btn">Supprimé</a></td>
                        <td><a href="<?= BASE_URL ?>source/pages/edit_student.php?id=<?= $student['student_id'] ?>" class="btn">Modifier</a></td>
                    <?php } ?>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</section>

<?php include_once('../partials/footer.php'); ?>