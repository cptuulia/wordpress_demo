<?php

$autoloader = __DIR__ . '/../../api_/vendor/autoload.php';
require_once $autoloader ;


require_once '../editEvent/KamergroProgramEditEvent.php';

KamergroProgramEditEvent::uploadThumbnail();
