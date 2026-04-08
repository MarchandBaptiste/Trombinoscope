<?php
define('BASE_URL', '/');
$page = $_GET['page'] ?? 'home';
include_once './source/partials/header.php';

// chargement des pages
if ($page == 'home') {
  include_once "./source/pages/home.php";
}
if ($page == 'admin') {
  include_once "./source/pages/admin.php";
}
if ($page == 'add_student') {
  include_once "./source/pages/add_student.php";
}
if ($page == 'connexion') {
  include_once "./source/pages/connexion.php";
}
if ($page == 'edit_student') {
  include_once "./source/pages/edit_student.php";
}
if ($page == 'pdc') {
  include_once "./source/pages/pdc.php";
}
if ($page == 'search') {
  include_once "./source/pages/search.php";
}

include_once './source/partials/footer.php';
?>