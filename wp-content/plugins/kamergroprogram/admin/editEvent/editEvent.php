<?php

require_once __DIR__ . '/editEvent/EditEvent.php';


if (!empty($_POST)) {
    list(
        'media' => $media,
        'errors' => $errors
    ) = EditEvent::save();
} else {
    list(
        'media' => $media,
        'errors' => $errors
    ) = EditEvent::get();
}



?>
<?php include_once __DIR__ . '/style/admin.php'; ?>

<?php include_once __DIR__ . '/editEvent/js.php'; ?>
<?php include_once __DIR__ . '/style/admin.php'; ?>
<?php include_once __DIR__ . '/editEvent/template.php'; ?>