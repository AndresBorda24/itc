<?php
declare(strict_types=1);
namespace App\Models;

use App\App;

class Especialidad
{
	/**
	 * Retorna el ID de la especialidad SI existe.
	 * @return bool|int
	*/
	public static function exists(string $espCod)
	{
		try {
			$check = App::$conn
        		->prepare("
    				SELECT `especialidad_id` 
    				FROM especialidad 
    				WHERE `especialidad_codigo` = ?
    				LIMIT 1
        		");
        	$check->bind_param("s", $espCod);
        	$check->execute();
        	$check = $check
        		->get_result()
        		->fetch_array()[0] 
        		?? false;

        	return $check;
		} catch (\Throwable $e) {
			throw $e;
		}
	}
}