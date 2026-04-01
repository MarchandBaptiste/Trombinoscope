<?php include_once __DIR__ . '/../partials/header.php'; ?>
<section class="hero">

    <?php if (isset($_SESSION['logged'])) { ?>
        <h2>Bienvenue sur Sakila <?= $_SESSION['logged']['username'] ?></h2>
    <?php } else { ?>
        <h2>Student Management System </h2>
    <?php } ?>
    <p>
        Explorez la liste des étudiant, ajouter-en, supprimer-en, recherche-en, modifier-en.
    </p>
</section>
<section class="card-nav">
    <a href="<?= BASE_URL ?>source/pages/studentList.php"  style="--couleur: #6c8eff">
        <div>
            <p>🧑‍🎓</p>
            <h4>Étudiant</h4>
            <p>Liste des étudiant</p>
        </div>
    </a>
    <a href="<?= BASE_URL ?>source/pages/add_student.php" style="--couleur: #a78bfa">
        <div>
            <p>➕</p>
            <h4>Ajouter</h4>
            <p>Ajouter un étudiant</p>
        </div>
    </a>
    <a href="<?= BASE_URL ?>source/pages/delete_student.php" style="--couleur: #34d399">
        <div>
            <p>☠️</p>
            <h4>Supprimer</h4>
            <p>Supprimer un étudiant</p>
        </div>
    </a>
    <a href="<?= BASE_URL ?>source/pages/search.php" style="--couleur: #f59e0b">
        <div>
            <p>🔎</p>
            <h4>Recherche</h4>
            <p>Recherche unn étudiant</p>
        </div>
    </a>
    <a href="<?= BASE_URL ?>source/pages/edit_student.php" style="--couleur: #f87171">
        <div>
            <p>✨</p>
            <h4>Modifier</h4>
            <p>Modifier un étudiant</p>
        </div>
    </a>
</section>

<!-- mettre des mettre coocki pour les thème -->
<?php include_once __DIR__ . '/../partials/footer.php'; ?>