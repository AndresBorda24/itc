<?php
declare(strict_types=1);
namespace App\Services;

use App\App;
use OpenTok\MediaMode;
use OpenTok\OpenTok;

class MeetingSessionService
{
	private int $espId;
	private OpenTok $ot;

	public function __construct(int $espId)
	{
		$this->espId = $espId;
		$this->ot = new OpenTok(
			App::config("opentok")["API_KEY"],
			App::config("opentok")["API_SECRET"]
		);
	}

	/**
	 * Retorna el id de una nueva sesion
	 */
	private function getSessionId(): string
	{
		try {
			$session = $this->ot->createSession([
				"mediaMode" => MediaMode::ROUTED,
				"archiveMode" => \OpenTok\ArchiveMode::MANUAL
			]);

			return $session->getSessionId();
		} catch (\Throwable $t) {
			throw $t;
		}
	}

	/**
	 * Crea una nueva sesion y la almacena en la base de datos. 
	 */
	public function createSession(): \App\Models\MeetingSession
	{
		try {
			$meetingSession = new \App\Models\MeetingSession;
			$meetingSession->esp_id = $this->espId;
			$meetingSession->session_id = $this->getSessionId();

			if (! $meetingSession->save()) {
				throw new \RuntimeException("No se ha podido crear una nueva sesion");
			}

			return $meetingSession;
		} catch(\Throwable $t) {
			throw $t;
		}
	}

	/**
	 * Genera un nuevo token que expira en 30 minutos con el rol de Publisher
	*/
	public function getToken(string $sessionId): string
	{
		return $this->ot->generateToken($sessionId, [
			"role" => \OpenTok\Role::PUBLISHER,
			'expireTime' => time() + (30 * 60)
		]);
	}
}
