<?php
$pageTitle = 'Recherche';
include_once('../partials/header.php');
include_once __DIR__ . '/../functions/search.php';
$db = db();
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $search = filter_input(INPUT_GET, 'search', FILTER_SANITIZE_SPECIAL_CHARS) ?? '';
    $searchStudentResults = searchStudent($db, $search);
}
// requette en une ligne pour afficher les class dynamiquement
$classes = $db->query("SELECT class_id, name FROM class ORDER BY class_id")->fetchAll(PDO::FETCH_ASSOC);
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
<section class="card-conteneur">
    <?php foreach ($searchStudentResults as $student) : ?>
        <div class="card">
            <img
                src="../source/<?= htmlspecialchars($student['photo_path']) ?>"
                alt="Photo de <?= htmlspecialchars($student['first_name']) ?>">
            <div class="card-gradient"></div>
            <div class="card-info-normal">
                <h3><?= htmlspecialchars($student['first_name']) ?> <?= htmlspecialchars($student['last_name']) ?></h3>
                <p class="card-citation-label">Citation :</p>
                <p class="card-citation"><?= htmlspecialchars($student['slogan']) ?></p>
            </div>
            <div class="card-overlay-hover">
                <div>
                    <h3><?= htmlspecialchars($student['first_name']) ?> <?= htmlspecialchars($student['last_name']) ?></h3>
                    <p class="card-citation-label">Citation :</p>
                    <p class="card-citation"><?= htmlspecialchars($student['slogan']) ?></p>
                </div>
                <div class="card-badges">
                    <span class="card-badge card-badge--class">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <path d="M22 10v6M2 10l10-5 10 5-10 5z" />
                            <path d="M6 12v5c3 3 9 3 12 0v-5" />
                        </svg>
                        <?= htmlspecialchars($student['class_name'] ?? '') ?>
                    </span>
                    <?php if ($student['is_delegate'] == 1) : ?>
                        <span class="card-badge card-badge--delegate">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" />
                            </svg>
                            <span class="badge-label-desktop">Délégué</span>
                        </span>
                    <?php endif ?>
                </div>
            </div>
        </div>
    <?php endforeach ?>
</section>
<?php include_once('../partials/footer.php'); ?>