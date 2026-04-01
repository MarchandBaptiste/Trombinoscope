<?php
// on met require car si on peut pa se connecter a la base de donnée on fait plus de php car sinon on va avoir plein d'erreur
if (!defined('BASE_URL')) {
  define('BASE_URL', '/');
}
session_start();
// pour la déconexion
if (isset($_SESSION['logged']) && isset($_GET['logout'])) {
  session_destroy();
  header('Location: /source/pages/home.php');
  exit();
}
require_once __DIR__ . '/../database/db_connect.php';
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <!-- Définition du jeu de caractères -->
  <meta charset="UTF-8" />
  <!-- Adaptation à la taille de l’écran -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <!-- Titre affiché dans l’onglet du navigateur -->
  <title>Trombinoscope</title>
  <!-- Lien vers la feuille de style -->
  <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/style.css">
  <!-- Lien vers le scipt -->
  <script src="<?= BASE_URL ?>assets/js/script.js"></script>
  <meta name="description" content="TD sur la PDO avec Sakila" />
</head>

<body>
  <!-- En-tête du site -->
  <header>
    <img id="hamburger" src="<?= BASE_URL ?>assets/images/icon-hamburger.svg" alt="menu" />
    <nav id="nav">
      <ul>
        <li><a href="/">Accueil</a></li>
        <li><a href="<?= BASE_URL ?>source/pages/studentList.php">Étudiant</a></li>
        <li><a href="<?= BASE_URL ?>source/pages/search.php">Recherche</a></li>
        <li><a href="<?= BASE_URL ?>source/pages/add_student.php">Ajouter</a></li>
        <li><a href="<?= BASE_URL ?>source/pages/delete_student.php">Supprimer</a></li>
        <li><a href="<?= BASE_URL ?>source/pages/edit_student.php">Modifier</a></li>
        <li>
          <a href="<?= BASE_URL ?>source/pages/connexion.php?logout" class="<?= isset($_SESSION['logged']) ? 'active' : '' ?>">
            <?= isset($_SESSION['logged']) ? 'Déconnexion' : 'Connexion' ?>
          </a>
        </li>
        </label>
      </ul>
    </nav>
  </header>
  <main>