<?php
/**
 * Auto-load con composer jeje
 */
require_once 'vendor/autoload.php';

/**
 * Seteamos la información del .env
 */
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

/* ----------------------------------------------------------------
 * Son las rutas del proyecto.
 * ----------------------------------------------------------------
*/
require_once __DIR__ . '/app/bootstrap.php';

/* ----------------------------------------------------------------
 * Son las rutas del proyecto.
 * ----------------------------------------------------------------
*/
require_once __DIR__ . '/routes/routes.php';

