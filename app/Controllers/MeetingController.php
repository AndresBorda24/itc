<?php
declare(strict_types=1);
namespace App\Controllers;

use App\Helpers\View;
use App\Services\JaasJWTService;

class MeetingController
{
	public function index(string $espCod, bool $isEsp = false): void
	{
		try {
			View::load("meeting", [
				"token" => (new JaasJWTService)->generate($espCod, $isEsp)
			]);
		} catch (\Throwable $e) {
			View::error($e);
		}
	}
}
