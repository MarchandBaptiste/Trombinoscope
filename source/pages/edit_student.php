<?php
$pageTitle = 'Modification';
include_once('../partials/header.php');
include_once __DIR__ . '/../functions/modifyStudent.php';

$studentId = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
if ($studentId === null) {
    header("Location: ../pages/home.php");
    exit;
}

$db = db();
$classes = $db->query("SELECT class_id, name FROM class ORDER BY class_id")->fetchAll(PDO::FETCH_ASSOC);
$studentData = studentSet($db, $studentId);

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
    $slogan_valid = (!empty(trim($slogan)) && strlen($slogan) >= 10 && strlen($slogan) <= 255);
    $class_id_valid = $class_id !== false && $class_id > 0;
    $photo_path = $studentData['photo_path'] ?? '';
    $photo_valid = true;

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
            if (move_uploaded_file($file_tmp, $upload_dir . $unique_name)) {
                $photo_path = 'uploads/' . $unique_name;
            }
        } else {
            $photo_valid = false;
        }
    }

    if (!$first_name_valid || !$last_name_valid || !$email_valid || !$slogan_valid || !$class_id_valid || !$photo_valid) {
        $modify = false;
        $sentance = 'Données manquantes ou invalides';
    } else {
        $rows = modifyStudent($db, $studentId, $first_name, $last_name, $email, $slogan, $is_delegate, $photo_path, $class_id);
        if ($rows >= 0) {
            $modify = true;
            $sentance = 'Modification effectuée avec succès';
            $studentData = studentSet($db, $studentId); // refresh les données affichées
        } else {
            $modify = false;
            $sentance = 'Les modifications ont échoué';
        }
    }
}
?>

<div class="upper-band">
    <h1>Modifier votre profil</h1>
</div>
<div class="editForm">
    <section class="log">
        <?php if (!empty($sentance)) { ?>
            <p class="<?= ($modify ?? false) ? 'valid' : 'error' ?>"><?= htmlspecialchars($sentance) ?></p>
        <?php } ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form">
                <div>
                    <label for="first_name">Prénom : </label>
                    <input
                        type="text"
                        id="first_name"
                        name="first_name"
                        placeholder="Entrez votre prénom"
                        value="<?= htmlspecialchars($studentData['first_name'] ?? '') ?>"
                        required />
                </div>
                <div>
                    <label for="last_name">Nom : </label>
                    <input
                        type="text"
                        id="last_name"
                        name="last_name"
                        placeholder="Entrez votre nom"
                        value="<?= htmlspecialchars($studentData['last_name'] ?? '') ?>"
                        required />
                </div>
                <div>
                    <label for="email">Email : </label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        placeholder="Entrez votre email"
                        value="<?= htmlspecialchars($studentData['email'] ?? '') ?>"
                        required />
                </div>
                <div>
                    <label for="class_id">Classe : </label>
                    <select id="class_id" name="class_id" required>
                        <option value="">-- Choisissez votre classe --</option>
                        <?php foreach ($classes as $class) { ?>
                            <option
                                value="<?= $class['class_id'] ?>"
                                <?= ($studentData['class_id'] == $class['class_id']) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($class['name']) ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <div>
                    <label for="slogan">Slogan : </label>
                    <input
                        type="text"
                        id="slogan"
                        name="slogan"
                        placeholder="Entrez votre slogan"
                        value="<?= htmlspecialchars($studentData['slogan'] ?? '') ?>"
                        required />
                </div>
                <div>
                    <label for="is_delegate">Délégué ? : </label>
                    <input
                        type="checkbox"
                        id="is_delegate"
                        name="is_delegate"
                        <?= ($studentData['is_delegate'] ?? false) ? 'checked' : '' ?> />
                </div>
                <div class="zonephoto">
                    <label for="photo_path">Choisissez votre photo :
                        <?php if (!empty($studentData['photo_path'])) { ?>
                            <img src="../<?= htmlspecialchars($studentData['photo_path']) ?>" alt="Photo actuelle" />
                        <?php } ?>
                        <input
                            type="file"
                            id="photo_path"
                            name="photo_path"
                            accept="image/jpeg,image/png,image/gif,image/webp" />
                        <small>Laisser vide pour conserver la photo actuelle</small>
                    </label>
                </div>
                <button type="submit" name="modify" class="btn-cta">Modifier</button>
            </div>
        </form>
    </section>
</div>

<?php include_once('../partials/footer.php'); ?>