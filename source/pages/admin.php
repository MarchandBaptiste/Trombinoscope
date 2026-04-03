<?php 
include_once('../partials/header.php');
include_once __DIR__ . '/../functions/admin.php';

if (isset($_SESSION['logged']) && isset($_GET['logout'])) {
  session_destroy();
  header('Location: /source/pages/home.php');
  exit();
}
?>

<p>vous allez bientot avoir les pouvoirs</p>
<a href="?logout=true">Déconexion</a>

<?php include_once('../partials/footer.php'); ?>

