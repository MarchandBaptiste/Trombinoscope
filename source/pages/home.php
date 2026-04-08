<?php 
$pageTitle = 'Home';
include_once __DIR__ . '/../partials/header.php'; 
include_once __DIR__ . '/../functions/getStudent.php';
$db = db();
$students = getStudentB1($db);
?>
<div class="upper-band" id="home">
    <h1>Retrouve tous les élèves de La Manu · Développement Web & Design</h1>
    <p>Promo 2025–2026</p>
</div>
<section class="card-conteneur">
    <?php foreach ($students as $student) : ?>
    <div class="card">
        <img src="../source/<?= $student['photo_path'] ?>" alt="Photo de <?= htmlspecialchars($student['first_name']) ?>">
        <h3><?= htmlspecialchars($student['first_name']) ?> <?= htmlspecialchars($student['last_name']) ?></h3>
        <p><span>Slogan : </span><?= htmlspecialchars($student['slogan']) ?></p>
        <div>
            <p>🎓 B1</p>
            <?php if ($student['is_delegate'] === 1) { ?>
                <p>👑 Délégué de classe</p>
            <?php } ?>
        </div>
        <div class="blur"></div>
    </div>
    <?php endforeach ?>
</section>

<?php include_once __DIR__ . '/../partials/footer.php'; ?>