<?php
require_once __DIR__ . '/categories/programCategories.php';

if (isset($_GET['delete'])) {
   kamergroProgramCategories::delete();
}


list('categories' => $categories) =  kamergroProgramCategories::get();

?>

<?php include_once __DIR__ . '/style/admin.php'; ?>
<?php include_once __DIR__ . '/categories/js.php'; ?>
<?php include_once __DIR__ . '/categories/template.php'; ?>
