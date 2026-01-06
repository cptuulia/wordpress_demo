<?php

require_once __DIR__ . '/editCategoryItem/SlideEditCategoryItem.php';

if (isset($_GET['delete'])) {
   SlideEditCategoryItem::delete();
   $link = "/wp-admin/admin.php?page=program%2Feditcategoryitem&item=" . $_GET['item'];
   echo '<script> window.location.href ="'. $link . '"</script>';
   die('I am not allowed to die');
}


list(
    'categoryItem' => $categoryItem,
    'medias' => $medias,
    'errors' => $errors
) = empty($_POST)
    ? SlideEditCategoryItem::get()
    : SlideEditCategoryItem::save();
?>

<?php include_once __DIR__ . '/editCategoryItem/js.php'; ?>
<?php include_once __DIR__ . '/style/admin.php'; ?>
<?php include_once __DIR__ . '/editCategoryItem/template.php'; ?>

</div>