<?php
define('BASE_URL', '/');
$page = $_GET['page'] ?? 'home';
include_once './source/partials/header.php';

// chargement des pages
if ($page == 'home') {
  include_once "./source/pages/home.php";
}
if ($page == 'moviesList') {
  include_once "./source/pages/moviesList.php";
}
if ($page == 'actorList') {
  include_once "./source/pages/actorList.php";
}
if ($page == 'magasinPlace') {
  include_once "./source/pages/magasinPlace.php";
}
if ($page == 'financarieData') {
  include_once "./source/pages/financarieData.php";
}
if ($page == 'cateList') {
  include_once "./source/pages/cateList.php";
}
if ($page == 'moviActorList') {
  include_once "./source/pages/moviActorList.php";
}

include_once './source/partials/footer.php';
?>