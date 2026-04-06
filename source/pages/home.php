<?php include_once __DIR__ . '/../partials/header.php'; ?>
<div class="upper-band">
    <h1>Retrouve tous les élèves de La Manu · Développement Web & Design</h1>
    <p>Promo 2025–2026</p>
</div>
<section class="card-nav">
    <a href="<?= BASE_URL ?>source/pages/add_student.php" style="--couleur: #a78bfa">
        <div>
            <p>➕</p>
            <h4>Ajouter</h4>
            <p>Ajouter un étudiant</p>
        </div>
    </a>
    <a href="<?= BASE_URL ?>source/pages/search.php" style="--couleur: #f59e0b">
        <div>
            <p>🔎</p>
            <h4>Recherche</h4>
            <p>Recherche unn étudiant</p>
        </div>
    </a>
</section>

<?php include_once __DIR__ . '/../partials/footer.php'; ?>