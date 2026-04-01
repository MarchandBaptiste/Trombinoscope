<?php include_once('../partials/header.php');
include_once __DIR__ . '/../functions/search.php';
$db = db();
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $first_name = filter_input(INPUT_GET, 'first_name', FILTER_SANITIZE_SPECIAL_CHARS);
    $searchStudentResults = searchStudent($db, $first_name);
}
?>
<h2>Rechercher un étudiant</h2>
<section class="data-column">
    <article>
        <form action="" method="get">
            <label for="">Rechercher : </label>
            <input type="text" name="first_name" value="<?= $first_name ?>" placeholder="Votre recherche...">
            <button type="submit">Envoyer</button>
        </form>
        <table>
            <thead>
                <tr>
                    <th scope="col">Nom</th>
                    <th scope="col">Prénom</th>
                    <th scope="col">Email</th>
                    <th scope="col">Date de création</th>
                    <th>Supprimé</th>
                    <th>Modifier</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($searchStudentResults as $student) : ?>
                    <tr>
                        <th scope="row"><?= htmlspecialchars($student['last_name']) ?></th>
                        <td><?= htmlspecialchars($student['first_name']) ?></td>
                        <td><?= htmlspecialchars($student['email']) ?></td>
                        <td><?= htmlspecialchars($student['created_at']) ?></td>
                        <td><a href="<?= BASE_URL ?>source/pages/delete_student.php?id=<?= $student['id'] ?>" class="btn">Supprimé</a></td>
                        <td><a href="<?= BASE_URL ?>source/pages/edit_student.php?id=<?= $student['id'] ?>" class="btn">Modifier</a></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </article>
</section>
<?php include_once('../partials/footer.php'); ?>