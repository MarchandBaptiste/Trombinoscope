<?php include_once('../partials/header.php');
include_once __DIR__ . '/../functions/setStudent.php';
$db = db();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_SPECIAL_CHARS);
    $last_name = filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $slogan = filter_input(INPUT_POST, 'slogan', FILTER_SANITIZE_SPECIAL_CHARS);
    $is_delegate = filter_input(INPUT_POST, 'is_delegate', FILTER_VALIDATE_BOOLEAN) ?? false;

    // validation des champs
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
    // (bool) force a renvoyer un boolean
    $email_valid = (bool) filter_var($email, FILTER_VALIDATE_EMAIL);
    $slogan_valid = (
        !empty(trim($slogan)) &&
        strlen($slogan) >= 10 &&
        strlen($slogan) <= 255 &&
        preg_match('/^[a-zA-ZÀ-ÿ\s\-]+$/', $slogan)
    );
    $is_delegate_valid = is_bool($is_delegate);
    function validationFil()
    {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["photo_path"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        if (isset($_POST["submit"])) {
            $check = getimagesize($_FILES["photo_path"]["tmp_name"]);
            if ($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["photo_path"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if (
            $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif"
        ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["photo_path"]["tmp_name"], $target_file)) {
                echo "The file " . htmlspecialchars(basename($_FILES["photo_path"]["name"])) . " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    };

    if (!$first_name_valid || !$last_name_valid || !$email_valid || !$slogan_valid || !$is_delegate_valid) {
        $sentance = 'Données manquantes ou invalides';
        $signIn = false;
    } else {
        $user = setStudent($db, $first_name, $last_name, $email, $slogan, $is_delegate);
        if ($user === true) {
            $signIn   = true;
            $sentance = 'Vous êtes inscrit';
        } else {
            $signIn   = false;
            $sentance = "L'inscription a échoué";
        }
    }
}
?>
<h1>Création de profil ou modification</h1>
<div class="divLog">
    <section class="log">
        <?php if (isset($_POST['signIn'])) { ?>
            <?php if ($signIn === true) { ?>
                <p class="valid"><?= $sentance ?></p>
            <?php } elseif (!empty($sentance)) { ?>
                <p class="error"><?= $sentance ?></p>
            <?php } ?>
        <?php } ?>
        <h3>Inscription</h3>
        <form action="" method="POST">
            <div class="form">
                <div>
                    <label for="first_name">Prénom : </label>
                    <input
                        type="text"
                        id="first_name"
                        name="first_name"
                        placeholder="Entrez votre prénom"
                        value="<?= isset($_POST['signIn']) ? htmlspecialchars($first_name ?? '') : '' ?>"
                        required />
                </div>
                <div>
                    <label for="last_name">Nom : </label>
                    <input
                        type="text"
                        id="last_name"
                        name="last_name"
                        placeholder="Entrez votre nom"
                        value="<?= isset($_POST['signIn']) ? htmlspecialchars($last_name ?? '') : '' ?>"
                        required>
                </div>
                <div>
                    <label for="email">Email : </label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        placeholder="Entrez votre email"
                        value="<?= isset($_POST['signIn']) ? htmlspecialchars($email ?? '') : '' ?>"
                        required />
                </div>
                <div>
                    <label for="slogan">Slogan : </label>
                    <input
                        type="text"
                        id="slogan"
                        name="slogan"
                        placeholder="Entrez votre slogan"
                        value="<?= isset($_POST['signIn']) ? htmlspecialchars($slogan ?? '') : '' ?>"
                        required />
                </div>
                <div>
                    <label for="is_delegate">Déléguer ? : </label>
                    <input
                        type="checkbox"
                        id="is_delegate"
                        name="is_delegate"
                        value="<?= isset($_POST['signIn']) ? htmlspecialchars($is_delegate ?? '') : '' ?>"
                        />
                </div>
                <div>
                    <label for="photo_path">Choisissez votre photo : </label>
                    <input
                        type="file"
                        id="photo_path"
                        name="photo_path"
                        value="<?= isset($_POST['signIn']) ? htmlspecialchars($photo_path ?? '') : '' ?>"
                        required />
                </div>
                <?php if (isset($_POST['signIn']) && !empty($message)) { ?>
                    <p class="error"><?= $message ?></p>
                <?php } ?>
                <button type="submit" name="signIn">S'inscrire</button>
            </div>
        </form>
    </section>
</div>

<?php include_once('../partials/footer.php'); ?>