<?php
$pageTitle = 'Ajout';
include_once('../partials/header.php');
include_once __DIR__ . '/../functions/setStudent.php';
$db = db();

$signIn = null;
$sentance = '';
$classes = $db->query("SELECT class_id, name FROM class ORDER BY class_id")->fetchAll(PDO::FETCH_ASSOC);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_SPECIAL_CHARS);
    $last_name = filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $slogan = filter_input(INPUT_POST, 'slogan', FILTER_SANITIZE_SPECIAL_CHARS);
    $is_delegate = isset($_POST['is_delegate']);
    $class_id = filter_input(INPUT_POST, 'class_id', FILTER_VALIDATE_INT);

    $first_name_valid = (
        !empty(trim($first_name)) &&
        strlen($first_name) >= 2 &&
        strlen($first_name) <= 50 &&
        preg_match('/^[a-zA-ZÀ-ÿ\s\-]+$/', $first_name)
    );
    $last_name_valid = (
        !empty(trim($last_name)) &&
        strlen($last_name) >= 2 &&
        strlen($last_name) <= 50 &&
        preg_match('/^[a-zA-ZÀ-ÿ\s\-]+$/', $last_name)
    );
    $email_valid = (bool) filter_var($email, FILTER_VALIDATE_EMAIL);
    $slogan_valid = (
        !empty(trim($slogan)) &&
        strlen($slogan) >= 10 &&
        strlen($slogan) <= 255
    );
    $class_id_valid = $class_id !== false && $class_id > 0;

    // Validation photo
    $photo_valid = false;
    $photo_path = '';

    if (isset($_FILES['photo_path']) && $_FILES['photo_path']['error'] === UPLOAD_ERR_OK) {
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        $max_size = 2 * 1024 * 1024;
        $file_tmp = $_FILES['photo_path']['tmp_name'];
        $file_size = $_FILES['photo_path']['size'];
        $file_ext = strtolower(pathinfo($_FILES['photo_path']['name'], PATHINFO_EXTENSION));
        $file_mime = mime_content_type($file_tmp);

        if (
            in_array($file_mime, $allowed_types) &&
            in_array($file_ext, $allowed_extensions) &&
            $file_size <= $max_size &&
            getimagesize($file_tmp) !== false
        ) {
            $upload_dir = __DIR__ . '/../uploads/';
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0755, true);
            }

            $unique_name = uniqid('photo_', true) . '.' . $file_ext;
            $destination = $upload_dir . $unique_name;

            if (move_uploaded_file($file_tmp, $destination)) {
                $photo_path = 'uploads/' . $unique_name;
                $photo_valid = true;
            }
        }
    }

    if (!$first_name_valid || !$last_name_valid || !$email_valid || !$slogan_valid || !$photo_valid || !$class_id_valid) {
        $signIn = false;
        $sentance = 'Données manquantes ou invalides';
    } else {
        $user = setStudent($db, $first_name, $last_name, $email, $slogan, $is_delegate, $photo_path, $class_id);
        if ($user === true) {
            $signIn = true;
            $sentance = 'Votre profil a bien été créé, il sera visible après validation.';
        } else {
            $signIn = false;
            $sentance = "L'inscription a échoué, veuillez réessayer.";
        }
    }
}
?>

<div class="upper-band">
    <h1>Création de profil</h1>
</div>
<div class="page-inscription">

    <?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($sentance)) { ?>
        <p class="message-retour <?= $signIn ? 'valid' : 'error' ?>">
            <?= htmlspecialchars($sentance) ?>
        </p>
    <?php } ?>

    <div class="inscription-wrapper" id="container">
        <form class="formulaire" action="" method="POST" enctype="multipart/form-data">

            <div class="form-container etape-1-container">
                <div class="champs-wrapper">
                    <h2>Inscription</h2>
                    <p class="subtitle">Crée ton profil, il sera visible après validation.</p>

                    <div class="champs">
                        <label for="first_name">Prénom</label>
                        <input type="text" id="first_name" name="first_name" placeholder="Ton prénom" value="<?= htmlspecialchars($first_name ?? '') ?>" required />
                    </div>
                    <div class="champs">
                        <label for="last_name">Nom</label>
                        <input type="text" id="last_name" name="last_name" placeholder="Ton nom" value="<?= htmlspecialchars($last_name ?? '') ?>" required />
                    </div>
                    <div class="champs">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="ton@email.com" value="<?= htmlspecialchars($email ?? '') ?>" required />
                    </div>
                    <div class="champs">
                        <label for="class_id">Classe</label>
                        <select id="class_id" name="class_id" required>
                            <option value="">-- Choisissez --</option>
                            <?php foreach ($classes as $class) { ?>
                                <option value="<?= $class['class_id'] ?>" <?= (isset($_POST['class_id']) && $_POST['class_id'] == $class['class_id']) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($class['name']) ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <button type="button" class="btn-cta" id="btn-etape-suivante">Continuer</button>
                </div>
            </div>

            <div class="form-container etape-2-container">
                <div class="champs-wrapper">
                    <h2>Détails</h2>
                    <p class="subtitle">Dernière ligne droite.</p>

                    <div class="champs">
                        <label for="slogan">Slogan</label>
                        <textarea id="slogan" name="slogan" rows="3" placeholder="Ta citation (10 à 255 caractères)" required><?= htmlspecialchars($slogan ?? '') ?></textarea>
                    </div>
                    <div class="champs champs-inline">
                        <input type="checkbox" id="is_delegate" name="is_delegate" <?= isset($_POST['is_delegate']) ? 'checked' : '' ?> />
                        <label for="is_delegate">Je suis délégué·e</label>
                    </div>
                    <div class="champs">
                        <label>Photo de profil</label>
                        <div class="zonephoto" onclick="document.getElementById('photo_path').click()">
                            <input type="file" id="photo_path" name="photo_path" accept="image/jpeg,image/png,image/gif,image/webp" required style="display: none;" onchange="updatePhotoLabel(this)" />
                            <span class="upload" id="upload-label">📷 Clique pour choisir une photo</span>
                        </div>
                    </div>

                    <div class="actions-inline">
                        <button type="button" class="btn-cta btn-ghost" id="btn-etape-precedente">Retour</button>
                        <button type="submit" class="btn-cta">Valider</button>
                    </div>
                </div>
            </div>

            <div class="overlay-container">
                <div class="form-overlay">
                    <div class="overlay-panel overlay-left">
                        <h2>Étape 2</h2>
                        <p>Ajoute ta photo et ta citation pour terminer.</p>
                    </div>
                    <div class="overlay-panel overlay-right">
                        <h2>Étape 1</h2>
                        <p>Renseigne tes informations personnelles.</p>
                    </div>
                </div>
            </div>

        </form>
    </div>
</div>


<?php include_once('../partials/footer.php'); ?>