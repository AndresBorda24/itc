<?php
$router =  new \Bramus\Router\Router();

/* ----------------------------------------------------------------
 | # IMPORTANTE:
 | La documentacion del `Router` se encuentra en:
 |      - https://github.com/bramus/router
 * ----------------------------------------------------------------
*/

/* Establecemos el namespace de los controllers */
$router->setNamespace("\App\Controllers");

/* ------------------------------------------------------------------------
 | Aquí van las rutas web 
 * ------------------------------------------------------------------------
 */
$router->get("/", fn() => header("Location: " . \App\App::config("project_path") . '/urg') );
$router->get("/ex", function() {
    $e = \App\App::$conn->query('SELECT "Hola"')->fetch_all(MYSQLI_ASSOC);
    \App\Helpers\Response::json($e);
});
// Especialista
$router->get("/esp", fn() => (new \App\Controllers\IndexController)->index(true));
$router->get(
    "/esp/(\w+)/reunion", 
    fn(string $esp) => (new \App\Controllers\MeetingController)->reunion($esp)
);
$router->get(
    "/esp/reunion/(\w+)", 
    fn(string $esp) => (new \App\Controllers\MeetingController)->openTok($esp, "openTok-meeting", true) 
);

// Urgencias
$router->get("/urg", fn() => (new \App\Controllers\IndexController)->index(false));
$router->get(
    "/urg/reunion/(\w+)", 
    fn(string $esp) => (new \App\Controllers\MeetingController)->openTok($esp, "openTok-meeting", false) 
);

/* ------------------------------------------------------------------------
 | Aquí van las rutas para la `api` 
 * ------------------------------------------------------------------------
 */
$router->mount('/api', function() use($router) {
    foreach ( glob( __DIR__.'/Api/*.php' ) as $r  ) {
        require_once $r;
    }
});

/* ------------------------------------------------------------------------
 * Esto es para ejecutar el router
 * ------------------------------------------------------------------------
 */
$router->run();
