<?php
// on met require car si on peut pa se connecter a la base de donnée on fait plus de php car sinon on va avoir plein d'erreur
if (!defined('BASE_URL')) {
  define('BASE_URL', '/');
}
session_start();
require_once __DIR__ . '/../database/db_connect.php';
$db = db();

?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?= htmlspecialchars($pageTitle ?? 'Trombinoscope')?></title>
  <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/style.css">
  <script src="<?= BASE_URL ?>assets/js/script.js" defer></script>
  <meta name="description" content="TD sur la PDO avec Sakila" />
  <link rel="icon" type="image/jpg" href="./assets/images/Logo_blanc_La_Manu.png" />
  <link href="https://cdn.jsdelivr.net/npm/remixicon@4.6.0/fonts/remixicon.css" rel="stylesheet">
</head>

<body>
  <!-- En-tête du site -->
  <header>
    <nav class="navbar">
      <a href="/"><img src="/assets/images/Logo_blanc_La_Manu.png" class="img-logo" alt="logo" /></a>
      <div class="nav-links">
        <ul>
          <li><a href="<?= BASE_URL ?>source/pages/search.php" class="btn-cta">Trombinoscope</a></li>
          <li><a href="<?= BASE_URL ?>source/pages/add_student.php" class="btn">Ajouter</a></li>
          <li>
            <a href="<?= BASE_URL ?>source/pages/<?= isset($_SESSION['logged']) ? 'admin.php' : 'connexion.php' ?>" class="btn">
              Administration
            </a>
          </li>
        </ul>
      </div>
      <img class="menu-hamburger" src="<?= BASE_URL ?>assets/images/icon-hamburger.svg" alt="menu" />
    </nav>
  </header>
  <div class="overlay"></div>
  <main>