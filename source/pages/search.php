<?php include_once('../partials/header.php');
include_once __DIR__ . '/../functions/search.php';
$db = db();
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $search = filter_input(INPUT_GET, 'search', FILTER_SANITIZE_SPECIAL_CHARS) ?? '';
    $searchStudentResults = searchStudent($db, $search);
}

?>
<div class="upper-band">
    <div>
        <h1>Toute nos promos</h1>
    </div>
    <form action="" method="get" class="search">
        <input type="text" name="search" id="search" value="<?= htmlspecialchars($search) ?>" placeholder="Votre recherche...">
        <button type="submit"><i class="ri-search-line"></i></button>
    </form>
</div>
<section>
    <?php foreach ($searchStudentResults as $student) : ?>
        <div class="card">
            <img src="/source/<?= $student['photo_path'] ?>" alt="Photo de <?= htmlspecialchars($student['first_name']) ?>">
            <h3><?= htmlspecialchars($student['first_name']) ?> <?= htmlspecialchars($student['last_name']) ?></h3>
            <p><span>Slogan : </span><?= htmlspecialchars($student['slogan']) ?></p>
            <div>
                <p>🎓 B1</p>
                <?php if ($student['is_delegate'] === 1) { ?>
                    <p>👑 Délégué de classe</p>
                <?php } ?>
            </div>
        </div>
    <?php endforeach ?>
</section>

<?php include_once('../partials/footer.php'); ?>