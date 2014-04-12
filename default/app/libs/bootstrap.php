<?php
// Bootstrap de la aplicacion para personalizarlo
// Para cargar cambia en public/index.php el require del bootstrap a app

// Arranca KumbiaPHP
$vendor = dirname(dirname(dirname(__DIR__))).'/vendor/';
require "$vendor/parsedown/Parsedown.php";
require dirname(dirname(dirname(__DIR__))).'/backend/app/libs/autoload.php';
require_once CORE_PATH . 'kumbia/bootstrap.php';

