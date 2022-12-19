<?php
declare(strict_types=1);
namespace App\Controllers;

use App\Helpers\View;
use App\Services\ManageMeetingService;

class MeetingController
{
	public function openTok(string $espCod, string $view, bool $isEsp = false): void 
	{
        try{
            if (! $espId = \App\Models\Especialidad::exists($espCod)) { 
				throw new \RuntimeException("Especialidad No encontrada.");
			}
			$ms = new ManageMeetingService($espId);
			$datos = [ 
            	"esp" 		   => $isEsp,
            	"token" 	   => $ms->getToken(),
				"apiKey" 	   => \App\App::config("opentok")["API_KEY"],
            	"sessionId"    => $ms->getSessionId(),
            	"especialidad" => $espCod,
            ];

            View::load($view, $datos);
        } catch (\Throwable $e) {
            View::error($e);
        }
	}
	public function reunion(string $espCod, bool $isEsp = true): void
	{
        try{
            if (! $espId = \App\Models\Especialidad::exists($espCod)) { 
				throw new \RuntimeException("Especialidad No encontrada.");
			}
			$ms = new ManageMeetingService($espId);
			$datos = [ 
            	// "esp" 		   => $isEsp,
            	// "token" 	   => $ms->getToken(),
				// "apiKey" 	   => \App\App::config("opentok")["API_KEY"],
            	// "sessionId"    => $ms->getSessionId(),
            	// "especialidad" => $espCod,
            ];

            View::load("reunion-especialista", $datos);
        } catch (\Throwable $e) {
            View::error($e);
        }
	}
}
