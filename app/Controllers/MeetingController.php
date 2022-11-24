<?php
declare(strict_types=1);
namespace App\Controllers;

use App\Helpers\View;
use App\Services\ManageMeetingService;

class MeetingController
{
	public function index(string $espCod, string $view): void
	{
        try{
            if (! $espId = \App\Models\Especialidad::exists($espCod)) { 
				throw new \RuntimeException("Especialidad No encontrada.");
			}
			$ms = new ManageMeetingService($espId);
			$datos = [ 
				"apiKey" => \App\App::config("opentok")["API_KEY"],
            	"especialidad" => $espCod,
            	"sessionId" => $ms->getSessionId(),
            	"token" => $ms->getToken(),
            ];

            View::load($view, $datos);
        } catch (\Throwable $e) {
            View::error($e);
        }
	}
}
