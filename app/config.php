<?php
return [
    /*-------------------------------------------------------------------------
     * project_path se utiliza para cargar los assets. Representa la ruta 
     * en la que se encuentra el proyecto. Ej:
     *  - Dado que en local se trabaja en el puerto 8000 no es necesario. Sin 
     * embargo una vez subido el proyecto al host se debe poner en una carpeta
     * por lo que la ruta cambia a /project-planner -> {ruta actual donde se 
     * sube el proyecto actualmente}  
     * ------------------------------------------------------------------------
     */
    "project_path" => $_ENV["PROJECT_PATH"],

    /*-------------------------------------------------------------------------
     * Configuracíon para la carga de las visatas.
     * ------------------------------------------------------------------------
     */ 
    "views" => [
        "dir" => "resources/views/",
        "ext" => ".view.php",
        "error_view" => "error",
    ],

    /*-------------------------------------------------------------------------
     * Informacion para la conexion de la base de datos.
     * ------------------------------------------------------------------------
     */
    "database" => [
        "host"     => $_ENV["DB_HOST"],
        "username" => $_ENV["DB_USER"],
        "password" => $_ENV["DB_PASS"],
        "db"       => $_ENV["DB_NAME"],
        "port"     => (int) $_ENV["DB_PORT"]
    ],
    
    /*-------------------------------------------------------------------------
     * Opciones para ver los errores.
     * ------------------------------------------------------------------------
     */
    "error" => [
        "show" => ($_ENV["SHOW_ERRORS"] == 'true'),
        "default_message" => "No se ha podidio cargar correctamente la página. Intenta nuevamente más tarde"
    ],

    /**
     * OpenTok Config
     */
    "jaas" => [
        "API_KEY" => $_ENV["JAAS_API_KEY"],
        "APP_ID" => $_ENV["JAAS_APP_ID"],
    ],

    /**
     * OpenTok Config
     */
    "opentok" => [
        "API_KEY" => $_ENV["OPENTOK_API_KEY"],
        "API_SECRET" => $_ENV["OPENTOK_API_SECRET"]
    ]
];
