<?php

require_once __DIR__ . '/editCategory/ProgramEditCategory.php';


if (isset($_GET['delete'])) {
   ProgramEditCategory::delete();
}

list(
    'category' => $category,
    'items' => $items,
    'errors' => $errors
) = empty($_POST)
    ? ProgramEditCategory::get()
    : ProgramEditCategory::save();
?>
<?php include_once __DIR__ . '/style/admin.php'; ?>
<?php include_once __DIR__ . '/editCategory/js.php'; ?>
<?php include_once __DIR__ . '/editCategory/template.php'; ?>
