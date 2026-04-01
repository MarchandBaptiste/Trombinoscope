<?php
include_once('../partials/header.php');
include_once __DIR__ . '/../functions/deletStudent.php';
$studentId = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
if ($studentId === null) {
    header("Location: ../pages/home.php");
    exit;
}
$db = db();
$delet = deletStudent($db, $studentId);
if ($delet === true) {
    $sentance = 'La supréssion a réussi';
}
else {
    $sentance = 'La supréssion a échoué';
}
?>
<h2>Suprimé un étudiant</h2>
<section class="cate-column">
    <p><?= $sentance ?></p>
</section>

<?php include_once('../partials/footer.php');
