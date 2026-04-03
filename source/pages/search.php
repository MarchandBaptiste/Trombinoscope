<?php include_once('../partials/header.php');
include_once __DIR__ . '/../functions/search.php';
$db = db();
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $search = filter_input(INPUT_GET, 'search', FILTER_SANITIZE_SPECIAL_CHARS) ?? '';
        $searchStudentResults = searchStudent($db, $search);
}

?>
<h2>Rechercher un étudiant</h2>
<section class="data-column">
    <article>
        <form action="" method="get">
            <label for="">Rechercher : </label>
            <input type="text" name="search" value="<?= $search ?>" placeholder="Votre recherche...">
            <button type="submit">Envoyer</button>
        </form>
        <table>
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Slogan</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($searchStudentResults as $student) : ?>
                    <tr>
                        <th><?= htmlspecialchars($student['last_name']) ?></th>
                        <td><?= htmlspecialchars($student['first_name']) ?></td>
                        <td><?= htmlspecialchars($student['email']) ?></td>
                        <td><?= htmlspecialchars($student['slogan']) ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </article>
</section>


<p>filtrer les année</p>
<?php include_once('../partials/footer.php'); ?>