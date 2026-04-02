<?php include_once('../partials/header.php');
include_once __DIR__ . '/../functions/search.php';
$db = db();
$first_name = filter_input(INPUT_GET, 'first_name', FILTER_SANITIZE_SPECIAL_CHARS);
$last_name = filter_input(INPUT_GET, 'last_name', FILTER_SANITIZE_SPECIAL_CHARS);
if (isset($_SESSION['logged'])) {
    $searchStudentResults = adminSearchStudent($db, $first_name, $last_name);
} else {
    $searchStudentResults = searchStudent($db);
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
                    <th>Slogan</th>
                    <?php if (isset($_SESSION['logged'])) { ?>
                        <th>Supprimé</th>
                        <th>Modifier</th>
                    <?php } ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($searchStudentResults as $student) : ?>
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
    </article>
</section>

<p>si admin alors on vois tous ceux valider et ce pas encore validedr </p>
<p>mais on peut filtrer les année mais aussi ceux qui sont validée et ceux qui sont en cours de validation</p>
<?php include_once('../partials/footer.php'); ?>