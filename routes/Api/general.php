<?php
$router->get("/interconsultas", "Api\InterconsultasController@getInterconsultas");
$router->get("/interconsultas-full", "Api\InterconsultasController@getInterconsultasFull");
$router->get("/interconsultas-pendientes", "Api\InterconsultasController@getInterconsultasPendientes");
	